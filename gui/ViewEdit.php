<?php
namespace gui;
include_once "View.php";

/**
 * Class ViewEdit
 * @package gui
 * Vue pour l'édition d'une annonce
 */
class ViewEdit extends View
{
    /**
     * @param $layout
     * @param $presenter
     * Constructeur de la vue
     * On récupère le contenu de la vue à partir du Presenter
     */
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Edit Mode';

        $this->content = $presenter->getEditPostHTML();

        $this->content .= new ViewCreate($layout, $_SESSION['login']);


    }

}
