<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 5:32 PM
 */

namespace AppBundle\Controller\RequestController;

use AppBundle\Entity\AdminEntity;
use AppBundle\Entity\RequestEntity;
use AppBundle\Form\RequestForm;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

class RequestFormController extends Controller
{

    /**
     * @Route("photo/form", name = "photo-form")
     * @Route("video/form", name = "video-form")
     * @Route("business-to-business-marketing/form", name = "business-to-business-marketing-form")
     * @Route("marketing-sales/form", name = "marketing-sales-form")
     * @Route("package-design/form", name = "package-design-form")
     * @Route("product-design/form", name = "product-design-form")
     */
    public function renderForm(Request $request){
        $newRoute = $this->get("app.path_service",$this->getUser());
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
     * @Route("business-to-business-marketing/{id}/edit", name = "business-to-business-marketing-edit")
     * @Route("marketing-sales/{id}/edit", name = "marketing-sales-edit")
     * @Route("package-design/{id}/edit", name = "package-design-edit")
     * @Route("product-design/{id}/edit", name = "product-design-edit")
     */
    public function renderEditForm(Request $request, RequestEntity $id){
        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(
            RequestForm::class,
            $id,
            [
                "userId" => $this->getUser()->getId(),
                "username" => $this->getUser()->getUsername(),
                "userEmail" => $this->getUser()->getEmail()
            ]
        );

        dump($form->getData());

//        $form->handleRequest($request);

//        if($request->isMethod("POST")){
//            $form->submit($id->getCategory());
//        }
//        $oldCategory = $id->getCategory();
//        $newCategory = $form["moveCategory"]->getData();
//        $oldStatus = $id->getIsActive();
//        $newStatus = $form["changeIsActive"]->getData();
//
//        $updatedCategory = $oldCategory != $newCategory ? $newCategory ? $newCategory : $oldCategory : $oldCategory;
//        $updatedStatus = $oldStatus != $newStatus ? $newStatus : $oldStatus;

        //update the entity fields

        if($form->isSubmitted()){
            dump($form->getData());
//            return;
            try {
//                $id->setCategory($updatedCategory);
//                $id->setIsActive($updatedStatus);
//
//                $form->remove("moveCategory");
//                $form->remove("changeIsActive");
//                dump($form->getData());
//                $formData = $form->getData();
//                $manager = $this->getDoctrine()->getManager();
//                $manager->persist($formData);
//                $manager->flush();
//                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ORMException $exception) {
//                create exception or reroute
                dump($exception);
            }
        }

        return $this->render("FormView/RequestFormView.html.twig",[
            'form' => $form->createView(),
            'requestId' => $id->getId()
        ]);
    }
}