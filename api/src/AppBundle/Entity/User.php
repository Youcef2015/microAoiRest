<?php
/**
 * User: ylezghed
 * Date: 16/10/17
 * Time: 13:23
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\RestBundle\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="users_email_unique",columns={"email"})}
 * )
 * @ExclusionPolicy("all")
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Expose
     */
    private  $id;

    /**
     * @ORM\Column(type="string")
     * @Expose
     */
    private $firstname;

    /**
     * @ORM\Column(type="string")
     * @Expose
     */
    private $lastname;

    /**
     * @ORM\Column(type="string")
     * @Expose
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Expose
     */
    private $password;


    /**
     * @ORM\Column(type="string")
     * @Expose
     */
    private $plainPassword;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }


    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }


    public function getRoles()
    {
        return [];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
