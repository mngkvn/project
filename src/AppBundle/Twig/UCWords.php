<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 12/10/17
 * Time: 12:35 AM
 */

namespace AppBundle\Twig;


class UCWords extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ucwords', array($this, 'ucwords')),
        );
    }

    public function ucwords($data)
    {
        return ucwords($data);
    }
}