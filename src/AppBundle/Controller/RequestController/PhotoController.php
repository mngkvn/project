<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/7/17
 * Time: 11:54 PM
 */

namespace AppBundle\Controller\RequestController;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhotoController extends Controller
{
    /**
     * @Route("photoRequestList", name = "photoRequestList")
     */
    public function renderList(){
        $getManager = $this->getDoctrine()->getManager();
        $getEntity = $getManager->getRepository("AppBundle:RequestEntity\PhotoRequestEntity");
        $getData = $getEntity->findAll();

        return $this->render(":RequestView/PhotoView:photoRequestList.html.twig",[
            "photoRequest" => $getData
        ]);
    }
}