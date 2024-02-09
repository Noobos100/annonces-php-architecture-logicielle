<?php

namespace service;
/**
 *
 */
interface DataAccessInterface
{
    /**
     * @param $login
     * @param $password
     * @return mixed
     */
    public function getUser($login, $password);

    /**
     * @param $login
     * @return mixed
     */
    public function getLogins($login);

    /**
     * @return mixed
     */
    public function getAllAnnonces();

    /**
     * @param $id
     * @return mixed
     */
    public function getPost($id);

    /**
     * @param $login
     * @param $password
     * @param $name
     * @param $surname
     * @return mixed
     */
    public function addUser($login, $password, $name, $surname);

    /**
     * @param $title
     * @param $content
     * @param $login
     * @return mixed
     */
    public function addPost($title, $content, $login);


    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id);

    /**
     * @param $id
     * @param $title
     * @param $content
     * @return mixed
     */
    public function editPost($id, $title, $content);
}
