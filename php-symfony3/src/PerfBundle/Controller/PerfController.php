<?php

namespace PerfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PerfController extends Controller
{
    public function indexAction()
    {
        return $this->render('PerfBundle:Default:index.html.twig');
    }
}
