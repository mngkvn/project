<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/7/17
 * Time: 11:54 PM
 */

namespace AppBundle\Controller\RequestController;


use AppBundle\Entity\RequestEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhotoController extends Controller
{
    /**
     * @Route("photo/list", name = "photo-list")
     */
    public function renderPhotoRequestList()
    {
        $getManager = $this->getDoctrine()->getManager();
        $getEntity = $getManager->getRepository("AppBundle:RequestEntity");
        $getData = $getEntity->findAll();

        return $this->render("photoList.twig",[
            "photoRequest" => $getData
        ]);
    }

    /**
     * @Route("photo/{id}", name = "photo-view")
     * @Method("GET")
     */
    public function renderPhotoRequestView(RequestEntity $id)
    {
//        dump(count($id));
//        $getManager = $this->getDoctrine()->getManager();
//        $getEntity = $getManager->getRepository("AppBundle:RequestEntity\PhotoRequestEntity");
//        $getData = $getEntity->findOneBy(['id' => $id]);

        return $this->render("photoView.twig",[
            'data' => $id,
        ]);
    }

}