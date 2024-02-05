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
            $this->annoncesTxt[] = ['id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate(), 'author' => $post->getAuthor()];
        }
    }

    public function getPost($id, $data)
    {
        $post = $data->getPost($id);

        $this->annoncesTxt[] = array('id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate(), 'author' => $post->getAuthor());
    }

    public function checkUser($login, $password, $name, $surname, $data)
    {
        // vérifie que login n'existe pas deja avec getLogin + mot de passe fort
        // (au moins 12 caractères, avec lettres minuscules et majuscules, chiffres et caractères spéciaux),
        // nom et prénom ne doivent pas être vides
        return ($data->getLogins($login) == null && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/', $password) && !empty($name) && !empty($surname));
    }

    public function checkPost($title, $body, $login)
    {
        // vérifie que le titre et le corps ne sont pas vides, que l'utilisateur est bien login
        return (!empty($title) && !empty($body) && !empty($login));
    }
}
