<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/29/2017
 * Time: 9:54 AM
 */

namespace AppBundle\DoctrineListeners;


use AppBundle\Entity\AdminEntity;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\User\User;

class HashPasswordListener implements EventSubscriber
{
    /*
     * UserPasswordEncoder for encoding Password
     * LifecycleEventArgs getting entity name / entity
     * This needs to be registered as a service.
     */

    /**
     * @var UserPasswordEncoder
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(LifecycleEventArgs $arguments){
        $entity = $arguments->getEntity();
        if(!$entity instanceof AdminEntity){
            return;
        }

        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $arguments){
        $entity = $arguments->getEntity();
        if(!$entity instanceof AdminEntity){
            return;
        }

        $this->encodePassword($entity);
        $em = $arguments->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta,$entity);
    }
    /**
     * @param User $entity
     */
    private function encodePassword(User $entity)
    {
        $encodePassword = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encodePassword);
    }

    public function getSubscribedEvents()
    {
        return ["prePersist","preUpdate"];
    }
}