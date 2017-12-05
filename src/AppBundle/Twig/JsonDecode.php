<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 12/5/2017
 * Time: 10:49 AM
 */

namespace AppBundle\Twig;

class JsonDecode extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecode')),
        );
    }

    public function jsonDecode($jsonData)
    {
        return json_decode($jsonData);
    }
}
