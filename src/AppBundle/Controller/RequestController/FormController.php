<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 5:32 PM
 */

namespace AppBundle\Controller\RequestController;

use AppBundle\Form\RequestForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FormController extends Controller
{
    /**
     * @Route("photo/form", name = "photo-form")
     */
    public function renderPhotoRequestForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($formData);
            $manager->flush();
//            $this->addFlash('success','Photo request inserted!');
            return $this->redirectToRoute("photo-form");
        }
        return $this->render("FormView/RequestFormView.html.twig",[
            'requestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("video/form", name = "video-form")
     */
    public function renderVideoRequestForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/RequestFormView.html.twig",[
            'requestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("b2b-marketing/form", name = "b2b-marketing-form")
     */
    public function renderB2BMarketingRequestForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/RequestFormView.html.twig",[
            'requestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("marketing-sales/form", name = "marketing-sales-form")
     */
    public function renderMarketingSalesRequestForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/RequestFormView.html.twig",[
            'requestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("package-design/form", name = "package-design-form")
     */
    public function renderPackageDesignRequestForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/RequestFormView.html.twig",[
            'requestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("product-design/form", name = "product-design-form")
     */
    public function renderProductDesignRequestForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/RequestFormView.html.twig",[
            'requestForm' => $form->createView()
        ]);
    }
}