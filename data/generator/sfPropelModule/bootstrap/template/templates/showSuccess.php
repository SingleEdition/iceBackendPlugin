[?php /* @var $<?php echo $this->getSingularName() ?> <?php echo $this->getSingularName() ?> */ ?]
[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">
  <h1>[?php echo <?php echo $this->getI18NString('show.title') ?> ?]</h1>

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div id="sf_admin_content">
    [?php include_partial('<?php echo $this->getModuleName() ?>/show', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration, 'helper' => $helper)) ?]

    [?php include_partial('<?php echo $this->getModuleName() ?>/show_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </div>
</div>
