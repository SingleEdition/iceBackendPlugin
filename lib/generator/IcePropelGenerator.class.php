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
}
