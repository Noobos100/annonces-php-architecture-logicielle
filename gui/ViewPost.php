<?php
namespace gui;
include_once "View.php";

class ViewPost extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Post';

        $this->content = $presenter->getCurrentPostHTML();

        $this->content.= new ViewComment($layout, $_SESSION['login']);

        $this->content.= new ViewCreate($layout, $_SESSION['login']);

        $this->content.= $presenter->getCommentsHTML();
    }
}