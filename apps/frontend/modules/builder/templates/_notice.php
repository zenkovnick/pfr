<?php if(!isset($name)){ $name = 'notice'; } ?>

<?php if ($sf_user->hasFlash($name)): ?>
    <script type="text/javascript">
        noty({text: '<?php echo $sf_user->getFlash($name) ?>', type: 'notice', layout:"top", timeout: 3000, dismissQueue: true});
    </script>
<?php endif; ?>