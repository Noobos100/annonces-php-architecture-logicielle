<?php

namespace domain;
class Post
{
    protected $id;
    protected $title;
    protected $body;
    protected $date;
    protected $author;

    public function __construct($id, $title, $body, $date, $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->author = $author;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getDate()
    {
        return $this->date;
    }
}