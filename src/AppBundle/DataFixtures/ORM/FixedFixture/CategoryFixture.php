<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/14/2017
 * Time: 9:31 AM
 */

namespace AppBundle\DataFixtures\ORM\FixedFixture;


use AppBundle\Entity\FixedEntity\CategoryEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
      $categories = ['photo','video','b2b-marketing','package-design','marketing-sales','product-design'];
      for($counter = 0 ; $counter < count($categories) ; $counter++){
          $categoryObject = new CategoryEntity();
          $categoryObject->setCategory($categories[$counter]);
          $manager->persist($categoryObject);
      }
      $manager->flush();
    }
}