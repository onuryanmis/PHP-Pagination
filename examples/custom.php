<?php
require_once "../src/pagination.class.php";
$sayfa = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

$page_config = [
    "before" => "<li>",
    "after" => "</li>"
];

$sayfalama_ayarlar = [
    "url" => "custom.php",
    "total" => 20,
    "per_page" => 2,
    "open"=>"<div class='sayfalama'><ul>",
    "close"=>"</ul></div>",
    "current_page" => $sayfa,
    "page" => $page_config,
    "cur_page" => [
        "before" => '<li class="active">',
        "after" => "</li>"
    ],
    "first_page" => $page_config,
    "last_page" => $page_config,
    "next_page" => $page_config,
    "prev_page" => $page_config
];
$sayfalama = new Pagination($sayfalama_ayarlar);  // Bootstrap4 teması.
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .kapsa {
            width: 960px;
            margin: 0px auto
        }
        .sayfalama{
            float:right
        }
        .sayfalama ul li {
            float: left;
            list-style: none;
        }

        .sayfalama ul li a {
            display: block;
            padding: 15px;
            background: black;
            color: #fff;
            font-size: 14px;
            float: left;
            margin: 5px;
            text-decoration: none;
        }

        .sayfalama ul li.active a {
            background: deepskyblue;
        }
    </style>
</head>
<body>

<div class="kapsa">
    <h1 style="text-align: center;"><a href="http://www.webderslerim.com/" target="_blank">Web Derslerim</a></h1>
    <hr>
    <?php echo $sayfalama->create(); ?>
</div>

</body>
</html>