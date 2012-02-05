<?php

class BaseIceBackendModuleActions extends IceBackendActions
{
 /**
  * Executes the index action, which shows a list of all available modules
  *
  * @return string
  */
  public function executeDashboard()
  {
    $this->items = iceBackendModule::getItems();
    $this->categories = iceBackendModule::getCategories();

    return sfView::SUCCESS;
  }

  public function executeGodAuth(sfWebRequest $request)
  {
    list($secret, $timeout) = array_values(sfConfig::get('app_ice_backend_god_auth'));

    $id = $this->getUser()->getOpenId();
    $roles = implode(',', $this->getUser()->getGroupNames());

    if (empty($roles))
    {
      $roles = 'guest';
    }

    $value = $id .'-'. $roles .'-'. time();
    $cookie = $value .'-'. hash_hmac('sha1', $value .'-'. $_SERVER['HTTP_USER_AGENT'], $secret);

    setcookie("ga", $cookie, time() + $timeout, "/", ".". sfConfig::get('app_domain_name'), 0, 1);

    $this->redirect($request->getParameter('ref', '@homepage'));
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
    $open_id = $this->getUser()->getOpenId();
    $this->getUser()->setAuthenticated(false);

    if (!empty($open_id))
    {
      return $this->redirect('https://mail.google.com/mail/u/0/?logout&hl=en');
    }

    return $this->redirect('@homepage');
  }

  /**
   * @return string|void
   */
  public function executeOpenId()
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->redirect('@homepage');
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

  /**
   * @return string
   */
  public function executeError404()
  {
    return sfView::SUCCESS;
  }

  /**
   * @return string
   */
  public function executeError500()
  {
    return sfView::SUCCESS;
  }
}
