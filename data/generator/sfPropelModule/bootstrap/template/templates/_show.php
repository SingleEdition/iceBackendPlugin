<?php /* @var $field sfModelGeneratorConfigurationField */ ?>
<div class="info-block">
  <dl>
<?php foreach ($this->configuration->getValue('show.display') as $name => $field): ?>
    <dt><?php echo $field->getConfig('label', '', true) ?></dt>
    <dd>[?php echo <?php echo $this->renderField($field) ?> ?]</dd>
<?php endforeach; ?>
  </dl>
</div>
