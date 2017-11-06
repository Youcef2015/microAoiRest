<?php
/**
 * User: ylezghed
 * Date: 17/10/17
 * Time: 12:44
 */
declare(strict_types=1);


namespace AppBundle\Entity;


class Authentication
{
    private  $login;

    private $password;

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return $this
     */
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }
}
