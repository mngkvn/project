<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/24/17
 * Time: 7:36 PM
 */

namespace AppBundle\Controller\RequestController;


use AppBundle\Entity\RequestEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RequestViewController extends Controller
{

    /**
     * @Route("photo/{id}",name="photo-view",requirements={"id" : "\d+"})
     * @Route("video/{id}",name="video-view",requirements={"id" : "\d+"})
     * @Route("business-to-business/{id}",name="business-to-business-view",requirements={"id" : "\d+"})
     * @Route("marketing-sales/{id}",name="marketing-sales-view",requirements={"id" : "\d+"})
     * @Route("product-design/{id}",name="product-design-view",requirements={"id" : "\d+"})
     * @Route("package-design/{id}",name="package-design-view",requirements={"id" : "\d+"})
     */
    public function renderRequestView(RequestEntity $id){
        if($id){
            return $this->render("RequestView/RequestView.html.twig",[
                "requestData" => $id
            ]);
        }else{
            throw new NotFoundHttpException("Request not found.");
        }
    }
}