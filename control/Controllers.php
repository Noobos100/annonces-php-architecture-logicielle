<?php

namespace control;

use gui\Layout;
use gui\ViewLogin;

include_once "service/AnnoncesChecking.php";

class Controllers
{
    public function loginAction(): void
    {
        $layout = new Layout("gui/layout.html");
        $vueLogin = new ViewLogin($layout);

        $vueLogin->display();
    }

    public function annoncesAction($login, $password, $data, $annoncesCheck): bool
    {

        if ($annoncesCheck->authenticate($login, $password, $data)) {
            $annoncesCheck->getAllAnnonces($data);
            return true;
        }
        else return false;

    }

    public function postAction($id, $data, $annoncesCheck): void
    {
        $annoncesCheck->getPost($id, $data);
    }

    public function signupAction($login, $password, $name, $surname, $data, $annoncesCheck): bool
    {
        if ($annoncesCheck->checkUser($login, $password, $name, $surname, $data)) {
            $data->addUser($login, $password, $name, $surname);
            return true;
        } else return false;
    }

    public function createAction($title, $content, $login, $data, $annoncesCheck): bool
    {
        if ($annoncesCheck->checkPost($title, $content, $login)) {
            $data->addPost($title, $content, $login);
            return true;
        } else return false;
    }

    public function commentAction($id, $data, $annoncesCheck): void
    {
        $annoncesCheck->getComments($id, $data);
    }

    public function createCommentAction($id, $login, $content, $data, $annoncesCheck)
    {
        if ($annoncesCheck->checkComment($id, $login, $content)) {
            $data->addComment($id, $login, $content);
            return true;
        } else return false;
    }

}