<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/24/17
 * Time: 7:36 PM
 */

namespace AppBundle\Controller\RequestController;


use AppBundle\Service\PathService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RequestListController extends Controller
{
    /**
     * @Route("photo/list", name = "photo-list")
     * @Route("video/list", name = "video-list")
     * @Route("b2b-marketing/list", name = "b2b-marketing-list")
     * @Route("marketing-sales/list", name = "marketing-sales-list")
     * @Route("package-design/list", name = "package-design-list")
     * @Route("product-design/list", name = "product-design-list")
     */
    public function renderRequestList(Request $request)
    {
        $getPath = new PathService();
        //will return "photo,video, ..."
        $getURLCategory = $getPath->pathGetCategory($request->getPathInfo());

        $getManager = $this->getDoctrine()->getManager();
        $getCategoryEntity = $getManager->getRepository("AppBundle:CategoryEntity");
        $getCategory = $getCategoryEntity->findOneBy(["category"=>$getURLCategory]);

        /*
         safe-checking though it should always give a categoryEntity, it's safer to check if there's a
         result from the database before rendering the list View. If no result, redirect to 404 not found template.
        */

        if($getCategory){
            /*
              if it returned an entity / category, query the request database to return all matching request by category.
             */
            $categoryId = $getCategory->getId();
            $getRequestEntity = $getManager->getRepository("AppBundle:RequestEntity");
            $getRequestList = $getRequestEntity->findBy(["category"=>$categoryId]);

            $setRequestLink = $getPath->pathSetRequestLink($getURLCategory);
            $setEditLink = $getPath->pathSetEditLink($getURLCategory);

            return $this->render("RequestView/RequestListView.html.twig",[
                "requestList" => $getRequestList,
                "requestLink" => $setRequestLink,
                "editLink" => $setEditLink,
                "category" => $getURLCategory,
            ]);
        }else{
            $this->redirectToRoute();
        }
    }
}