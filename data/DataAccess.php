<?php

namespace data;

use domain\{Comment, Post, User};
use service\DataAccessInterface;

include_once "service/DataAccessInterface.php";

include_once "domain/Post.php";
include_once "domain/User.php";
include_once "domain/Comment.php";


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

        $query = 'SELECT login FROM User WHERE login="' . $login . '" and password="' . $password . '"';
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

    public function getCommentsFromPostID($id)
    {
        $query = ('SELECT * FROM Comment WHERE post_id= :id');

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $comments = array();

        while ($row = $statement->fetch()) {
            $currentComment = new Comment($row['comment_id'], $row['comment_author'], $row['comment_text'], $row['post_id']);
            $comments[] = $currentComment;
        }

        $statement->closeCursor();

        return $comments;
    }

    public function getCommentsFromLogin($login)
    {
        $query = ('SELECT * FROM Comment WHERE comment_author=:login');

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':login', $login);
        $statement->execute();

        $comments = array();

        while ($row = $statement->fetch()) {
            $currentComment = new Comment($row['comment_id'], $row['comment_author'], $row['comment_text'], $row['post_id']);
            $comments[] = $currentComment;
        }

        $statement->closeCursor();

        return $comments;
    }

    public function getReceivedComments($login)
    {
        $query = ('SELECT * FROM Comment WHERE post_id IN (SELECT id FROM Post WHERE login="' . $login . '")');

            $statement = $this->dataAccess->prepare($query);
            $statement->bindParam(':login', $login);
            $statement->execute();

            $comments = array();

            while ($row = $statement->fetch()) {
                $currentComment = new Comment($row['comment_id'], $row['comment_author'], $row['comment_text'], $row['post_id']);
                $comments[] = $currentComment;
            }

            $statement->closeCursor();

            return $comments;
        }

    public function getLogins($login)
    {
        $query = 'SELECT login FROM User WHERE login="' . $login . '"';

        $result = $this->dataAccess->query($query);

        if ($result === false) {
            return null;
        }

        $row = $result->fetch();
        $result->closeCursor();

        if ($row === false) {
            // No results found
            return null;
        }

        return $row['login'];
    }

    public function addComment($text, $login, $id)
    {
        $query = 'INSERT INTO Comment (post_id, comment_author, comment_text) VALUES (:id, :login, :content)';

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':login', $login);
        $statement->bindParam(':content', $text);

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


    public function addPost($title, $content, $login){
        $query = 'INSERT INTO Post (title, content, login) VALUES (:title, :content, :login)';

        $statement = $this->dataAccess->prepare($query);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':login', $login);

        if ($statement->execute() === false) {
            $statement->closeCursor();
            return false;
        }

        $statement->closeCursor();

        return true;
    }
}