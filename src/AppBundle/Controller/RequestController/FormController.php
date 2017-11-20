<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 5:32 PM
 */

namespace AppBundle\Controller\RequestController;

use AppBundle\Entity\RequestEntity;
use AppBundle\Form\RequestForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FormController extends Controller
{
    /**
     * @Route("photo/form", name = "photo-form")
     * @Route("video/form", name = "video-form")
     * @Route("b2b-marketing/form", name = "b2b-marketing-form")
     * @Route("marketing-sales/form", name = "marketing-sales-form")
     * @Route("package-design/form", name = "package-design-form")
     * @Route("product-design/form", name = "product-design-form")
     */
    public function renderForm(Request $request){
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($formData);
            $manager->flush();
//
//            $getCategory = $form->get('category')->getData();
//            dump($getCategory->get);
//            $reroute = str_replace("form","request-success",$request->getPathInfo());
//            $this->redirectToRoute($reroute,[],200);
        }

        return $this->render("FormView/RequestFormView.html.twig",[
            'form' => $form->createView()
        ]);
    }
}