<?php
namespace gui;
include_once "View.php";

class ViewSignupSuccess extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: SignupSuccess';
        // mot de passe fort (au moins 12 caractères, avec lettres minuscules et majuscules, chiffres et caractères spéciaux)
        $this->content = '
            <p>Signup successfull !</p>
            <a href="/annonces/index.php">Retour à la page de connexion</a>';
    }
}