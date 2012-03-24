[?php /* @var $<?php echo $this->getSingularName() ?> <?php echo $this->getSingularName() ?> */ ?]
<?php /* Labels */ ?>
[?php $labels = array(
<?php foreach ($this->configuration->getValue('export.display') as $name=> $field): ?>
'<?php echo $field->getConfig('label', '', true); ?>',
<?php endforeach; ?>
); echo implode(',', $labels), "\n";
?]
<?php /* Values */ ?>
[?php foreach ($pager->getResults() as $i=>$<?php echo $this->getSingularName(); ?>): ?]
[?php $exportedRow = array(
<?php foreach ($this->configuration->getValue('export.display') as $name=> $field): ?>
  str_replace("'", "\\'", <?php echo $this->getColumnGetter($field->getName(), true); ?>),
<?php endforeach; ?>
);
echo '"', implode('","', $exportedRow), '"', "\n";
?]
[?php endforeach; ?]
