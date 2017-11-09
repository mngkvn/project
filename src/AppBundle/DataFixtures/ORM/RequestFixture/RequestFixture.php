<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 10:29 AM
 */

namespace AppBundle\DataFixtures\ORM\RequestFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RequestFixture extends Controller implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dummyFilePath =[__DIR__ . '/PhotoFixture.yml'];
        $loader = $this->get('fidry_alice_data_fixtures.doctrine.loader');
        $loader->load($dummyFilePath);
    }
}