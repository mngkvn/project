<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/28/2017
 * Time: 11:55 AM
 */

namespace AppBundle\Controller\DefaultRouteController;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultRoute extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function renderHomepage(){
        return $this->render("base.html.twig");
    }
}