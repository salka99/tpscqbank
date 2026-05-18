<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCQ Book</title>

    <style>
        /* --- Reset & Base Settings --- */
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", "Segoe UI", -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
            background: #f4f5f7;
            color: #2d3748;
            line-height: 1.6;
            letter-spacing: -0.01em;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* --- A4 Page Setup for Screen Preview --- */
        .book {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: #fff;
            padding: 20mm 16mm;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }

        /* --- Header Section --- */
        .book-title {
            text-align: center;
            margin-bottom: 35px;
            border-bottom: 2px solid #2b6cb0;
            padding-bottom: 18px;
        }

        .book-title h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #1a202c;
            margin-bottom: 6px;
        }

        .book-title p {
            font-size: 13px;
            font-weight: 500;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* --- Multi-Column Layout --- */
        .questions {
            column-count: 2;
            column-gap: 35px;
            column-rule: 1px solid #e2e8f0;
        }

        /* --- Question Container --- */
        .question-box {
            break-inside: avoid;
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .question {
            font-size: 13px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 10px;
            text-align: justify;
            text-indent: -20px;
            padding-left: 20px;
        }

        /* --- Options Grid/Layout --- */
        .options {
            margin-left: 20px;
            margin-bottom: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 14px;
        }

        .option {
            font-size: 12.5px;
            color: #4a5568;
            display: flex;
            align-items: baseline;
        }

        .option strong {
            color: #2b6cb0;
            font-weight: 700;
            margin-right: 8px;
            min-width: 16px;
        }

        /* --- Answer & Explanation Container --- */
        .meta-container {
            margin-left: 20px;
            background: #f7fafc;
            padding: 8px 12px;
            border-left: 3px solid #2b6cb0; 
            border-radius: 0 4px 4px 0;
            margin-top: 10px;
        }

        .answer {
            font-size: 11px;
            font-weight: 700;
            color: #2b6cb0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .solution {
            margin-top: 4px;
            font-size: 11.5px;
            color: #4a5568;
            text-align: justify;
            line-height: 1.5;
        }

        /* --- Print Mode Optimizations --- */
        @page {
            size: A4;
            margin: 15mm 10mm;
        }

        @media print {
            body {
                background: #fff;
            }

            .book {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .question-box {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
        .solution{
    margin-top:8px;
    padding:8px;
    background:#fafafa;
    border-left:3px solid #999;
    font-size:13px;
    line-height:1.6;
    word-break: break-word;
}

.MathJax{
    font-size: 14px !important;
}
    </style>

    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<body>

<div class="book">

    <?php
    // Fetching the files at the top so we can extract the current file name for the subtitle
    $jsonFiles = glob(WRITEPATH . 'json/*.json');
    $count = 1;

    // Grab the first file name to use as a default header subtitle if files exist
    $displayTitle = "Practice Book";
    if (!empty($jsonFiles)) {
        $displayTitle = pathinfo($jsonFiles[0], PATHINFO_FILENAME);
        // Optional: clean up dashes/underscores for a prettier title (e.g., "physics-quiz-1" -> "Physics Quiz 1")
        $displayTitle = ucwords(str_replace(['_', '-'], ' ', $displayTitle));
    }
    ?>

    <div class="book-title">
        <h1>MCQ Question Bank</h1>
        <!-- Dynamic JSON filename used here cleanly -->
        <p><?= esc($displayTitle) ?></p>
    </div>

    <div class="questions">

        <?php
        foreach($jsonFiles as $file):
            // If you want a sub-heading per file inside the columns instead, you could echo pathinfo($file) here.
            $content = file_get_contents($file);
            $questions = json_decode($content, true);

            if(!$questions){
                continue;
            }

            foreach($questions as $q):
                if(empty(trim($q['question'] ?? ''))){
                    continue;
                }
        ?>

        <div class="question-box">

            <div class="question">
                <?= $count ?>.  <?= nl2br(str_replace('\\n', "\n", $q['question'])) ?>
            </div>

            <?php if(!empty($q['options'])): ?>
                <div class="options">
                    <?php foreach($q['options'] as $option): ?>
                        <div class="option">
                            <strong><?= esc($option['option']) ?></strong>
                            <span><?= esc($option['text']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($q['answer']) || !empty($q['solution'])): ?>
                <div class="meta-container">
                    <?php if(!empty($q['answer'])): ?>
                        <div class="answer">
                            Ans: <?= esc($q['answer']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($q['solution'])): ?>
                        <div class="solution">
                             <?= nl2br(str_replace('\\n', "\n", $q['solution'])) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>

        <?php
            $count++;
            endforeach;
        endforeach;
        ?>

    </div>

</div>

</body>
</html>