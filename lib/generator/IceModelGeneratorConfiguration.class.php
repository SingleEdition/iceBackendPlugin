<?php
/**
 * File: IceModelGeneratorConfiguration.class.php
 *
 * @author zecho
 * @version $Id$
 *
 */

abstract class IceModelGeneratorConfiguration extends sfModelGeneratorConfiguration
{

  abstract public function getExportDisplay();

  abstract public function getFieldsExport();

  abstract public function getShowDisplay();

  abstract public function getFieldsShow();

  abstract public function getShowActions();

  abstract public function getShowTitle();

  protected function compile()
  {
    parent::compile();

    $config = $this->getConfig();

    $this->configuration['export'] = array(
      'fields' => array(),
    );

    $this->configuration['show'] = array(
      'fields' => array(),
      'title'  => $this->getShowTitle(),
      'actions'=> $this->getShowActions() ? : $this->getListActions(),
    );

    foreach (array_keys($config['default']) as $field)
    {
      $this->configuration['export']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge(array('label' => sfInflector::humanize(sfInflector::underscore($field))), $config['default'][$field], isset($config['export'][$field]) ? $config['export'][$field] : array()));
      $this->configuration['show']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge(array('label' => sfInflector::humanize(sfInflector::underscore($field))), $config['default'][$field], isset($config['show'][$field]) ? $config['show'][$field] : array()));
    }

    // "virtual" fields for export
    foreach ($this->getExportDisplay() as $field)
    {
      list($field, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($field);

      $this->configuration['export']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge(
        array(
          'type'  => 'Text',
          'label' => sfInflector::humanize(sfInflector::underscore($field))
        ),
        isset($config['default'][$field]) ? $config['default'][$field] : array(),
        isset($config['export'][$field]) ? $config['export'][$field] : array(),
        array('flag' => $flag)
      ));
    }

    // "virtual" fields for show
    foreach ($this->getShowDisplay() as $field)
    {
      list($field, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($field);

      $this->configuration['show']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge(
        array(
          'type'  => 'Text',
          'label' => sfInflector::humanize(sfInflector::underscore($field))
        ),
        isset($config['default'][$field]) ? $config['default'][$field] : array(),
        isset($config['show'][$field]) ? $config['show'][$field] : array(),
        array('flag' => $flag)
      ));
    }

    foreach ($this->configuration['show']['actions'] as $action => $parameters)
    {
      $this->configuration['show']['actions'][$action] = $this->fixActionParameters($action, $parameters);
    }

    // export field configuration
    $this->configuration['export']['display'] = array();
    foreach ($this->getExportDisplay() as $name)
    {
      list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
      if (!isset($this->configuration['export']['fields'][$name]))
      {
        throw new InvalidArgumentException(sprintf('The field "%s" does not exist.', $name));
      }
      $field = $this->configuration['export']['fields'][$name];
      $field->setFlag($flag);
      $this->configuration['export']['display'][$name] = $field;
    }

    // show field configuration
    $this->configuration['show']['display'] = array();
    foreach ($this->getShowDisplay() as $name)
    {
      list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
      if (!isset($this->configuration['show']['fields'][$name]))
      {
        throw new InvalidArgumentException(sprintf('The field "%s" does not exist.', $name));
      }
      $field = $this->configuration['show']['fields'][$name];
      $field->setFlag($flag);
      $this->configuration['show']['display'][$name] = $field;
    }

    $this->parseVariables('show', 'title');

    // action credentials
    $this->configuration['credentials']['export'] = array();
    $this->configuration['credentials']['show'] = array();
  }

  protected function getConfig()
  {
    $config = parent::getConfig();
    $config['export'] = $this->getFieldsExport();
    $config['show'] = $this->getFieldsShow();

    return $config;
  }

}
