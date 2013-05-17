<?php if(!isset($name)){ $name = 'success'; } ?>

<?php if ($sf_user->hasFlash($name)): ?>
<script type="text/javascript">
    noty({text: '<?php echo $sf_user->getFlash($name) ?>', type: 'success', layout:"top", timeout: 3000, dismissQueue: true});
</script>
<?php endif; ?>