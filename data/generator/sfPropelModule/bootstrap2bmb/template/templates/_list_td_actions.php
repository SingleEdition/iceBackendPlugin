<td>
  <div class="btn-group" style="white-space: nowrap;">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Actions<span class="caret"></span></a>
    <ul class="dropdown-menu" style="top: 15px">
      <?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
      <?php if ('_delete' == $name): ?>
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
      <?php elseif ('_edit' == $name): ?>
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
      <?php elseif ('_move_up' == $name): ?>
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToMoveUp($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
      <?php elseif ('_move_down' == $name): ?>
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToMoveDown($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
      <?php else: ?>
        <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
          <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
        </li>
      <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</td>
