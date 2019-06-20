<?php
namespace Main\Controller;

use E4u\Application\Controller as E4uController;
use E4u\Application\View as E4uView;
use Main\Configuration;
use Main\View;
use Rebel\Nav\Client;

abstract class AbstractController extends E4uController
{
    protected $defaultLayout = 'layout/default';
    protected $viewClass = View\Base::class;

    /** @var Client */
    private $client;

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
     * @return Client
     */
    protected function getNavClient()
    {
        if (null === $this->client) {
            $nav = Configuration::navConfig();
            $this->client = new Client($nav);
        }

        return $this->client;
    }
}