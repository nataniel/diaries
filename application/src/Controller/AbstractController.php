<?php
namespace Main\Controller;

use E4u\Application\Controller as E4uController;
use E4u\Application\View as E4uView;
use Main\Configuration;
use Main\Helper\UUID;
use Main\View;

abstract class AbstractController extends E4uController
{
    protected $defaultLayout = 'layout/default';
    protected $viewClass = View\Base::class;
    protected $uuid;

    public function init($action)
    {
        if (Configuration::isSSLRequired() && !$this->getRequest()->isSSL()) {
            return $this->redirectTo('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        }

        return null;
    }

    /**
     * @return View\Base|E4uView
     */
    public function getView()
    {
        return parent::getView();
    }

    /**
     * @return UUID
     */
    public function getUUID()
    {
        if (is_null($this->uuid)) {
            $this->uuid = new UUID($this->getRequest()->getBaseUrl());
        }

        return $this->uuid;
    }
}