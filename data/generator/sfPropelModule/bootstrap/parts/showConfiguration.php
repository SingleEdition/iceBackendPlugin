public function hasShowAction()
{
return <?php echo $this->asPhp(isset($this->params['with_show']) ? $this->params['with_show'] : false); ?>;
<?php unset($this->params['with_show']); ?>
}

public function getShowDisplay()
{
<?php if (isset($this->config['show']['display'])): ?>
return <?php echo $this->asPhp($this->config['show']['display']) ?>;
<?php else: ?>
return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['show']['display']) ?>
}

public function getShowParams()
{
return <?php echo $this->asPhp(isset($this->config['show']['params']) ? $this->config['show']['params'] : '%%' . implode('%% - %%', isset($this->config['show']['display']) ? $this->config['show']['display'] : $this->getAllFieldNames(false)) . '%%') ?>;
<?php unset($this->config['show']['params']) ?>
}

public function getShowTitle()
{
return '<?php echo $this->escapeString(isset($this->config['show']['title']) ? $this->config['show']['title'] : 'Show ' . sfInflector::humanize($this->getModuleName())) ?>';
<?php unset($this->config['show']['title']) ?>
}


public function getShowActions()
{
return <?php echo $this->asPhp(isset($this->config['show']['actions']) ? $this->config['show']['actions'] : array(
  '_delete'=> null,
  '_edit'  => null,
  '_list'  => null,
)) ?>;
<?php unset($this->config['show']['actions']) ?>
}

