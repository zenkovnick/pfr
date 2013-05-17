<?php use_helper('Thumbnail'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <title>
        <?php if(!include_slot('title')): ?>
            The Solution - Be part of the solution
        <?php endif ?>
    </title>

    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

</head>
<body>
    <div class="content">
        <?php echo $sf_content ?>
    </div>

</body>
</html>

<script type="text/javascript">
    jQuery("a.fancy").fancybox({
        'titlePosition'     : 'over',
        'overlayOpacity'    : 0.4,
        'centerOnScroll'    : true,
        showCloseButton     : false,
        'type'              : 'ajax',
        hideOnOverlayClick  : true

    });

    jQuery("a.fancy-inline").fancybox({
        'titlePosition'     : 'over',
        'overlayOpacity'    : 0.4,
        'centerOnScroll'    : true,
        showCloseButton     : false,
        'type'              : 'inline',
        hideOnOverlayClick  : true

    });

</script>

