<?php
/**
 * Model generator.
 *
 * @package  iceBackendPlugin
 *
 * @see http://brentertainment.com/2010/07/25/sync-generator-yml-with-your-admin-module/
 */
class IcePropelSecurityGenerator extends sfPropelGenerator
{
  /**
   * Validates the basic structure of the parameters.
   *
   * @param array $params An array of parameters
   *
   * @return array|void
   * @throws sfException
   */
  protected function validateParameters($params)
  {
    parent::validateParameters($params);

    if (isset($this->params['use_security_yaml_credentials']) && $this->params['use_security_yaml_credentials'] && sfContext::hasInstance())
    {
      // Load YAML
      $path = sfConfig::get('sf_app_module_dir').'/'.sfContext::getInstance()->getRequest()->getParameter('module').'/config/security.yml';

      if (!file_exists($path))
      {
        throw new sfException("In order to use security.yml credentials, you must first create a security.yml file in your module's config directory");
      }

      include(sfContext::getInstance()->getConfigCache()->checkConfig($path));

      foreach ($this->config as $action => &$params)
      {
        // Set default values if necessary, fix action credentials
        switch ($action)
        {
          case 'list':
            if (!isset($params['actions']) || $params['actions'] === null)
            {
              $params['actions'] = array('_new' => null);
            }
            if (!isset($params['object_actions']) || $params['actions'] === null)
            {
              $params['object_actions'] = array('_edit' => null, '_delete' => null);
            }
            if (!isset($params['batch_actions']) || $params['actions'] === null)
            {
              $params['batch_actions'] = array('_delete' => null);
            }

            foreach ($params['actions'] as $action => $parameters)
            {
              $params['actions'][$action] = $this->fixActionCredentials($action, $parameters);
            }

            foreach ($params['object_actions'] as $action => $parameters)
            {
              $params['object_actions'][$action] = $this->fixActionCredentials($action, $parameters);
            }

            foreach ($params['batch_actions'] as $action => $parameters)
            {
              $params['batch_actions'][$action] = $this->fixActionCredentials($action, $parameters);
            }

            break;

          case 'form':
            if (!isset($params['actions']) || $params['actions'] === null)
            {
              $params['actions'] = array('_delete' => null, '_list' => null, '_save' => null, '_save_and_add' => null);
            }

            foreach ($params['actions'] as $action => $parameters)
            {
              $params['actions'][$action] = $this->fixActionCredentials($action, $parameters);
            }
            break;

          case 'actions':
            if (is_array($params))
            {
              foreach ($params as $action => $parameters)
              {
                $params[$action] = $this->fixActionCredentials($action, $parameters);
              }
            }

          default:
            if (isset($params['actions']) && is_array($params['actions']))
            {
              foreach ($params['actions'] as $action => $parameters)
              {
                $params['actions'][$action] = $this->fixActionCredentials($action, $parameters);
              }
            }
            break;
        }
      }
    }

    return $params;
  }

  /**
   * Fix an action to use the credentials specified in the security.yml or for parameter "all"
   * in the module
   *
   * @param string $action
   * @param string $params
   *
   * @return array|string $params - the parameters with fixed credentials
   */
  protected function fixActionCredentials($action, $params)
  {
    $actionAction = isset($params['action']) ? $params['action'] : (strpos($action, '_') === 0 ? substr($action, 1) : $action);
    if(isset($this->security[$actionAction]['credentials']))
    {
      $params['credentials'] = $this->security[$actionAction]['credentials'];
    }
    elseif(isset($this->security['all']['credentials']) && $this->security['all']['credentials']
          && (!isset($this->security[$actionAction]['is_secure']) || $this->security[$actionAction]['is_secure']))
    {
      // If "All" credentials are set and the route is secure, set the credential accordingly
      $params['credentials'] = $this->security['all']['credentials'];
    }
    return $params;
  }
}
