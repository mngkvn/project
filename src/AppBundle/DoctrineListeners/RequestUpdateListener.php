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
use Symfony\Component\Security\Core\User\User;

class RequestUpdateListener
{
    public function preUpdate(PreUpdateEventArgs $arguments){

        if(!$arguments->getEntity() instanceof RequestEntity){
            return;
        }


        $username = 'tst';
        $date = new \DateTime();
        $editDetails = json_encode(["username"=>$username,"date"=>$date]);

        if($arguments->hasChangedField('category')){
            $arguments->setNewValue('category',$arguments->getNewValue('category'));
//            $arguments->setNewValue('movedBy',$editDetails);
        }
//
        if($arguments->hasChangedField('isActive') && $arguments->getNewValue('isActive') == 1){
//            $arguments->setNewValue('openedBy',$editDetails);
            $arguments->setNewValue('isActive', 1);
        }
//
        if($arguments->hasChangedField('isActive') && $arguments->getNewValue('isActive') == 0){
            $arguments->setNewValue('isActive', 0);
//            $arguments->setNewValue('closedBy',$editDetails);
        }
    }
}