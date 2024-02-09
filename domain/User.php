<?php

namespace domain;
/**
 *
 */
class User
{
    /**
     * @var
     */
    protected $login;
    /**
     * @var
     */
    protected $password;

    /**
     * @var
     */
    protected $admin;
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $surname;

    /**
     * @param $login
     * @param $password
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

}