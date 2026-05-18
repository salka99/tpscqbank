<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCQ Book</title>
<?php

$layout = $_GET['layout'] ?? 'book';

?>


    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:"Inter","Segoe UI",sans-serif;
            background:#f4f5f7;
            color:#2d3748;
            line-height:1.6;
        }

        .book{
            width:210mm;
            min-height:297mm;
            margin:20px auto;
            background:#fff;
            padding:20mm 16mm;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            border-radius:4px;
        }

        .book-title{
            text-align:center;
            margin-bottom:35px;
            border-bottom:2px solid #2b6cb0;
            padding-bottom:18px;
        }

        .book-title h1{
            font-size:26px;
            font-weight:700;
            color:#1a202c;
            margin-bottom:6px;
        }

        .book-title p{
            font-size:13px;
            font-weight:500;
            color:#718096;
            text-transform:uppercase;
            letter-spacing:1.5px;
        }

        /* .questions{
            column-count:2;
            column-gap:35px;
            column-rule:1px solid #e2e8f0;
        } */
            .questions {
    /* If layout is set to 'list', use 1 column. Otherwise, use 2 columns */
    column-count: <?= ($layout === 'list') ? '1' : '2' ?>;
    column-gap: 35px;
    column-rule: 1px solid #e2e8f0;
}

        .question-box{
            break-inside:avoid;
            margin-bottom:22px;
            padding-bottom:16px;
            border-bottom:1px dashed #e2e8f0;
        }

        .question{
            font-size:13px;
            font-weight:600;
            color:#1a202c;
            margin-bottom:10px;
            text-align:justify;
            text-indent:-20px;
            padding-left:20px;
        }

        .options{
            margin-left:20px;
            margin-bottom:10px;
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:6px 14px;
        }

        .option{
            font-size:12.5px;
            color:#4a5568;
            display:flex;
            align-items:baseline;
        }

        .option strong{
            color:#2b6cb0;
            margin-right:8px;
            min-width:16px;
        }

        .meta-container{
            margin-left:20px;
            background:#f7fafc;
            padding:8px 12px;
            border-left:3px solid #2b6cb0;
            border-radius:0 4px 4px 0;
            margin-top:10px;
        }

        .answer{
            font-size:11px;
            font-weight:700;
            color:#2b6cb0;
            text-transform:uppercase;
        }

        .solution{
            margin-top:8px;
            padding:8px;
            background:#fafafa;
            border-left:3px solid #999;
            font-size:13px;
            line-height:1.6;
            word-break:break-word;
        }

        .card{
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    padding:30px;
    border-radius:20px;
    box-shadow:
        0 10px 30px rgba(0,0,0,0.06),
        0 2px 10px rgba(0,0,0,0.03);
    border:1px solid #e2e8f0;
}

.folder-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:18px;
    margin-top:20px;
}

