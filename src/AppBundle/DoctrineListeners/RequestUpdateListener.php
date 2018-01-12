<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 1/4/2018
 * Time: 12:32 PM
 */

namespace AppBundle\DoctrineListeners;

use AppBundle\Entity\RequestEntity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\User;

class RequestUpdateListener
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function preUpdate(PreUpdateEventArgs $arguments){
        $entity = $arguments->getEntity();

        if(!$entity instanceof RequestEntity){
            return;
        }

        $username = $this->tokenStorage->getToken()->getUsername();
        $date = new \DateTime();
        $editDetails = json_encode(["username"=>$username,"date"=>$date]);

        if($arguments->hasChangedField('category')){
            $arguments->setNewValue('category',$arguments->getNewValue('category'));
            $entity->setMovedBy($editDetails);
        }
        if($arguments->hasChangedField('isActive') && $arguments->getNewValue('isActive') == 1){
            $arguments->setNewValue('isActive', 1);
            $entity->setOpenedBy($editDetails);
        }
        if($arguments->hasChangedField('isActive') && $arguments->getNewValue('isActive') == 0){
            $arguments->setNewValue('isActive', 0);
            $entity->setClosedBy($editDetails);
        }
    }
}