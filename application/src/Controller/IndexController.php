<?php
namespace Main\Controller;

class IndexController extends AbstractController
{
    public function indexAction()
    {

    }

    public function resetAction()
    {
        $cacheDriver = \E4u\Loader::getDoctrine()->getConfiguration()->getMetadataCacheImpl();
        $cacheDriver->deleteAll();
        return $this->redirectTo('/', 'Pamięć cache została wyczyszczona.');
    }
}