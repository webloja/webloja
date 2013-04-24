<?php

namespace webloja\MerchanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MerchenBundle:Default:index.html.twig', array('name' => $name));
    }
}
