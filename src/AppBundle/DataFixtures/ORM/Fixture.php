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

class Fixture extends Controller implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* REQUEST FAKER */
        $dummyFilePath =[__DIR__.'/RequestFixture.yml'];
        $loader = $this->get('fidry_alice_data_fixtures.doctrine.loader');
        $loader->load($dummyFilePath);

        /* MANUAL DB DEFAULT CATEGORIES */
        $categories = ['photo','video','b2b-marketing','package-design','marketing-sales','product-design'];
        for($counter = 0 ; $counter < count($categories) ; $counter++){
            $categoryObject = new CategoryEntity();
            $categoryObject->setCategory($categories[$counter]);
            $manager->persist($categoryObject);
        }
        $manager->flush();

    }
}