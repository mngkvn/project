<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/28/2017
 * Time: 11:55 AM
 */

namespace AppBundle\Controller\MainRouteController;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\AdminEntity;
use AppBundle\Entity\RequestEntity;
use AppBundle\Form\RequestForm;
use AppBundle\Service\PathService;
use Doctrine\ORM\ORMException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

class MainRouteController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function renderHomepage(){
        return $this->render("MainView/HomePageView.html.twig");
    }

    /**
     * @Route("/photo-and-video",name="photo-and-video")
     */
    public function renderPhotoAndVideo(Request $request){

        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(RequestForm::class, null, [
            "validation_groups" => "addRequest",
            "requestMethod" => 'requesting'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ConflictHttpException $exception) {
                throw $exception;
            }
        }

        return $this->render('MainView/PhotoAndVideoView.html.twig',[
            'form' => $form->createView(),
            'requestMethod' => 'requesting'
        ]);
    }

    /**
     * @Route("/business-to-business",name="business-to-business")
     */
    public function renderBusinessToBusiness(Request $request)
    {
        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(RequestForm::class, null, [
            "validation_groups" => "addRequest",
            "requestMethod" => 'requesting'
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                try {
                    $formData = $form->getData();
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($formData);
                    $manager->flush();
                    return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
                } catch (ConflictHttpException $exception) {
                    throw $exception;
                }
            }
        }

        return $this->render('MainView/BusinessToBusinessView.html.twig',[
            'form' => $form->createView(),
            'requestMethod' => 'requesting'
        ]);
    }

    /**
     * @Route("/marketing-sales",name="marketing-sales")
     */
    public function renderMarketingSales(Request $request){
        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(RequestForm::class, null, [
            "validation_groups" => "addRequest",
            "requestMethod" => 'requesting'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ConflictHttpException $exception) {
                throw $exception;
            }
        }

        return $this->render('MainView/MarketingSalesView.html.twig',[
            'form' => $form->createView(),
            'requestMethod' => 'requesting'
        ]);
    }

    /**
     * @Route("/package-design",name="package-design")
     */
    public function renderPackageDesign(Request $request){
        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(RequestForm::class, null, [
            "validation_groups" => "addRequest",
            "requestMethod" => 'requesting'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ConflictHttpException $exception) {
                throw $exception;
            }
        }

        return $this->render('MainView/PackageDesignView.html.twig',[
            'form' => $form->createView(),
            'requestMethod' => 'requesting'
        ]);
    }

    /**
     * @Route("/product-design",name="product-design")
     */
    public function renderProductDesign(Request $request){
        $newRoute = $this->get("app.path_service");
        $form = $this->createForm(RequestForm::class, null, [
            "validation_groups" => "addRequest",
            "requestMethod" => 'requesting'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $formData = $form->getData();
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($formData);
                $manager->flush();
                return $this->redirectToRoute($newRoute->pathRequestSuccess($request->getPathInfo()));
            } catch (ConflictHttpException $exception) {
                throw $exception;
            }
        }

        return $this->render('MainView/ProductDesignView.html.twig',[
            'form' => $form->createView(),
            'requestMethod' => 'requesting'
        ]);
    }

    /**
     * @Route("/contact",name="contact")
     */
    public function renderContact(){
        return $this->render("MainView/ContactView.html.twig");
    }

    /**
     * @Route("/about",name="about")
     */
    public function renderAbout(){
        return $this->render("MainView/AboutView.html.twig");
    }
}