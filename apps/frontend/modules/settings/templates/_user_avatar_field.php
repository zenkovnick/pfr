<?php use_helper('Thumbnail'); ?>

<span id="user_avatar_container" class="photo-holder default-avatar">
    <?php if($user->getPhoto()): ?>
        <?php echo image_tag(getThumbnail('avatar/'.$user->getPhoto(), isset($size) ? $size : 40), array('alt' => '')) ?>
    <?php else: ?>
        <?php echo image_tag(getThumbnail('../images/no_logo.jpg', isset($size) ? $size : 40), array('alt' => '')) ?>
    <?php endif ?>
</span>

<div class="hidden">
    <?php $options['accept'] = 'image/*'; ?>
    <?php echo $field->render($options) ?>
    <?php echo $field->renderError() ?>
</div>