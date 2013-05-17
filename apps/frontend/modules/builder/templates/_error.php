<?php if(!isset($name)){ $name = 'error'; } ?>

<?php if ($sf_user->hasFlash($name)): ?>
    <script type="text/javascript">
        noty({text: '<?php echo $sf_user->getFlash($name) ?>', type: 'error', layout:"top", timeout: 3000, dismissQueue: true });
    </script>
<?php endif; ?>