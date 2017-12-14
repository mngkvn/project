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

class MainRouteController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function renderHomepage(){
        return $this->render("base.html.twig");
    }

    /**
     * @Route("/photo-and-video",name="photo-and-video")
     */
    public function renderPhotoAndVideo(){
        return $this->render('MainView/PhotoAndVideoView.html.twig');
    }

    /**
     * @Route("/business-to-business",name="business-to-business")
     */
    public function renderBusinessToBusiness(){
        return $this->render('MainView/BusinessToBusinessView.html.twig');
    }

    /**
     * @Route("/marketing-sales",name="marketing-sales")
     */
    public function renderMarketingSales(){
        return $this->render('MainView/MarketingSalesView.html.twig');
    }

    /**
     * @Route("/package-design",name="package-design")
     */
    public function renderPackageDesign(){
        return $this->render('MainView/PackageDesignView.html.twig');
    }

    /**
     * @Route("/product-design",name="product-design")
     */
    public function renderProductDesign(){
        return $this->render("MainView/ProductDesignView.html.twig");
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