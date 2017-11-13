<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 5:32 PM
 */

namespace AppBundle\Controller\RequestController;

use AppBundle\Form\B2BMarketingRequestForm;
use AppBundle\Form\MarketingSalesRequestForm;
use AppBundle\Form\PackageDesignRequestForm;
use AppBundle\Form\PhotoRequestForm;
use AppBundle\Form\ProductDesignRequestForm;
use AppBundle\Form\VideoRequestForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FormController extends Controller
{
    /**
     * @Route("photo/form", name = "photo-request-form")
     */
    public function renderPhotoRequestForm(Request $request){
        $form = $this->createForm(PhotoRequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($formData);
            $manager->flush();
            $this->addFlash('success','Photo request inserted!');
            return $this->redirectToRoute("photo-request-form");
        }
        return $this->render("FormView/PhotoForm.html.twig",[
            'photoRequestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("video/form", name = "video-request-form")
     */
    public function renderVideoRequestForm(Request $request){
        $form = $this->createForm(VideoRequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/VideoForm.html.twig",[
            'videoRequestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("b2b-marketing/form", name = "b2b-marketing-request-form")
     */
    public function renderB2BMarketingRequestForm(Request $request){
        $form = $this->createForm(B2BMarketingRequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/B2BMarketingForm.html.twig",[
            'b2bMarketingRequestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("marketing-sales/form", name = "marketing-sales-request-form")
     */
    public function renderMarketingSalesRequestForm(Request $request){
        $form = $this->createForm(MarketingSalesRequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/MarketingSalesForm.html.twig",[
            'marketingSalesRequestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("package-design/form", name = "package-design-request-form")
     */
    public function renderPackageDesignRequestForm(Request $request){
        $form = $this->createForm(PackageDesignRequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/PackageDesignForm.html.twig",[
            'packageDesignRequestForm' => $form->createView()
        ]);
    }

    /**
     * @Route("product-design/form", name = "product-design-request-form")
     */
    public function renderProductDesignRequestForm(Request $request){
        $form = $this->createForm(ProductDesignRequestForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }
        return $this->render("FormView/ProductDesignForm.html.twig",[
            'productDesignRequestForm' => $form->createView()
        ]);
    }
}