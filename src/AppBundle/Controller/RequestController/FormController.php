<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 5:32 PM
 */

namespace AppBundle\Controller\RequestController;

use AppBundle\Form\PhotoRequestForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FormController extends Controller
{
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
     * @Route("video/request/form", name = "videoRequestForm")
     */
    public function renderVideoRequestForm(Request $request){

    }
}