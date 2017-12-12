<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 10:29 AM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\RequestEntity;
use AppBundle\Entity\CategoryEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker;


class RequestFixture extends Controller implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fake = Faker\Factory::create();
        for($counter = 0; $counter < 100; $counter++){
            $requestObject = new RequestEntity();

            $name = $fake->name;
            $isActive = $fake->boolean($chanceOfGettingTrue = 100);
            $email = $fake->companyEmail;
            $company = $fake->company;
            $message = $fake->realText($maxNbChars=400);
            $phoneNumber = $fake->e164PhoneNumber;
            $quantity = $fake->numberBetween($min=1,$max=20);
            $date = $fake->dateTimeBetween('-12 months', 'now');
            $isAmazon = $fake->boolean($chanceOfGettingTrue = 50);
            $isEbay = $fake->boolean($chanceOfGettingTrue = 50);
            $isWalmart = $fake->boolean($chanceOfGettingTrue = 50);
            $otherPlatforms = implode(',',$fake->randomElements($array=["Meijer","Walgreens","Target","BestBuy"],$count=2));

            $emCategory = $this->getDoctrine()->getRepository(CategoryEntity::class);
            $categories = $emCategory->findAll();
            $category = $categories[array_rand($categories)];

            $requestObject->setName($name);
            $requestObject->setEmail($email);
            $requestObject->setContactNumber($phoneNumber);
            $requestObject->setCompany($company);
            $requestObject->setMessage($message);
            $requestObject->setIsAmazon($isAmazon);
            $requestObject->setIsEbay($isEbay);
            $requestObject->setIsWalmart($isWalmart);
            $requestObject->setQuantity($quantity);
            $requestObject->setPostedAt($date);
            $requestObject->setIsActive($isActive);
            $requestObject->setCategory($category);
            $requestObject->setOtherPlatform($otherPlatforms);

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