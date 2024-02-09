<?php

namespace data;

use domain\{Post, User};
use service\DataAccessInterface;

include_once "service/DataAccessInterface.php";

include_once "domain/Post.php";
include_once "domain/User.php";


/**
 *
 */
class DataAccess implements DataAccessInterface
{
    /**
     * @var null
     */
    protected $dataAccess = null;

    /**
     * @param $dataAccess
     */
    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->dataAccess = null;
    }

    /**
     * @param $login
     * @param $password
     * @return User|null
     */
    public function getUser($login, $password)
    {
        $user = null;

        $query = 'SELECT login FROM User WHERE login="' . $login . '" and password="' . $password . '"';
        $result = $this->dataAccess->query($query);

        if ($result->rowCount())
            $user = new User($login, $password);

        $result->closeCursor();

        return $user;
    }

    /**
     * @return array
     */
    public function getAllAnnonces()
    {
        $result = $this->dataAccess->query('SELECT * FROM Post ORDER BY date DESC');
        $annonces = array();

        while ($row = $result->fetch()) {
            $currentPost = new Post($row['id'], $row['title'], $row['content'], $row['date'], $row['login']);
            $annonces[] = $currentPost;
        }

        $result->closeCursor();

        return $annonces;
    }

    /**
     * @param $id
     * @return Post
     */
    public function getPost($id)
    {
        $id = intval($id);
        $result = $this->dataAccess->query('SELECT * FROM Post WHERE id=' . $id);
        $row = $result->fetch();

        $post = new Post($row['id'], $row['title'], $row['content'], $row['date'], $row['login']);

        $result->closeCursor();

        return $post;
    }

    /**
     * @param $login
     * @return null
     */
    public function getLogins($login)
    {
        $query = 'SELECT login FROM User WHERE login="' . $login . '"';

        $result = $this->dataAccess->query($query);

        if ($result === false) {
            // Query execution failed
            return null; // or handle the error in a way that makes sense for your application
        }

        $row = $result->fetch();
        $result->closeCursor();

        if ($row === false) {
            // No results found
            return null; // or handle the absence of results in a way that makes sense for your application
        }

        return $row['login'];
    }


    /**
     * @param $login
     * @param $password
     * @param $name
     * @param $surname
     * @return bool
     */
    public function addUser($login, $password, $name, $surname){
        $query = 'INSERT INTO User (login, password, name, surname) VALUES (:login, :password, :name, :surname)';

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':login', $login);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':surname', $surname);

        if ($statement->execute() === false) {
            // If execution fails, close the cursor and return false
            $statement->closeCursor();
            return false;
        }

        // Close the cursor after successful execution
        $statement->closeCursor();

        // Return true or any other value as per your requirement to indicate successful execution
        return true;
    }


    /**
     * @param $title
     * @param $content
     * @param $login
     * @return bool
     */
    public function addPost($title, $content, $login){
        $query = 'INSERT INTO Post (title, content, login) VALUES (:title, :content, :login)';

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':login', $login);

        if ($statement->execute() === false) {
            // If execution fails, close the cursor and return false
            $statement->closeCursor();
            return false;
        }

        // Close the cursor after successful execution
        $statement->closeCursor();

        // Return true or any other value as per your requirement to indicate successful execution
        return true;
    }

    /**
     * @param $id
     * @param $title
     * @param $content
     * @return bool
     */
    public function editPost($id, $title, $content){
        $query = 'UPDATE Post SET title=:title, content=:content WHERE id=:id';

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);

        if ($statement->execute() === false) {
            // If execution fails, close the cursor and return false
            $statement->closeCursor();
            return false;
        }

        // Close the cursor after successful execution
        $statement->closeCursor();

        // Return true or any other value as per your requirement to indicate successful execution
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePost($id){
        $query = 'DELETE FROM Post WHERE id=:id';

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':id', $id);

        if ($statement->execute() === false) {
            // If execution fails, close the cursor and return false
            $statement->closeCursor();
            return false;
        }

        // Close the cursor after successful execution
        $statement->closeCursor();

        // Return true or any other value as per your requirement to indicate successful execution
        return true;
    }
}