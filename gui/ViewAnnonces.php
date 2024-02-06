<?php
namespace gui;
include_once "View.php";

class ViewAnnonces extends View
{
    public function __construct($layout, $login, $presenter)
    {
        parent::__construct($layout);

        if( $login =='' ){
            header( "refresh:5;url=/annonces/index.php" );
            echo 'Erreur de login et/ou de mot de passe (redirection automatique dans 5 sec.)';
            exit;
        }

        $this->title = 'Exemple Annonces Basic PHP: Annonces';
        $this->content = '<p>You are logged in as: <b>' . $_SESSION['login'] . '</b></p>';

        $this->content.= new ViewCreate($layout, $login);

        $this->content.= $presenter->getAllAnnoncesHTML();
    }

    public function displayErrorMessage($message) {
        // You can customize this to display the error message in the existing content
        echo '<p style="color: red;">' . $message . '</p>';
        $this->display();
    }
}