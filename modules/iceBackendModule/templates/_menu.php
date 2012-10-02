<?php
/**
 * @var IceBackendUser $sf_user
 * @var array $categories
 */
?>

<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="brand" href='<?php echo url_for('homepage') ?>'>
        <?php echo sfConfig::get('app_ice_backend_site', 'Backend'); ?>
      </a>
      <ul class="nav">
        <li><a href="<?php echo url_for_frontend('homepage', array()) ?>">
            <i class="icon-globe icon-white"></i>&nbsp;Frontend</a>
        </li>
        <li><a href="/"><i class="icon-home icon-white"></i>&nbsp;Dashboard</a></li>
        <?php foreach ($categories as $name => $category): ?>
        <?php if (iceBackendModule::hasPermission($category, $sf_user)): ?>
          <?php if (iceBackendModule::hasItemsMenu($category['items'])): ?>
            <li class="dropdown">
              <a href="#nogo" data-toggle="dropdown" class="dropdown-toggle">
                <?php echo (!empty($category['icon'])) ? '<i class="icon-'. $category['icon'] .' icon-white"></i>' : ''; ?>
                <?php echo isset($category['name']) ? $category['name'] : $name ?><span class="caret"></span>
              </a>
              <?php include_partial('iceBackendModule/menu_list', array(
              'items'         => $category['items'],
              'items_in_menu' => true
            )) ?>
            </li>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <ul class="nav pull-right">
        <li>
          <?php
            echo link_to(
            '<i class="icon-lock icon-white"></i>&nbsp;'.__('Logout'), '@ice_backend_signout',
            array('onclick' => 'return confirm("You will be also logged out of your webmail. Are you sure you want to continue?")')
            );
            ?>
        </li>
      </ul>
    </div>
  </div>
</div>
