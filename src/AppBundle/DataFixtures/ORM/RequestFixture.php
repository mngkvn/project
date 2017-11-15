<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 10:29 AM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\CategoryEntity;
use AppBundle\Entity\RequestEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker;


class RequestFixture extends Controller implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fake = Faker\Factory::create();
        for($counter = 0; $counter < 5; $counter++){
            $requestObject = new RequestEntity();

            $name = $fake->name;
            $isActive = $fake->numberBetween($min=0,$max=1);
            $email = $fake->companyEmail;
            $company = $fake->company;
            $message = $fake->sentence();
            $phoneNumber = $fake->e164PhoneNumber;
            $platform = $fake->randomElement([null,'ebay','amazon','craigslist','google']);
            $quantity = $fake->numberBetween($min=1,$max=20);
            $date = $fake->dateTimeBetween('-12 months', 'now');

            $em = $this->getDoctrine()->getRepository(CategoryEntity::class);
            $categories = $em->findAll();
            $category = $categories[array_rand($categories)];

            $requestObject->setName($name);
            $requestObject->setEmail($email);
            $requestObject->setContactNumber($phoneNumber);
            $requestObject->setCompany($company);
            $requestObject->setMessage($message);
            $requestObject->setPlatform($platform);
            $requestObject->setQuantity($quantity);
            $requestObject->setPostedAt($date);
            $requestObject->setIsActive($isActive);
            $requestObject->setCategory($category);

            $manager->persist($requestObject);
        }

        $manager->flush();

    }

    public function getDependencies(){
        return [
            CategoryEntity::class
        ];
    }
}