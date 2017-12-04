<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/7/2017
 * Time: 8:44 AM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class RequestEntity
 * @package AppBundle\Entity\RequestEntity
 * @ORM\Entity
 * @ORM\Table(name="request")
 */
class RequestEntity
{

    public function __construct()
    {
        $this->postedAt = new DateTime();
        $this->isActive = 1;
        $this->platform = null;
        $this->quantity = null;
        $this->otherPlatform = null;
        $this->closedBy = null;
        $this->movedBy = null;
        $this->company = null;
        $this->contactNumber = null;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Type("integer")
     * @Assert\Range(
     *     min="1",
     *     max="10000",
     *     minMessage="At least 1 quantity needed.",
     *     maxMessage="Quantity cannot exceed 10,000.",
     *     invalidMessage="Please put a realistic quantity."
     * )
     * @ORM\Column(type="integer",nullable=true)
     */
    private $quantity;

    /**
     * @Assert\NotBlank(message="Your name is required.")
     * @Assert\Type("string")
     * @Assert\Length(
     *     min="1",
     *     max="100",
     *     maxMessage="Your name is too long."
     * )
     * @ORM\Column(type="string",nullable=false)
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Your email is required.")
     * @Assert\Email(message="Please provide a valid email address.")
     * @ORM\Column(type="string",nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $contactNumber;

    /**
     * @Assert\NotBlank(message="Please describe or summarize your request.")
     * @Assert\Length(
     *     min = 15,
     *     max = 5000,
     *     minMessage="Describe your request more clearly.",
     *     maxMessage="Please summarize your request."
     * )
     * @ORM\Column(type="text",nullable=false)
     */
    private $message;

    /**
     * @Assert\NotBlank(message="Please select a category.")
     * @ORM\ManyToOne(targetEntity="CategoryEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="json_array",nullable=true)
     */
    private $platform;

    /**
     * @Assert\Length(
     *     max = 100,
     *     maxMessage="Platform max character exceeded. Delete some platform."
     * )
     * @ORM\Column(type="json_array",nullable=true)
     */
    private $otherPlatform;


    /**
     * @ORM\Column(type="json_array",nullable=true)
     */
    private $movedBy;

    /**
     * @ORM\Column(type="json_array",nullable=true)
     */
    private $closedBy;

    /**
     * @return mixed
     */
    public function getMovedBy()
    {
        return $this->movedBy;
    }

    /**
     * @param mixed $movedBy
     */
    public function setMovedBy($movedBy)
    {
        $this->movedBy = $movedBy;
    }

    /**
     * @return mixed
     */
    public function getClosedBy()
    {
        return $this->closedBy;
    }

    /**
     * @param mixed $closedBy
     */
    public function setClosedBy($closedBy)
    {
        $this->closedBy = $closedBy;
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
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @param mixed $category
     */
    public function setCategory(CategoryEntity $category)
    {
        $this->category = $category;
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
    }
    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getOtherPlatform()
    {
        return $this->otherPlatform;
    }

    /**
     * @param mixed $otherPlatform
     */
    public function setOtherPlatform($otherPlatform)
    {

        $this->otherPlatform = $otherPlatform;
    }


}