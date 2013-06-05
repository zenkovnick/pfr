<?php use_helper('Thumbnail'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <title>
        <?php if(!include_slot('title')): ?>
            PreFlight Risk
        <?php endif ?>
    </title>

    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript">
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
            $("<link/>", {
                rel: "stylesheet",
                type: "text/css",
//                href: "/css/style_mobile.css"
                href: "/css/style.css"
            }).appendTo("head");
        } else {
            $("<link/>", {
                rel: "stylesheet",
                type: "text/css",
                href: "/css/style.css"
            }).appendTo("head");
        }
    </script>
</head>
<body>
    <div class="header">
        <a href="#" class="logo">PreflightRisk</a>
        <?php if(!include_slot('header')): ?>
        <?php endif ?>
    </div>
    <div class="content">
        <div class="wrapper">
            <?php echo $sf_content ?>
        </div>
    </div>

</body>
</html>


