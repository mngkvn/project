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
use AppBundle\Service\PathService;
use Doctrine\ORM\ORMException;
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
        $newRoute = new PathService();
        $form = $this->createForm(RequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ORMException $exception) {
//                create exception or reroute
                dump($exception);
            }
        }

        return $this->render("FormView/RequestFormView.html.twig",[
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param RequestEntity $id
     * @Route("photo/{id}/edit", name = "photo-edit")
     * @Route("video/{id}/edit", name = "video-edit")
     * @Route("b2b-marketing/{id}/edit", name = "b2b-marketing-edit")
     * @Route("marketing-sales/{id}/edit", name = "marketing-sales-edit")
     * @Route("package-design/{id}/edit", name = "package-design-edit")
     * @Route("product-design/{id}/edit", name = "product-design-edit")
     */
    public function renderEditForm(Request $request, RequestEntity $id){
        $newRoute = new PathService();
        $form = $this->createForm(RequestForm::class,$id);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ORMException $exception) {
//                create exception or reroute
                dump($exception);
            }
        }

        return $this->render("FormView/RequestFormView.html.twig",[
            'form' => $form->createView()
        ]);
    }
}