[?php /* @var $helper Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper */ ?]
<?php if ($actions = $this->configuration->getValue('show.actions')): ?>
<ul class="sf_admin_actions">
  <?php foreach ($actions as $name => $params): ?>
  <?php switch ($name):
    case '_new':
      $params['params'] = array_merge(array('class' => 'btn btn-primary btn-success'), $params['params']);
      echo $this->addCredentialCondition('[?php echo $helper->linkToNew(' . $this->asPhp($params) . ') ?]', $params) . "\n";
      break;
    case '_delete':
      $params['params'] = array_merge(array(
        'class' => 'btn btn-danger',
      ), $params['params']);
      echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($' . $this->getSingularName() . ', ' . $this->asPhp($params) . ') ?]', $params);
      break;
    case '_edit':
      $params['params'] = array_merge(array('class' => 'btn btn-primary'), $params['params']);
      echo $this->addCredentialCondition('[?php echo $helper->linkToShowEdit($' . $this->getSingularName() . ', ' . $this->asPhp($params) . ') ?]', $params) . "\n";
      break;
    case  '_list':
      $params['params'] = array_merge(array('class' => 'btn btn-primary'), $params['params']);
      echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($params).') ?]', $params);
      break;
    default:
      ?>
        <li class="sf_admin_action_<?php echo $name ?>">
          <?php
          $params['params'] = array_merge(array('class' => 'btn btn-primary'), $params['params']);
          echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params) . "\n";
          ?>
        </li>
        <?php endswitch; ?>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
