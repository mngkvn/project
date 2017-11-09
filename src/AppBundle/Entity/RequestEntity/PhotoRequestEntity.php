<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 9:05 AM
 */

namespace AppBundle\Entity\RequestEntity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="PhotoRequest")
 */
class PhotoRequestEntity extends RequestEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")`
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;
    /**
     * @ORM\Column(type="string")
     */
    private $platform;
    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}