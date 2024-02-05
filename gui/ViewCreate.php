<?php

namespace gui;
include_once "View.php";

class ViewCreate
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Create';
        $this->content =
            '<form method="post" action="/annonces/index.php/createsuccess">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <br>
                <label for="content">Content:</label>
                <input type="text" id="content" name="content" required>
                <br>
                <input type="submit" value="Create">
            </form>
            <a href="/annonces/index.php">Retour</a>';
    }



}