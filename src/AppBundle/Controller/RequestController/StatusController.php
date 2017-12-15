<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/20/17
 * Time: 12:29 AM
 */

namespace AppBundle\Controller\RequestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

class StatusController extends Controller
{
    /**
     * @Route("photo/request-success", name="photo-request-success")
     * @Route("video/request-success", name="video-request-success")
     * @Route("business-to-business/request-success", name="business-to-business-request-success")
     * @Route("marketing-sales/request-success", name="marketing-sales-request-success")
     * @Route("package-design/request-success", name="package-design-request-success")
     * @Route("product-design/request-success", name="product-design-request-success")
     */
    public function renderStatus(){
        return $this->render('StatusView/StatusView.html.twig');
    }
}