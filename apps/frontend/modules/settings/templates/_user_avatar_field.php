<?php use_helper('Thumbnail'); ?>

<div class="upload-wrapper">
    <span id="user_avatar_container" class="photo-holder default-avatar <?php echo !$user->getPhoto() ? "with-dash-border" : "" ?>">
            <?php if($user->getPhoto()): ?>
                <?php echo image_tag(getThumbnail('avatar/'.$user->getPhoto(), isset($size) ? $size : 40), array('alt' => '')) ?>
            <?php endif ?>
    </span>
    <?php $options['accept'] = 'image/*'; ?>

    <?php echo $field->render($options) ?>
</div>
<?php echo $field->renderError() ?>
