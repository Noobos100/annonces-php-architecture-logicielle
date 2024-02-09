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
        } else return false;

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

    public function editAction($id, $data, $annoncesCheck, $title, $content): bool
    {
        if ($annoncesCheck->checkEdit($id, $data)) {
            $data->editPost($id, $title, $content);
            return true;
        } else return false;
    }

    public function deleteAction($id, $data, $annoncesCheck): bool
    {
        if ($annoncesCheck->checkDelete($id, $data)) {
            $data->deletePost($id);
            return true;
        } else return false;
    }
}