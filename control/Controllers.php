<?php

namespace control;

use gui\Layout;
use gui\ViewLogin;

include_once "service/AnnoncesChecking.php";

class Controllers
{
    public function loginAction()
    {
        $layout = new Layout("gui/layout.html");
        $vueLogin = new ViewLogin($layout);

        $vueLogin->display();
    }

    public function annoncesAction($login, $password, $data, $annoncesCheck)
    {

        if ($annoncesCheck->authenticate($login, $password, $data))
            $annoncesCheck->getAllAnnonces($data);

    }

    public function postAction($id, $data, $annoncesCheck)
    {
        $annoncesCheck->getPost($id, $data);
    }

    public function signupAction($login, $password, $name, $surname, $data, $annoncesCheck)
    {
        if ($annoncesCheck->checkUser($login, $password, $name, $surname, $data)) {
            $data->addUser($login, $password, $name, $surname);
            return true;
        }
        else return false;
    }
}