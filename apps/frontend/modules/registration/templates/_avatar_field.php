<div class="upload-wrapper">
    <span id="avatar_container" class="photo-holder default-avatar with-dash-border"></span>
    <?php $options['accept'] = 'image/*'; ?>
    <?php $options['class'] = 'invisible'; ?>
    <?php echo $field->render($options) ?>
</div>
<?php echo $field->renderError() ?>
