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

  public function hasShowAction()
  {
    return isset($this->params['with_show']) && true == $this->params['with_show'];
  }

  /**
   * Returns HTML code for a field.
   *
   * @param sfModelGeneratorConfigurationField $field The field
   *
   * @return string HTML code
   */
  public function renderField($field)
  {
    $html = $this->getColumnGetter($field->getName(), true);

    if ($renderer = $field->getRenderer())
    {
      $html = sprintf("$html ? call_user_func_array(%s, array_merge(array(%s), %s)) : '&nbsp;'", $this->asPhp($renderer), $html, $this->asPhp($field->getRendererArguments()));
    }
    else if ($field->isComponent())
    {
      return sprintf("get_component('%s', '%s', array('type' => 'list', '%s' => \$%s))", $this->getModuleName(), $field->getName(), $this->getSingularName(), $this->getSingularName());
    }
    else if ($field->isPartial())
    {
      return sprintf("get_partial('%s', array('type' => 'list', '%s' => \$%s))", $field->getName(), $this->getSingularName(), $this->getSingularName());
    }
    else if ('Date' == $field->getType())
    {
      $html = sprintf("false !== strtotime($html) ? format_date(%s, \"%s\") : '&nbsp;'", $html, $field->getConfig('date_format', 'f'));
    }
    else if ('Boolean' == $field->getType())
    {
      $html = sprintf("get_partial('%s/list_field_boolean', array('value' => %s))", $this->getModuleName(), $html);
    }

    if ($field->isLink())
    {
      $html = sprintf("link_to(%s, '%s', \$%s)", $html, $this->getUrlForAction($this->hasShowAction() ? 'show' : 'edit'), $this->getSingularName());
    }

    return $html;
  }

  /**
   * Returns the getter either non-developped: 'getFoo' or developped: '$class->getFoo()'.
   *
   * @param string  $column     The column name
   * @param boolean $developed  true if you want developped method names, false otherwise
   * @param string  $prefix     The prefix value
   *
   * @return string PHP code
   */
  public function getColumnGetter($column, $developed = false, $prefix = '')
  {
    try
    {
      $getter = 'get' . call_user_func(array(constant($this->getModelClass() . '::PEER'), 'translateFieldName'), $column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
    }
    catch (PropelException $e)
    {
      // not a real column
      $prefix = '';
      if ('count' == substr($column, 0, 5))
      {
        $getter = lcfirst(sfInflector::camelize($column));
      }
      else if (false !== strpos($column, '.'))
      {
        $parts = array();
        foreach (explode('.', $column) as $subgetter)
        {
          $parts[] = 'get' . sfInflector::camelize($subgetter);
        }
        $getter = implode('()->', $parts);
      }
      else
      {
//        $prefix = 'get';
        $getter = $prefix . 'get' .sfInflector::camelize($column);
      }
    }

    if (!$developed)
    {
      return $getter;
    }

    return sprintf('$%s%s->%s()', $prefix, $this->getSingularName(), $getter);
  }

}
