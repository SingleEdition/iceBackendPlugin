[?php echo "<"?]?xml version="1.0" encoding="UTF-8" ?>
<Root>
[?php foreach ($pager->getResults() as $i=>$<?php echo $this->getSingularName(); ?>): ?]
  <<?php echo $this->getSingularName() ?>>
<?php foreach ($this->configuration->getValue('export.display') as $name=> $field): ?>
    <<?php echo $name ?>>[?php echo str_replace("'", "\\'", <?php echo $this->getColumnGetter($field->getName(), true); ?>) ?]</<?php echo $name ?>>
<?php endforeach; ?>
  </<?php echo $this->getSingularName() ?>>
[?php endforeach; ?]
</Root>
