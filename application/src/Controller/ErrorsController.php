<?php
namespace Main\Controller;

use E4u\Application\Controller\Errors as E4uErrors;

class ErrorsController extends AbstractController implements E4uErrors
{
    protected $defaultLayout = 'layout/security';
    
    public function notFoundAction()
    {
        return [ 'title' => '404 Not Found', ];
    }

    public function invalidAction()
    {
        return [ 'title' => '50x Invalid Action', ];
    }
}