.folder-link{
    position:relative;
    display:flex;
    align-items:center;
    gap:14px;
    padding:18px 20px;
    border-radius:16px;
    text-decoration:none;
    background:#ffffff;
    border:1px solid #edf2f7;
    overflow:hidden;
    transition:all .3s ease;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

.folder-link::before{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(
        135deg,
        rgba(43,108,176,.06),
        rgba(99,179,237,.03)
    );
    opacity:0;
    transition:.3s;
}

.folder-link:hover{
    transform:translateY(-4px);
    box-shadow:
        0 12px 24px rgba(43,108,176,.12),
        0 4px 10px rgba(0,0,0,.05);
    border-color:#90cdf4;
}

.folder-link:hover::before{
    opacity:1;
}

.folder-icon{
    width:52px;
    height:52px;
    min-width:52px;
    border-radius:14px;
    background:linear-gradient(135deg,#2b6cb0,#4299e1);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    color:#fff;
    box-shadow:0 6px 15px rgba(66,153,225,.25);
    position:relative;
    z-index:2;
}

.folder-info{
    position:relative;
    z-index:2;
}

.folder-name{
    font-size:15px;
    font-weight:700;
    color:#1a202c;
    margin-bottom:4px;
}

.folder-sub{
    font-size:12px;
    color:#718096;
}

        .MathJax{
            font-size:14px !important;
        }

       @page{
    size:A4;
    margin:20mm 15mm; /* Adjusted margins to give room for headers/footers */
    
    /* This injects the page number at the bottom right of every printed page */
    @bottom-right {
        content: "Page " counter(page) " of " counter(pages);
        font-family: "Inter", "Segoe UI", sans-serif;
        font-size: 11px;
        color: #718096;
    }
}


        /* @media print{

            body{
                background:#fff;
            }

            .book{
                width:100%;
                margin:0;
                padding:0;
                box-shadow:none;
            }

            .question-box{
                break-inside:avoid;
                page-break-inside:avoid;
            }
        } */
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

    /* Change avoid to auto so long questions don't push empty whitespace */
    .question-box {
        break-inside: auto;
        page-break-inside: auto;
    }

    /* Keep the question text and its immediate options together if possible */
    .question {
        break-after: avoid;
        page-break-after: avoid;
    }
}

    </style>

    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

</head>
<body>

<div class="book">

<?php

$folder = service('uri')->getSegment(2);

?>

<div class="book-title">

  <h1>MCQ Question Bank</h1>

    <?php if(isset($displayTitle)): ?>

        <p><?= esc($displayTitle) ?></p>

    <?php else: ?>

        <p>Select Subject</p>

    <?php endif; ?>

</div>

<?php if(isset($folders)): ?>

    <div class="card">

    <h2 style="
        font-size:24px;
        margin-bottom:5px;
        color:#1a202c;
    ">
        Select Subject
    </h2>

    <p style="
        color:#718096;
        margin-bottom:25px;
        font-size:14px;
    ">
        Choose a folder to open MCQ question bank
    </p>

    <div class="folder-grid">

        <?php foreach($folders as $folderName): ?>

            <a
                class="folder-link"
                href="<?= base_url('book/' . $folderName) ?>"
            >

                <div class="folder-icon">
                    📘
                </div>

                <div class="folder-info">

                    <div class="folder-name">
                        <?= ucwords(str_replace(['_','-'], ' ', $folderName)) ?>
                    </div>

                    <div class="folder-sub">
                        Open Question Bank
                    </div>

                </div>

            </a>

        <?php endforeach; ?>

    </div>

</div>

<?php endif; ?>

  
<?php if(isset($jsonFiles)): ?>

<div class="questions">

    <?php

    $count = 1;

    foreach($jsonFiles as $file):

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
            <?= $count ?>.
            <?= nl2br(str_replace('\\n', "\n", $q['question'])) ?>
        </div>

        <?php if(!empty($q['options'])): ?>

            <div class="options">

                <?php foreach($q['options'] as $option): ?>

                    <div class="option">

                        <strong>
                            <?= esc($option['option']) ?>
                        </strong>

                        <span>
                            <?= esc($option['text']) ?>
                        </span>

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


               <?php if(!empty($q['solution'])): 
                    // Define the exact spam/placeholder string you want to hide
                    $hiddenText = "No explanation is given for this question Let's Discuss on Board";
                    
                    // Clean up the text by removing the unwanted string
                    $cleanedSolution = str_replace($hiddenText, '', $q['solution']);
                    
                    // Check if there is still actual content left after removing the placeholder
                    if(!empty(trim($cleanedSolution))):
                ?>

                    <div class="solution">
                        <?= nl2br(str_replace('\\n', "\n", esc($cleanedSolution))) ?>
                    </div>

                <?php 
                    endif;
                endif; 
                ?>

            </div>

        <?php endif; ?>

    </div>

    <?php

        $count++;

        endforeach;

    endforeach;

    ?>

</div>

<?php endif; ?>

</div>

</body>
</html>