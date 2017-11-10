<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 8:44 AM
 */

namespace AppBundle\Entity\RequestEntity;


use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * Class RequestEntity
 * @package AppBundle\Entity\RequestEntity
 * @ORM\MappedSuperclass()
 */
class RequestEntity
{
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $contactNumber;
    /**
     * @ORM\Column(type="text")
     */
    private $message;
    /**
     * @ORM\Column(type="string")
     */
    private $type;
    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;
    /**
     * @ORM\Column(type="string")
     */
    private $company;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->postedAt = new DateTime();
        $this->isActive = 1;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * @param mixed $contactNumber
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    /**
     * @param mixed $postedAt
     */
    public function setPostedAt($postedAt)
    {
        isset($postedAt) ? $this->postedAt = $postedAt : $this->postedAt = new DateTime();
    }
    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }/**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive = 1)
    {
        $this->isActive = $isActive;
    }
}