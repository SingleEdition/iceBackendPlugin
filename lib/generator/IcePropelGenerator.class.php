<?php

class IcePropelGenerator extends sfPropelGenerator
{

  /**
   * Gets extra parameters
   *
   * @param  boolean  $value
   * @return mixed
   */
  public function getExtra($value = false)
  {
    if (isset($this->params['extra']))
    {
      if ($value)
      {
        foreach ($this->params['extra'] as $val)
        {
          if ($val == $value) return true;
        }
        return false;
      }
      else return $this->params['extra'];
    }
    else return array();
  }

  /**
   * Returns Text for a Export field.
   *
   * @param sfModelGeneratorConfigurationField $field The field
   *
   * @return string Text
   */
  public function renderExportField($field)
  {
    $result = $this->getColumnGetter($field->getName(), true);

    if ($renderer = $field->getRenderer())
    {
      $result = sprintf($result." ? call_user_func_array(%s, array_merge(array(%s), %s)) : ''",
        $this->asPhp($renderer), $result, $this->asPhp($field->getRendererArguments()));
    }
    else if ($field->isComponent())
    {
      $result = sprintf("get_component('%s', '%s', array('type' => 'export', '%s' => \$%s))",
        $this->getModuleName(), $field->getName(), $this->getSingularName(), $this->getSingularName());
    }
    else if ($field->isPartial())
    {
      $result = sprintf("get_partial('%s/%s', array('type' => 'export', '%s' => \$%s))",
        $this->getModuleName(), $field->getName(), $this->getSingularName(), $this->getSingularName());
    }
    else if ('Date' == $field->getType())
    {
      $result = sprintf('false !== strtotime('.$result.") ? format_date(%s, \"%s\") : '&nbsp;'",
        $result, $field->getConfig('date_format', 'f'));
    }
    else if ('Boolean' == $field->getType())
    {
      $result = sprintf('(%s ? "yes" : "no")', $result);
    }

    return $result;
  }
}
