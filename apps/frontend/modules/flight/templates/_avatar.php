<?php use_helper('Thumbnail'); ?>
<?php if($user->getPhoto()): ?>
    <?php echo image_tag(getThumbnail('avatar/'.$user->getPhoto(), isset($size) ? $size : 40), array('alt' => '')) ?>
<?php else: ?>
    <?php echo image_tag(getThumbnail('../images/no_logo.jpg', isset($size) ? $size : 40), array('alt' => '')) ?>
<?php endif ?>