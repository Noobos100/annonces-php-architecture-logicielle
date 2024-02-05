<?php

namespace service;
interface DataAccessInterface
{
    public function getUser($login, $password);
    public function getLogins($login);
    public function getAllAnnonces();
    public function getPost($id);
    public function addUser($login, $password, $name, $surname);
}
