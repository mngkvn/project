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
     * @Assert\Regex(
     *     pattern="/^[A-Za-z\s]*$/",
     *     message="Please put a valid name"
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
     * @Assert\Type("string")
     * @Assert\Length(
     *     max = 100,
     *     maxMessage="Other Platform is invalid."
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
        $name = trim(preg_replace('/\s+/',' ', $name));
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
        /*
         * Created a filter and mapper for setOtherPlatform. It's not required but if a user
         * will add a platform and the value is a combination of commas and spaces it will
         * silently fail. If the user tries to input over 10 other platforms, only 10 other platforms
         * will be added.
         *
         * It also needs to be encoded as json as my @assert on other platform has maxlength of 100 and
         * expects a string.
         */
        if($otherPlatform){
            $toPlatform = explode(",",$otherPlatform);
            /*
             * Creating a map to eliminate empty data caused by passing only commas
             * e.g. :
             * User passes ,,,,,,,,,,,
             * our explode will create N number of arrays based off the commas passed.
             * added trim($value) to remove ,     ,    ,  ,,,, empty multi-spaced elements.
             *
             * Current downside is if a user throws in single character platform ex: a,b,c,d,e,f
             * it's still be inserted to db. Will fix regex in the future.
             */

            $filterPlatform = array_filter($toPlatform, function($value){
                if(preg_match_all("/^[A-Za-z\s,]*/",$value)){
                    return trim($value) !== '';
                }
            });

            $mapPlatform = array_map(function($value){
                return trim($value);
            },$filterPlatform);

            $reIndexPlatform = array_values($mapPlatform);

            $otherPlatform = count($reIndexPlatform) > 10 ? array_slice($reIndexPlatform,0,10) : $reIndexPlatform;
        }
        dump($otherPlatform);
        //needed to encode this to avoid errors. as the checker expects a string not an array.
        $this->otherPlatform = json_encode($otherPlatform);
    }
}