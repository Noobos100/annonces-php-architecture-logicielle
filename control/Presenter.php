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
            $content .= '<h1>' . htmlspecialchars($post['title']) . '</h1>';
            $content .= '<div class="author">' . $post['author'] . '</div>';
            $content .= '<div class="date">' . $post['date'] . '</div>';
            $content .= '<div class="body">' . htmlspecialchars($post['body']) . '</div>';
            $content .= '</div>';
        }
        return $content;
    }
}