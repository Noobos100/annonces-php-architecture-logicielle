<?php
namespace gui;
include_once "View.php";

class ViewCreate extends View
{
    public function __construct($layout, $login)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Create';
        $this->content =
            '<p>Create a post:</p>
            <form method="post" action="/annonces/index.php/createsuccess">
                <input type="hidden" id="login" name="login" value="' . $login . '">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <br>
                <label for="content">Content:</label>
                <input type="text" id="content" name="content" required>
                <br>
                <input type="submit" alt="Create a post" value="Create">
            </form>
            <a href="/annonces/index.php">Back to login</a>';
    }

    public function __toString()
    {
        return $this->content;
    }



}