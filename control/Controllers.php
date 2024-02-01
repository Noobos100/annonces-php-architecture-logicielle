<?php

namespace control;
use Layout;
use ViewLogin;

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
        $annoncesCheck->addUser($login, $password, $name, $surname, $data);
    }
}