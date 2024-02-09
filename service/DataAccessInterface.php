<?php

namespace service;
interface DataAccessInterface
{
    public function getUser($login, $password);
    public function getLogins($login);
    public function getAllAnnonces();
    public function getPost($id);
    public function getReceivedComments($login);
    public function getCommentsFromPostID($id);
    public function getCommentsFromLogin($login);
    public function addUser($login, $password, $name, $surname);
    public function addPost($title, $content, $login);
    public function addComment($text, $login, $id);
}
