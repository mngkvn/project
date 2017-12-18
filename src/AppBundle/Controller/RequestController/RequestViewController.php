<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/24/17
 * Time: 7:36 PM
 */

namespace AppBundle\Controller\RequestController;


use AppBundle\Entity\RequestEntity;
use AppBundle\Service\PathService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function renderRequestView(Request $request ,RequestEntity $id){

        //no need to check if $Id is existing... not found will trigger automatically.

        /*
         * if view is rendered even it's not the same category
         * id : 708 category: photo
         *
         * if admin goes to /video/708, it will still render the form.
         * Resolution : redirect if not on the same category
         */

        if($id->getCategory() != str_replace('-view','',$request->attributes->get('_route'))){
            $path = new PathService();
            $viewPath = $path->pathSetRequestLink($id->getCategory());
            $viewURL = $this->generateUrl($viewPath, $request->attributes->get('_route_params'));
            return $this->redirect($viewURL);
        }

        return $this->render("RequestView/RequestView.html.twig",[
            "requestData" => $id
        ]);
    }
}