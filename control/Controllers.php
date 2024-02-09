<?php

namespace control;

use gui\Layout;
use gui\ViewLogin;

include_once "service/AnnoncesChecking.php";

/**
 * Class Controllers
 * @package control
 * Cette classe permet de gérer les actions de l'utilisateur
 */
class Controllers
{
    /**
     * @return void
     * Cette méthode permet d'afficher la page de connexion
     */
    public function loginAction(): void
    {
        $layout = new Layout("gui/layout.html");
        $vueLogin = new ViewLogin($layout);

        $vueLogin->display();
    }

    /**
     * @param $login
     * @param $password
     * @param $data
     * @param $annoncesCheck
     * @return bool
     */
    public function annoncesAction($login, $password, $data, $annoncesCheck): bool
    {

        if ($annoncesCheck->authenticate($login, $password, $data)) {
            $annoncesCheck->getAllAnnonces($data);
            return true;
        } else return false;

    }

    /**
     * @param $id
     * @param $data
     * @param $annoncesCheck
     * @return void
     */
    public function postAction($id, $data, $annoncesCheck): void
    {
        $annoncesCheck->getPost($id, $data);
    }

    /**
     * @param $login
     * @param $password
     * @param $name
     * @param $surname
     * @param $data
     * @param $annoncesCheck
     * @return bool
     */
    public function signupAction($login, $password, $name, $surname, $data, $annoncesCheck): bool
    {
        if ($annoncesCheck->checkUser($login, $password, $name, $surname, $data)) {
            $data->addUser($login, $password, $name, $surname);
            return true;
        } else return false;
    }

    /**
     * @param $title
     * @param $content
     * @param $login
     * @param $data
     * @param $annoncesCheck
     * @return bool
     * Cette méthode permet de créer un post
     * Elle vérifie si le titre et le contenu ne sont pas vides
     */
    public function createAction($title, $content, $login, $data, $annoncesCheck): bool
    {
        if ($annoncesCheck->checkPost($title, $content, $login)) {
            $data->addPost($title, $content, $login);
            return true;
        } else return false;
    }

    /**
     * @param $id
     * @param $data
     * @param $annoncesCheck
     * @param $title
     * @param $content
     * @return bool
     * Cette méthode permet de modifier un post
     */
    public function editAction($id, $data, $annoncesCheck, $title, $content): bool
    {
        if ($annoncesCheck->checkEdit($id, $data)) {
            $data->editPost($id, $title, $content);
            return true;
        } else return false;
    }

    /**
     * @param $id
     * @param $data
     * @param $annoncesCheck
     * @return bool
     * Cette méthode permet de supprimer un post
     * Elle vérifie si l'utilisateur est bien l'auteur du post
     */
    public function deleteAction($id, $data, $annoncesCheck): bool
    {
        if ($annoncesCheck->checkDelete($id, $data)) {
            $data->deletePost($id);
            return true;
        } else return false;
    }
}