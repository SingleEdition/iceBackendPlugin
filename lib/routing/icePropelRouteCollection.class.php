<?php
/**
 * File: icePropelRouteCollection.class.php
 *
 * @package iceBackendPlugin
 * @subpackage routing
 * @author zecho
 * @version $Id$
 *
 */

class icePropelRouteCollection extends sfPropelRouteCollection
{

  public function __construct(array $options)
  {
    $options = array_merge(array(
      'with_export' => true,
    ), $options);

    parent::__construct($options);
  }

  protected function generateRoutes()
  {
    parent::generateRoutes();

    if ($this->options['with_export'])
    {
      $routeName = $this->options['name'].'_export';

      $this->routes[$routeName] = $this->getRouteForExport();
    }
  }

  protected function getRouteForExport()
  {
    $url = sprintf(
      '%s/export.:sf_format',
      $this->options['prefix_path']
    );

    $params = array(
      'module' => $this->options['module'],
      'action' => 'export',
      'sf_format' => 'csv'
    );

    $requirements = array('sf_method' => array('get', 'post'));

    $options = array(
      'model' => $this->options['model'],
      'type' => 'list',
    );

    return new $this->routeClass(
      $url,
      $params,
      $requirements,
      $options
    );
  }

}
