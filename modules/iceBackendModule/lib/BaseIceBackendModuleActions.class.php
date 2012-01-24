<?php

class BaseIceBackendModuleActions extends sfActions
{
 /**
  * Executes the index action, which shows a list of all available modules
  */
  public function executeDashboard()
  {
    $this->items = iceBackendModule::getItems();
    $this->categories = iceBackendModule::getCategories();

    return sfView::SUCCESS;
  }

  public function executeSignIn()
  {
    if (!$this->getUser()->isAuthenticated())
    {
      $url = $this->generateUrl('ice_backend_openid', array(), true);
      $url = str_replace(
        array('.dev//', '.com//', '.bg//', '.net//', '.dev/', '.com/', '.bg/', '.net/'),
        array('.dev:80/', '.com:80/', '.bg:80/', '.net:80/', '.dev:80/', '.com:80/', '.bg:80/', '.net:80/'),
        $url
      );
      $redirect = $this->getUser()->beginAuthentication($url, $url);

      return ($redirect) ? $this->redirect($redirect) : sfView::ERROR;
    }

    return $this->redirect('@homepage');
  }

  public function executeSignOut()
  {
    $this->getUser()->setAuthenticated(false);

    return $this->redirect('@homepage');
  }

  public function executeOpenId()
  {
    if ($this->getUser()->isAuthenticated())
    {
      return $this->redirect('@homepage');
    }

    $url = $this->generateUrl('ice_backend_openid', array(), true);
    $url = str_replace(
      array('.dev//', '.com//', '.bg//', '.net//', '.dev/', '.com/', '.bg/', '.net/'),
      array('.dev:80/', '.com:80/', '.bg:80/', '.net:80/', '.dev:80/', '.com:80/', '.bg:80/', '.net:80/'),
      $url
    );

    $this->openid = $this->getUser()->completeAuthentication($url);

    return ($this->openid === true) ? $this->redirect('@homepage') : sfView::ERROR;
  }

  public function executeError404()
  {
    return sfView::SUCCESS;
  }

  public function executeError500()
  {
    return sfView::SUCCESS;
  }
}
