<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use CodeIgniter\Controller;

class Scraper extends Controller
{

    public function book()
    {
        return view('book');
    }
    public function index()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $baseUrl = "https://www.examveda.com/competitive-english/practice-mcq-question-on-articles/";

        // Create json folder
        if (!is_dir(WRITEPATH . 'json')) {
            mkdir(WRITEPATH . 'json', 0777, true);
        }

        // Get homepage
        $homeHtml = $this->getHTML($baseUrl);

        if (!$homeHtml) {
            exit('Unable to load website');
        }

        // Detect total sections automatically
        $totalSections = $this->getTotalSections($homeHtml);

        echo "<h2>Total Sections: {$totalSections}</h2>";

        $seen = [];

        for ($section = 1; $section <= $totalSections; $section++) {

            echo "<hr>";
            echo "<h2>SECTION {$section}</h2>";

            // First page URL
            $firstUrl = $baseUrl . '?section=' . $section;

            $firstHtml = $this->getHTML($firstUrl);

            if (!$firstHtml) {

                echo "Failed Section {$section}<br>";

                continue;
            }

            // Total pages in section
            $totalPages = $this->getTotalPages($firstHtml);

            echo "Total Pages: {$totalPages}<br><br>";

            $sectionData = [];

            for ($page = 1; $page <= $totalPages; $page++) {

                $url = $baseUrl . '?section=' . $section . '&page=' . $page;

                echo "Scraping: {$url}<br>";

                $html = $this->getHTML($url);

                if (!$html) {

                    echo "Failed Page {$page}<br>";

                    continue;
                }

                $questions = $this->scrapeQuestions($html);

                echo "Questions Found: " . count($questions) . "<br>";

                foreach ($questions as $q) {

                    if (empty(trim($q['question'] ?? ''))) {
                        continue;
                    }

                    // Prevent duplicate
                    $key = md5($q['question']);

                    if (!isset($seen[$key])) {

                        $seen[$key] = true;

                        $sectionData[] = $q;
                    }
                }

                sleep(1);
            }

            // Save section file
            file_put_contents(
                WRITEPATH . 'json/section-' . $section . '.json',
                json_encode(
                    $sectionData,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                )
            );

            echo "<strong>Saved Section {$section}</strong><br>";
        }

        echo "<hr><h1>Scraping Completed</h1>";
    }

    private function getHTML($url)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
            CURLOPT_HTTPHEADER => [
                'Accept-Language: en-US,en;q=0.9'
            ]
        ]);

        $html = curl_exec($ch);

        if (curl_errno($ch)) {

            echo "Curl Error: " . curl_error($ch) . "<br>";
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode != 200) {

            echo "HTTP CODE: {$httpCode}<br>";
        }

        return $html;
    }

    private function scrapeQuestions($html)
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();

        $dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);

        $articles = $xpath->query("//article[contains(@class,'question')]");

        $data = [];

        foreach ($articles as $article) {

            // Question
            $questionNode = $xpath->query(
                ".//div[contains(@class,'question-main')]",
                $article
            );

            $question = '';

            if ($questionNode->length > 0) {

                $question = trim($questionNode[0]->textContent);
            }

            // Options
            $options = [];

            $optionNodes = $xpath->query(
                ".//div[contains(@class,'question-options')]/p",
                $article
            );

            foreach ($optionNodes as $p) {

                $labels = $xpath->query(".//label", $p);

                if ($labels->length >= 2) {

                    $options[] = [
                        'option' => trim($labels[0]->textContent),
                        'text'   => trim($labels[1]->textContent),
                    ];
                }
            }

            // Answer
            $answerNode = $xpath->query(
                ".//div[contains(@class,'answer_container')]//strong",
                $article
            );

            $answer = '';

            if ($answerNode->length > 0) {

                $answer = trim($answerNode[0]->textContent);
            }

            // Full solution
            $solutionNode = $xpath->query(
                ".//div[contains(@class,'answer_container')]//div[last()]",
                $article
            );

            $solution = '';

            if ($solutionNode->length > 0) {

                $solution = trim($solutionNode[0]->textContent);

                // Clean multiple spaces
                $solution = preg_replace('/\s+/', ' ', $solution);
            }

            $data[] = [
                'question' => $question,
                'options'  => $options,
                'answer'   => $answer,
                'solution' => $solution,
            ];
        }

        return $data;
    }

    private function getTotalPages($html)
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();

        $dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);

        $links = $xpath->query("//a[contains(@href,'page=')]");

        $pages = [];

        foreach ($links as $link) {

            $href = $link->getAttribute('href');

            preg_match('/page=(\d+)/', $href, $matches);

            if (isset($matches[1])) {

                $pages[] = (int)$matches[1];
            }
        }

        return !empty($pages) ? max($pages) : 1;
    }

    private function getTotalSections($html)
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();

        $dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);

        $links = $xpath->query("//a[contains(@href,'section=')]");

        $sections = [];

        foreach ($links as $link) {

            $href = $link->getAttribute('href');

            preg_match('/section=(\d+)/', $href, $matches);

            if (isset($matches[1])) {

                $sections[] = (int)$matches[1];
            }
        }

        return !empty($sections) ? max($sections) : 1;
    }
}