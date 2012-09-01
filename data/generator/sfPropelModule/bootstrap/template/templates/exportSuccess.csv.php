[?php /* @var $<?php echo $this->getSingularName() ?> <?php echo $this->getSingularName() ?> */ ?]
[?php use_helper('I18N', 'Date') ?]
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
  <?php echo $this->renderExportField($field) ?>,
<?php endforeach; ?>
);
echo '"', implode('","', $exportedRow), '"', "\n";
?]
[?php endforeach; ?]
