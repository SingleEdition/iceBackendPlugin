<?php foreach ($this->configuration->getValue('list.display') as $name=>$field): ?>
<?php var_dump($name, $field); ?>
<?php //echo $this->renderField($field) ?>
<?php endforeach; ?>
