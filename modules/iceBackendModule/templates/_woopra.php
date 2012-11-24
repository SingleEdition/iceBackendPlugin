<?php /** @var  IceBackendUser  $sf_user */ ?>

<!-- Woopra Code Start -->
<script type="text/javascript" src="//static.woopra.com/js/woopra.v2.js"></script>
<script type="text/javascript">
  woopraTracker.addVisitorProperty('name', '<?php echo $sf_user->getName(); ?>');
  woopraTracker.addVisitorProperty('avatar', '<?php echo $sf_user->getAvatarUrl(true); ?>');
  woopraTracker.track();
</script>
<!-- Woopra Code End -->
