<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 10:29 AM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\CategoryEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CategoryFixture extends Controller implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* MANUAL DB DEFAULT CATEGORIES */
        $categories = ['Photo','Video','B2B Marketing','Package Design','Marketing Sales','Product Design'];
        for($counter = 0 ; $counter < count($categories) ; $counter++){
            $categoryObject = new CategoryEntity();
            $categoryObject->setCategory($categories[$counter]);
            $manager->persist($categoryObject);
        }

        $manager->flush();
    }
}