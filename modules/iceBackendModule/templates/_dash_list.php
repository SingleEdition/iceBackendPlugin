<div class="cpanel">
  <?php foreach ($items as $key => $item): ?>
    <?php if (iceBackendModule::hasPermission($item, $sf_user)):?>
      <div style="float: left">
        <div class="icon">
          <a href="<?php echo url_for($item['url']) ?>" title="<?= __($item['name']); ?>">
            <?php echo ice_cdn_image_tag($item['image'], sfConfig::get('app_ice_assets_subdomain'), array('alt' => __($item['name'], array(), 'ice_backend_plugin'))); ?>
            <span><?= __($item['name'], array(), 'ice_backend_plugin'); ?></span>
          </a>
        </div>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  <div class="clear"></div>
</div>
