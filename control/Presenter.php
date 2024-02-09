<?php

namespace control;
class Presenter
{
    protected $annoncesCheck;

    public function __construct($annoncesCheck)
    {
        $this->annoncesCheck = $annoncesCheck;
    }

    public function getAllAnnoncesHTML()
    {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $content = '<h1>List of Posts</h1>  <ul>';
            foreach ($this->annoncesCheck->getAnnoncesTxt() as $post) {
                $content .= ' <li>';
                $content .= '<a href="/annonces/index.php/post?id=' .
                    $post['id'] . '">' . htmlspecialchars($post['title']) . ' ('.$post['date'] .')'. '</a>';
                $content .= ' </li>';
            }
            $content .= '</ul>';
        }
        return $content;
    }

    public function getCurrentPostHTML()
    {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];

            $content = '<div id="post-container"';
            $content .= '<div class="author">' .'Auteur: '. $post['author'] . '</div>';
            $content .= '<h1>' . 'Titre: '. htmlspecialchars($post['title']) . '</h1>';
            $content .= '<div class="date">' . 'Posté le: '. $post['date'] . '</div>';
            $content .= '<div class="body">' . htmlspecialchars($post['body']) . '</div>';
            $content .= '</div>';
            if ($_SESSION['login'] == $post['author'] /*|| $_SESSION['admin'] == '1')*/) {
                $content .= '<a href="/annonces/index.php/delete?id=' . $post['id'] . '">Delete</a>';
                $content .= '<br>';
                $content .= '<a href="/annonces/index.php/edit?id=' . $post['id'] . '">Edit</a>';
            }
        }
        return $content;
    }
}