<?php

namespace data;

use domain\{Post, User};
use service\DataAccessInterface;

include_once "service/DataAccessInterface.php";

include_once "domain/Post.php";
include_once "domain/User.php";


class DataAccess implements DataAccessInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function __destruct()
    {
        $this->dataAccess = null;
    }

    public function getUser($login, $password)
    {
        $user = null;

        $query = 'SELECT login FROM Users WHERE login="' . $login . '" and password="' . $password . '"';
        $result = $this->dataAccess->query($query);

        if ($result->rowCount())
            $user = new User($login, $password);

        $result->closeCursor();

        return $user;
    }

    public function getAllAnnonces()
    {
        $result = $this->dataAccess->query('SELECT * FROM Post ORDER BY date DESC');
        $annonces = array();

        while ($row = $result->fetch()) {
            $currentPost = new Post($row['id'], $row['title'], $row['content'], $row['date']);
            $annonces[] = $currentPost;
        }

        $result->closeCursor();

        return $annonces;
    }

    public function getPost($id)
    {
        $id = intval($id);
        $result = $this->dataAccess->query('SELECT * FROM Post WHERE id=' . $id);
        $row = $result->fetch();

        $post = new Post($row['id'], $row['title'], $row['content'], $row['date']);

        $result->closeCursor();

        return $post;
    }

    public function getLogins($login)
    {
        $query = 'SELECT login FROM Users WHERE login="' . $login . '"';
        $result = $this->dataAccess->query($query);
        $row = $result->fetch();
        $result->closeCursor();
        return $row['username'];
    }

    public function addUser($login, $password, $name, $surname){
        $query = 'INSERT INTO Users (login, password, name, surname) VALUES ("' . $login . '", "' . $password . '", "' . $name . '", "' . $surname . '")';

        $statement = $this->dataAccess->prepare($query);
        if ($statement->execute() === false) {
            $statement->closeCursor();
            return false;
        }

        $result = $this->dataAccess->query($query);
        $result->closeCursor();
    }

    public function addPost($title, $content, $login){
        $query = 'INSERT INTO Post (title, content, login) VALUES ("' . $title . '", "' . $content . '", "' . $login . '")';

        $statement = $this->dataAccess->prepare($query);
        if ($statement->execute() === false) {
            $statement->closeCursor();
            return false;
        }

        $result = $this->dataAccess->query($query);
        $result->closeCursor();
    }
}