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
        $this->isActive = true;
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
     *     minMessage="At least 1 quantity is needed.",
     *     maxMessage="Quantity cannot exceed 10,000.",
     *     invalidMessage="Quantity is invalid."
     * )
     * @ORM\Column(type="integer",nullable = true)
     */
    private $quantity;

    /**
     * @Assert\NotBlank(message="Your name is required.",groups={"newRequest"})
     * @Assert\Type("string",groups={"newRequest"})
     * @Assert\Length(
     *     min="1",
     *     max="100",
     *     maxMessage="Your name is too long.",
     *     groups={"newRequest"}
     * )
     * @Assert\Regex(
     *     pattern="/^[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*$/",
     *     message="Please provide a valid name.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="string",nullable = false)
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Your email is required.",groups={"newRequest"})
     * @Assert\Email(message="Please provide a valid email address.",groups={"newRequest"})
     * @ORM\Column(type="string",nullable = false)
     */
    private $email;

    /**
     * @Assert\Regex(
     *     pattern="/^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/",
     *     message="Please provide a valid phone number.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="string",nullable = true)
     */
    private $contactNumber;

    /**
     * @Assert\NotBlank(message="Message is required.",groups={"newRequest"})
     * @Assert\Length(
     *     min = 15,
     *     max = 5000,
     *     minMessage = "Message is too short.",
     *     maxMessage = "Please summarize your request.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="text",nullable = false)
     */
    private $message;

    /**
     * @Assert\NotBlank(message="Please select a category.",groups={"newRequest"})
     * @Assert\Choice(
     *     choices = {"photo","video","business-to-business-marketing","package-design","product-design","marketing-sales"},
     *     message = "Please select a valid category.",
     *     groups={"newRequest"}
     * )
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategoryEntity")
     * @ORM\JoinColumn(name="category_id",referencedColumnName="id", nullable = false)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * @Assert\Type("string",groups={"newRequest"})
     * @Assert\Length(
     *     min = 2,
     *     max = 100,
     *     minMessage="Company name is too short",
     *     maxMessage="Company name is too long.",
     *     groups={"newRequest"}
     * )
     * @Assert\Regex(
     *     pattern = "/^[.@&]?[a-zA-Z0-9 ]+[ !.@&()]?[ a-zA-Z0-9!()]+$/",
     *     message = "Please provide a valid company name.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="string",nullable = true)
     */
    private $company;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="This value is invalid.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @Assert\Type("string",groups={"newRequest"})
     * @Assert\Length(
     *     max = 100,
     *     maxMessage="Other Platform is invalid.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="json_array",nullable = true)
     */
    private $otherPlatform;


    /**
     * @ORM\Column(type="json_array",nullable = true)
     */
    private $movedBy;

    /**
     * @ORM\Column(type="json_array",nullable = true)
     */
    private $closedBy;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="This value is invalid.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isAmazon;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="This value is invalid.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isEbay;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="This value is invalid.",
     *     groups={"newRequest"}
     * )
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isWalmart;

    /**
     * @Assert\Choice(
     *     choices = {"photo","video","business-to-business-marketing","package-design","product-design","marketing-sales"},
     *     message = "Please select a valid category.",
     *     groups={"editRequest"}
     * )
     */
    private $moveCategory;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="This value is invalid.",
     *     groups={"editRequest"}
     * )
     */
    private $changeIsActive;

    /**
     * @return mixed
     */
    public function getChangeIsActive()
    {
        return $this->changeIsActive;
    }

    /**
     * @param mixed $changeIsActive
     */
    public function setChangeIsActive($changeIsActive)
    {
        $this->changeIsActive = $changeIsActive;
    }
    /**
     * @return mixed
     */
    public function getMoveCategory()
    {
        return $this->moveCategory;
    }

    /**
     * @param mixed $moveCategory
     */
    public function setMoveCategory($moveCategory)
    {
        $this->moveCategory = $moveCategory;
    }

    /**
     * @return mixed
     */
    public function getIsAmazon()
    {
        return $this->isAmazon;
    }

    /**
     * @param mixed $isAmazon
     */
    public function setIsAmazon($isAmazon)
    {
        $this->isAmazon = $isAmazon;
    }

    /**
     * @return mixed
     */
    public function getIsEbay()
    {
        return $this->isEbay;
    }

    /**
     * @param mixed $isEbay
     */
    public function setIsEbay($isEbay)
    {
        $this->isEbay = $isEbay;
    }

    /**
     * @return mixed
     */
    public function getIsWalmart()
    {
        return $this->isWalmart;
    }

    /**
     * @param mixed $isWalmart
     */
    public function setIsWalmart($isWalmart)
    {
        $this->isWalmart = $isWalmart;
    }
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
        /*
         * Silently fail if it passed regex validation even it's invalid.
         * This field is not required.
         */
        $contactNumber= trim(preg_replace('/\s/','-', $contactNumber));
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
        /*
         * Silently fail if it passed regex validation even it's invalid.
         * This field is not required.
         */
        $company = trim(preg_replace('/\s+/',' ', $company));
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
            /*
             * Creating a map to eliminate empty data caused by passing only commas
             * e.g. :
             * User passes ,,,,,,,,,,,
             * our explode will create N number of arrays based off the commas passed.
             * added trim($value) to remove ,     ,    ,  ,,,, empty multi-spaced elements.
             * Also, this removes duplicates from supported platforms and already added ones.
             *
             * Current downside is if a user throws in single character platform ex: a,b,c,d,e,f
             * it's still be inserted to db. Will fix regex in the future also if user manually typed
             * supported platforms and didn't check one, it will not be registered.
             */


            //List of supportedPlatform so far.
            $supportedPlatform=['amazon','ebay','walmart'];

            //List of currently checked supported platform.
            $checkedSupportedPlatform =[];

            if($this->getIsAmazon()){
                array_push($supportedPlatform,'amazon');
            }

            if($this->getIsEbay()){
                array_push($supportedPlatform,'ebay');
            }

            if($this->getIsWalmart()){
                array_push($supportedPlatform,'walmart');
            }

            //Chops the otherPlatform string sent to array
            $toPlatform = explode(",",$otherPlatform);

            //Filter No Data and those that doesn't match the regex
            $filterPlatform = array_filter($toPlatform, function($value){
                return preg_match("/^[A-Za-z\s,]+$/",$value) && trim($value);
            });

            //Trim and make them lowercase
            $mapPlatform = array_map(function($value){
                return strtolower(trim($value));
            },$filterPlatform);

            //Remove duplication like "target,target"
            $removeDuplicatePlatform = array_unique($mapPlatform);

            //To be used by otherPlatform, gets unique platform that isn't in the supported platforms.
            $uniquePlatform = array_diff($removeDuplicatePlatform,$supportedPlatform);

            //Reindex otherPlatforms
            $reIndexPlatform = array_values($uniquePlatform);

            //If otherPlatforms are more than 10, then get only 10 else get the whole reIndexPlatform value
            $otherPlatform = count($reIndexPlatform) > 10 ? array_slice($reIndexPlatform,0,10) : $reIndexPlatform;

            /*
             * This is for when the user didn't check the default supported platforms but wrote it instead on
             * the otherPlatform. Need to check the checked supported platform and the added otherPlatform and
             * add the unchecked one on the supported platform.
             *
             * get written supported platforms and check their intersection from the provided supported platform.
             * this will remove written unsupported platforms.
             */

            //will match ebay,walmart,amazon if written manually on the input and makes them unique and finally fix the index.
            $checkedSupportedPlatformIntersection = array_values(array_unique(array_intersect($supportedPlatform,$removeDuplicatePlatform)));

            //if there's a match
            if(count($checkedSupportedPlatformIntersection)){
                //check and set the supported platform that depends on the intersected array
                for($counter=0;$counter < count($checkedSupportedPlatformIntersection); $counter++){
                    switch($checkedSupportedPlatformIntersection[$counter]){
                        case "amazon" :
                            $this->setIsAmazon(true);
                            break;
                        case "walmart" :
                            $this->setIsWalmart(true);
                            break;
                        case "ebay" :
                            $this->setIsEbay(true);
                            break;
                        default:
                    }
                }
            }
        }
        //needed to encode this to avoid errors. as the checker expects a string not an array.
        $this->otherPlatform = json_encode($otherPlatform);
    }
}