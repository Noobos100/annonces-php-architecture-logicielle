<?php

namespace domain;
/**
 *
 */
class Post
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $title;
    /**
     * @var
     */
    protected $body;
    /**
     * @var
     */
    protected $date;
    /**
     * @var
     */
    protected $author;

    /**
     * @param $id
     * @param $title
     * @param $body
     * @param $date
     * @param $author
     */
    public function __construct($id, $title, $body, $date, $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
}