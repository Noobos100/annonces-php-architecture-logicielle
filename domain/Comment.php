<?php

namespace domain;

class Comment
{
    protected $id;
    protected $author;
    protected $text;
    protected $postId;

    public function __construct($id, $author, $text, $postId)
    {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->postId = $postId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPostId()
    {
        return $this->postId;
    }

}