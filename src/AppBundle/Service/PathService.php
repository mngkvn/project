<?php
/**
// * Created by PhpStorm.
// * User: mngkvn
// * Date: 11/20/17
// * Time: 8:38 PM
// */

namespace AppBundle\Service;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PathService extends Controller
{
    /*
     * $path argument is always valid as this service only serves for paths like this : /photo/form .
     * As routes are static by category (/photo,/video etc), any invalid categories will be automatically re-routed
     * to not found or error routes.
    */

    //this returns the "category" from the url. ex : /photo/form -> "photo"
    public function pathGetCategory($path){
        preg_match("/[A-Za-z\-0-9]{1,20}/",$path,$matches);
        return $matches[0];
    }
    //this returns the route name not the actual path ex. /photo/form -> photo-request-success.
     public function pathRequestSuccess($path){
         $category = $this->pathGetCategory($path);
         return $category.'-request-success';
     }
     //this will set the "name of request link" for the list view ex: /photo/list -> photo-view
    public function pathSetRequestLink($path){
         $category = $this->pathGetCategory($path);
         return $category.'-view';
    }
    //this will return the route name for editing ex: /photo/1 -> photo-edit
    public function pathSetEditLink($path){
        $category = $this->pathGetCategory($path);
        return $category.'-edit';
    }
}