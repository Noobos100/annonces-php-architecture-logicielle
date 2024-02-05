<?php
namespace gui;
include_once "View.php";

class ViewSignupSuccess extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        if( $presenter->getAllAnnoncesHTML() == null ){
            header( "refresh:5;url=/annonces/ViewSignup.php" );
            echo 'Erreur de login (existe déjà) et/ou de mot de passe (ne contient pas les charactères nécéssaires) -> rechargement de la page d\'inscription dans 5 sec. ...';
            exit;
        }

        $this->title = 'Exemple Annonces Basic PHP: SignupSuccess';

        $this->content = '
            <p>Signup successful !</p>
            <a href="refresh:5;url=/annonces/index.php">Redirection vers la page de connexion dans 5 secondes...</a>';
    }
}