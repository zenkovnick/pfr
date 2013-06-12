<div class="upload-wrapper">
    <span id="avatar_container" class="photo-holder default-avatar with-dash-border"></span>
    <?php $options['accept'] = 'image/*'; ?>
    <?php $options['class'] = 'invisible'; ?>

    <div class="hidden">
        <?php echo $field->render($options) ?>
    </div>
</div>
<?php echo $field->renderError() ?>
