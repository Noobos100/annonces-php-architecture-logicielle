<?php

namespace domain;
class User
{
    protected $login;
    protected $password;

    protected $admin;
    protected $name;
    protected $surname;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

}