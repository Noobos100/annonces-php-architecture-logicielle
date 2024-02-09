<?php

namespace control;
/**
 *
 */
class Presenter
{
    /**
     * @var
     */
    protected $annoncesCheck;

    /**
     * @param $annoncesCheck
     */
    public function __construct($annoncesCheck)
    {
        $this->annoncesCheck = $annoncesCheck;
    }

    /**
     * @return string|null
     * Cette méthode permet toutes les annonces
     */
    public function getAllAnnoncesHTML(): ?string
    {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $content = '<h1>List of Posts</h1>  <ul>';
            foreach ($this->annoncesCheck->getAnnoncesTxt() as $post) {
                $content .= ' <li>';
                $content .= '<a href="/annonces/index.php/post?id=' .
                    $post['id'] . '">' . htmlspecialchars($post['title']) . ' (' . $post['date'] . ')' . '</a>';
                $content .= ' </li>';
            }
            $content .= '</ul>';
        }
        return $content;
    }

    /**
     * @return string|null
     * Cette méthode permet d'afficher le post actuel
     */
    public function getCurrentPostHTML(): ?string
    {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];

            $content = '<div id="post-container"';
            $content .= '<div class="author">' . 'Auteur: ' . $post['author'] . '</div>';
            $content .= '<h1>' . 'Titre: ' . htmlspecialchars($post['title']) . '</h1>';
            $content .= '<div class="date">' . 'Posté le: ' . $post['date'] . '</div>';
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

    /**
     * @return string|null
     * Cette méthode permet d'afficher le formulaire d'édition d'un post
     */
    public function getEditPostHTML(): ?string
    {
        $content = null;

        $content .= '<h1>Edit Post (ID: ' . $_GET['id'] . ')</h1>';
        $content .= '<p>Fill in the form to edit the post</p>';
        $content .= '<form action="/annonces/index.php/edit?id=' . $_GET['id'] . '" method="post">';
        $content .= '<label for="title">Title:</label>';
        $content .= '<input type="text" id="title" name="title"';
        $content .= '<br>';
        $content .= '<label for="body">Body:</label>';
        $content .= '<textarea id="body" name="body"></textarea>';
        $content .= '<br>';
        $content .= '<input type="submit" value="Submit">';
        $content .= '</form>';
        return $content;

    }
}