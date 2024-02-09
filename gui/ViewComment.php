<?php

namespace gui;

class ViewComment extends View
{
    public function __construct($layout, $login)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Annonces';
        $this->content = '<div class="commenting-section">
        <span>Add a comment</span>
        <form action="/annonces/index.php/createcomment" method="post">
            <input type="hidden" name="id" value="'.$_GET['id'].'">
            <input type="hidden" name="login" value="'.$login.'">
            <input type="text" name="content" placeholder="Your comment">
            <input type="submit" value="Submit"></form></div>
            ';
    }

    public function __toString()
    {
        return $this->content;
    }
}