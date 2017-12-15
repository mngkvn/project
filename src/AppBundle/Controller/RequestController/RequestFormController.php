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
use AppBundle\Service\PathService;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

class RequestFormController extends Controller
{

    /**
     * @Route("photo/form", name = "photo-form")
     * @Route("video/form", name = "video-form")
     * @Route("business-to-business/form", name = "business-to-business-form")
     * @Route("marketing-sales/form", name = "marketing-sales-form")
     * @Route("package-design/form", name = "package-design-form")
     * @Route("product-design/form", name = "product-design-form")
     */
    public function renderForm(Request $request){
        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(RequestForm::class,null,[
            "validation_groups" => "addRequest",
            "requestMethod" => 'requesting'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ORMException $exception) {
                throw new ConflictHttpException("Failed to insert request.");
            }
        }

        return $this->render("FormView/RequestFormView.html.twig",[
            'form' => $form->createView(),
            'requestMethod' => 'requesting'
        ]);
    }

    /**
     * @param Request $request
     * @param RequestEntity $id
     * @Route("photo/{id}/edit", name = "photo-edit")
     * @Route("video/{id}/edit", name = "video-edit")
     * @Route("business-to-business/{id}/edit", name = "business-to-business-edit")
     * @Route("marketing-sales/{id}/edit", name = "marketing-sales-edit")
     * @Route("package-design/{id}/edit", name = "package-design-edit")
     * @Route("product-design/{id}/edit", name = "product-design-edit")
     */
    public function renderEditForm(Request $request, RequestEntity $id){
        /*
         * if no $id entry found, it will automatically redirect to NotFound
         */
        $form = $this->createForm(
            RequestForm::class,
            $id,
            [
                "adminId" => $this->getUser()->getId(),
                "username" => $this->getUser()->getUsername(),
                "validation_groups" => "editRequest",
                "requestMethod" => "editing"
            ]
        );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
//                //viewURL returns ex. photo/921/edit to photo/921;

                $path = new PathService();
                $newPath = $path->pathSetRequestLink($form->get('category')->getData());
                $viewURL = $this->generateUrl($newPath,$request->attributes->get('_route_params'));
                return $this->redirect($viewURL);
            } catch (ORMException $exception) {
//                create exception or reroute
                throw new ConflictHttpException("Failed to update the request.");
            }
        }

        //for the otherPlatform input, need to pass a string instead of a json array
        return $this->render("FormView/RequestFormView.html.twig",[
            'form' => $form->createView(),
            'requestData' => $id,
            'requestMethod' => 'editing'
        ]);
    }
}