<?php use_helper('Thumbnail'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        <?php if(!include_slot('title')): ?>
            PreFlight Risk
        <?php endif ?>
    </title>
    <link rel="shortcut icon" type="image/jpg" href="../images/fav-icon.jpg"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/media_queries.css" />

    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript">
//        alert(jQuery(window).width());
        if( /Chromium|Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
            $("<link/>", {
                rel: "stylesheet",
                type: "text/css",
                href: "/css/style_mobile.css"
            }).appendTo("head");
        }
    </script>
</head>
<body>
<div class="container">
    <div class="header">
        <?php if(!include_slot('header')): ?>
        <?php endif ?>
    </div>
    <div class="content">
        <div class="wrapper">
            <?php echo $sf_content ?>
        </div>
    </div>
</div>
</body>
</html>


