<?php if ($actions = $this->configuration->getValue('list.actions')): ?>
  <ul class="unstyled">
  <?php foreach ($actions as $name => $params): ?>
    <?php if ('_new' == $name): ?>
      <?php
        $params['params'] = array_merge(array('class' => 'btn btn-success btn-large'), $params['params']);
        echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n"
      ?>
    <?php else: ?>
      <?php
        $params['params'] = array_merge(array('class' => 'btn btn-large'), $params['params']);
        echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params)."\n"
      ?>
    <?php endif; ?>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
