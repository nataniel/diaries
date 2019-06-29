<?php
namespace Main\View;

use E4u\Application\View\Html as E4uView;
use E4u\Form\Builder\Bootstrap4;
use E4u\Form\Builder\Bootstrap41;
use Main\Controller\AbstractController;
use Main\Helper;
use Main\Model\User;
use E4u\Authentication\Identity;

/**
 * Class Base
 * @package Main\View
 */
class Base extends E4uView
{
    protected function registerHelpers()
    {
        $this->_helpers = array_merge($this->_helpers, [
        ]);

        parent::registerHelpers();
    }

    /**
     * @param \E4u\Form\Base $form
     * @param  bool $showLabels
     * @return Bootstrap41
     */
    public function createBootstrapForm($form, $showLabels = false)
    {
        return new Bootstrap41($form, $this, [
            'show_labels' => $showLabels,
            'current_locale' => $this->getLocale(),
        ]);
    }

    /**
     * @return \E4u\Application\Controller|AbstractController
     */
    public function getController()
    {
        return parent::getController();
    }
}