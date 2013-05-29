<span id="account_avatar_container" class="photo-holder default-avatar">
    <?php if($account->getPhoto()): ?>
        <img id="temp_image" src="/uploads/avatar/<?php echo $account->getPhoto() ?>" />
    <?php endif ?>
</span>
<?php $options['accept'] = 'image/*'; ?>
<?php echo $field->render($options) ?>
<?php echo $field->renderError() ?>
