<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/7/17
 * Time: 11:54 PM
 */

namespace AppBundle\Controller\RequestController;


use AppBundle\Form\PhotoRequestForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PhotoController extends Controller
{
    /**
     * @Route("photo/request/list", name = "photoRequestList")
     */
    public function renderPhotoRequestList()
    {
        $getManager = $this->getDoctrine()->getManager();
        $getEntity = $getManager->getRepository("AppBundle:RequestEntity\PhotoRequestEntity");
        $getData = $getEntity->findAll();

        return $this->render(":RequestView/PhotoView:photoRequestList.html.twig",[
            "photoRequest" => $getData
        ]);
    }

    /**
     * @Route("photo/request/form", name = "photoRequestForm")
     */
    public function renderPhotoRequestForm(Request $request){
        $form = $this->createForm(PhotoRequestForm::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/PhotoForm.html.twig",[
            'photoRequestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("photo/request/{id}", name = "photoRequestView")
     */
    public function renderPhotoRequestView($id)
    {
        $getManager = $this->getDoctrine()->getManager();
        $getEntity = $getManager->getRepository("AppBundle:RequestEntity\PhotoRequestEntity");
        $getData = $getEntity->findOneBy(['id' => $id]);

        return $this->render("RequestView/PhotoView/photoRequestView.html.twig",[
            'data' => $getData,
        ]);
    }

}