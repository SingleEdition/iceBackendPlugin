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

  protected function compile()
  {
    parent::compile();

    $config = $this->getConfig();

    $this->configuration['export'] = array(
      'fields' => array(),
    );

    foreach (array_keys($config['default']) as $field)
    {
      $this->configuration['export']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge(array('label' => sfInflector::humanize(sfInflector::underscore($field))), $config['default'][$field], isset($config['export'][$field]) ? $config['export'][$field] : array()));
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

    // action credentials
    $this->configuration['credentials']['export'] = array();
  }

  protected function getConfig()
  {
    $config = parent::getConfig();
    $config['export'] = $this->getFieldsExport();

    return $config;
  }

}
