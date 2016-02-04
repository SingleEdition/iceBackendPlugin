[?php if ($sf_user->hasFlash('notice')): ?]
  <div class="alert alert-success fade in" data-alert="alert">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <strong>SUCCESS:</strong> [?php echo __($sf_user->getFlash('notice'), array(), 'ice_backend_plugin') ?]
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('error')): ?]
  <div class="alert alert-error fade in" data-alert="alert">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <strong>ERROR:</strong> [?php echo __($sf_user->getFlash('error'), array(), 'ice_backend_plugin') ?]
  </div>
[?php endif; ?]
