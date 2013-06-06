<?php use_helper('Thumbnail'); ?>
<?php
    echo image_tag(getThumbnail($file_path, isset($size) ? $size : 40)) ?>
