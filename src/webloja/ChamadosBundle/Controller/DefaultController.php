<?php

namespace webloja\ChamadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ChamadosBundle:Default:index.html.twig', array('name' => $name));
    }
}
