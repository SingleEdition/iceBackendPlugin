<?php /* @var $field sfModelGeneratorConfigurationField */ ?>
<table class="table table-striped">
  <?php foreach ($this->configuration->getValue('show.display') as $name => $field): ?>
  <tr>
    <th><?php echo $field->getConfig('label', '', true) ?></th>
    <td>[?php echo <?php echo $this->renderField($field) ?> ?]</td>
  </tr>
  <?php endforeach; ?>
</table>
