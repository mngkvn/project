<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/20/17
 * Time: 12:29 AM
 */

namespace AppBundle\Controller\RequestController;
use AppBundle\Service\PathService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StatusController extends Controller
{
    /**
     * @Route("photo-and-video-request-sent", name="photo-and-video-request-sent")
     * @Route("business-to-business-request-sent", name="business-to-business-request-sent")
     * @Route("marketing-sales-request-sent", name="marketing-sales-request-sent")
     * @Route("package-design-request-sent", name="package-design-request-sent")
     * @Route("product-design-request-sent", name="product-design-request-sent")
     */
    public function renderStatus(Request $request){
        $getPathService = $this->get('app.path_service');
        $getCategory = str_replace('-request-sent','',$getPathService->pathGetCategory($request->getPathInfo()));
        $cleanCategory = str_replace('-',' ',$getCategory);

        return $this->render('StatusView/StatusView.html.twig',[
            "category" => $cleanCategory
        ]);
    }
}