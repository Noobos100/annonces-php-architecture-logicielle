<?php
namespace gui;
include_once "View.php";

class ViewSignup extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Signup';
        // mot de passe fort (au moins 12 caractères, avec lettres minuscules et majuscules, chiffres et caractères spéciaux)
        $this->content = '
            <form method="post" action="/annonces/index.php/signupsucess">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" required>
                <br>
                <input type="submit" value="Signup">
            </form>
            <a href="/annonces/index.php">Déjà un compte ?</a>';
    }
}