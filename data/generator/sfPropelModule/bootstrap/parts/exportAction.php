  public function executeExport(sfWebRequest $request)
  {
    $fileName = sprintf('%s_export_%s.%s', '<?php echo strtolower($this->getPluralName()) ?>', date('Y_m_d_(hi)'), $request->getParameter('sf_format'));

    $this->response = $this->getResponse();

    //sfConfig::set('sf_web_debug', false);
    //$this->response->setHttpHeader('Expires', 0);
  //$this->response->setHttpHeader('Cache-control', 'private');
  //$this->response->setHttpHeader('Cache-Control', 'private, must-revalidate, post-check=0, pre-check=0');
  //$this->response->setHttpHeader('Content-Description', 'File Transfer');
  //$this->response->setHttpHeader('Content-Type', 'text/csv, charset=UTF-8; encoding=UTF-8');
  //$this->response->setHttpHeader('Content-disposition', 'attachment; filename=' . $fileName);

    $this->setLayout(false);


    // sorting
    if ($request->getParameter('sort'))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_direction')));
    }

    if (is_null($this->criteria))
    {
      $this->criteria = $this->buildQuery();
      $this->criteria->setOffset(0);
      $this->criteria->setLimit(0);
    }

  }
