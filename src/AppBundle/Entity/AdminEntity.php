<?php
/**
 * Created by PhpStorm.
 * User: mngkvn
 * Date: 11/27/17
 * Time: 6:22 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 */
class AdminEntity implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",unique=true)
     */
    private $username;
    /**
     * @ORM\Column(type="string",nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string",nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $roles;

    //do not add this on our db. will be encrypted later for the $password use.
    private $plainPassword;

    public function getUsername()
    {
        return $this->username;
    }

    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        //blank because we are using the bcrypt ( has default mechanism to salt passwords ).
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        //needed to set password to null for the doctrine listeners to update the password before inserting
        $this->password = null;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


}