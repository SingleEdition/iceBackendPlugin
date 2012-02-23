<?php if ($actions = $this->configuration->getValue('list.actions')): ?>
<ul class="sf_admin_actions">
  <?php foreach ($actions as $name => $params): ?>
  <?php if ('_new' == $name): ?>
    <?php
    $params['params'] = array_merge(array('class' => 'btn btn-success btn-large'), $params['params']);
    echo $this->addCredentialCondition('[?php echo $helper->linkToNew(' . $this->asPhp($params) . ') ?]', $params) . "\n"
    ?>
    <?php else: ?>
    <li class="sf_admin_action_<?php echo $name ?>">
      <?php
      $params['params'] = array_merge(array('class' => 'btn btn-large'), $params['params']);
      echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params) . "\n"
      ?>
    </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
