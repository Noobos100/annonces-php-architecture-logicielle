<?php

namespace service;
class AnnoncesChecking
{
    protected $annoncesTxt;

    public function getAnnoncesTxt()
    {
        return $this->annoncesTxt;
    }

    public function authenticate($login, $password, $data)
    {
        return ($data->getUser($login, $password) != null);
    }

    public function getAllAnnonces($data)
    {
        $annonces = $data->getAllAnnonces();

        $this->annoncesTxt = array();
        foreach ($annonces as $post) {
            $this->annoncesTxt[] = ['id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate()];
        }
    }

    public function getPost($id, $data)
    {
        $post = $data->getPost($id);

        $this->annoncesTxt[] = array('id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate());
    }

    public function addUser($login, $password, $name, $surname, $data)
    {
        // vérifie que login (identifiant unique), mot de passe fort (au moins 12 caractères, avec lettres minuscules et majuscules, chiffres et caractères spéciaux),
        // nom et prénom ne doivent pas être vides
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{12,}$/', $password) && !empty($login) && !empty($name) && !empty($surname)) {
            $data->addUser($login, $password, $name, $surname);
            return true;
        } else {
            return false;
        }
    }
}