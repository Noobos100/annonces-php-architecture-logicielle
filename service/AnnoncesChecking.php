<?php

namespace service;
/**
 *
 */
class AnnoncesChecking
{
    /**
     * @var
     */
    protected $annoncesTxt;

    /**
     * @return mixed
     */
    public function getAnnoncesTxt()
    {
        return $this->annoncesTxt;
    }

    /**
     * @param $login
     * @param $password
     * @param $data
     * @return bool
     */
    public function authenticate($login, $password, $data)
    {
        return ($data->getUser($login, $password) != null);
    }

    /**
     * @param $data
     * @return void
     */
    public function getAllAnnonces($data)
    {
        $annonces = $data->getAllAnnonces();

        $this->annoncesTxt = array();
        foreach ($annonces as $post) {
            $this->annoncesTxt[] = ['id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate(), 'author' => $post->getAuthor()];
        }
    }

    /**
     * @param $id
     * @param $data
     * @return void
     */
    public function getPost($id, $data)
    {
        $post = $data->getPost($id);

        $this->annoncesTxt[] = array('id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate(), 'author' => $post->getAuthor());
    }

    /**
     * @param $login
     * @param $password
     * @param $name
     * @param $surname
     * @param $data
     * @return bool
     */
    public function checkUser($login, $password, $name, $surname, $data)
    {
        // vérifie que login n'existe pas deja avec getLogin + mot de passe fort
        // (au moins 12 caractères, avec lettres minuscules et majuscules, chiffres et caractères spéciaux),
        // nom et prénom ne doivent pas être vides
        return ($data->getLogins($login) == null && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/', $password) && !empty($name) && !empty($surname));
    }

    /**
     * @param $title
     * @param $body
     * @param $login
     * @return bool
     */
    public function checkPost($title, $body, $login)
    {
        // vérifie que le titre et le corps ne sont pas vides, que l'utilisateur est bien login
        return (!empty($title) && !empty($body) && !empty($login));
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function checkEdit($id, $data)
    {
        // vérifie que le post existe et que l'utilisateur est bien l'auteur (ne fonctionne pas)
        return ($data->getPost($id) != null); /*&& $data->getPost($id)->getAuthor() == $_SESSION['login']);*/
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function checkDelete($id, $data)
    {
        // vérifie que le post existe
        return ($data->getPost($id) != null);
    }
}
