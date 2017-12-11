<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/27/17
 * Time: 8:34 PM
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\AdminEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker;

class AdminFixture extends Controller implements FixtureInterface
{
    public function load(ObjectManager $manager){
        /* MANUAL DB ADMINS */
        $fake = Faker\Factory::create();
        for($counter=0;$counter<10;$counter++){
            $adminObject = new AdminEntity();

            $username = $fake->userName;
            $firstName = $fake->firstName();
            $lastName = $fake->lastName;
            $role = ['ROLE_ADMIN'];
            $adminObject->setPlainPassword("project");

            $email = $fake->companyEmail;
            $adminObject->setUsername($username);
            $adminObject->setFirstName($firstName);
            $adminObject->setLastName($lastName);
            $adminObject->setPassword($adminObject->getPlainPassword());
            $adminObject->setRoles($role);
            $adminObject->setEmail($email);

            $manager->persist($adminObject);
        }

        $manager->flush();
    }
}