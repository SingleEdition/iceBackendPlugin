<?php

function link_to_frontend($name, $routeName, $params, $options = array())
{
  return link_to($name, url_for_frontend($routeName, $params), $options);
}

function url_for_frontend($name, $parameters)
{
  /** @var $application backendConfiguration */
  $application = sfProjectConfiguration::getActive();

  return $application->generateFrontendUrl($name, $parameters);
}

/**
 * @depricated
 *
 * @param $name
 * @param $parameters
 *
 * @return mixed
 */
function url_to_frontend($name, $parameters)
{
  return url_for_frontend($name, $parameters);
}
