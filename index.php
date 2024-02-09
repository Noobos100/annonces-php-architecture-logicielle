<?php
session_start();
// charge et initialise les bibliothèques globales
include_once 'data/DataAccess.php';

include_once 'control/Controllers.php';
include_once 'control/Presenter.php';

include_once 'service/AnnoncesChecking.php';

include_once 'gui/ViewLogin.php';
include_once 'gui/ViewAnnonces.php';
include_once 'gui/ViewPost.php';
include_once 'gui/ViewSignup.php';
include_once 'gui/Layout.php';
include_once 'gui/ViewCreate.php';
include_once 'gui/ViewEdit.php';

use control\{Controllers, Presenter};
use data\DataAccess;
use gui\{Layout, ViewAnnonces, ViewEdit, ViewLogin, ViewPost, ViewSignup};
use service\AnnoncesChecking;

$data = null;
try {
    // construction du modèle
    $data = new DataAccess( new PDO('mysql:host=mysql-cdaw.alwaysdata.net;dbname=cdaw_annonces_db', 'cdaw_annonces', 'vraimdp') );

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

// initialisation du controller
$controller = new Controllers();

// intialisation du cas d'utilisation AnnoncesChecking
$annoncesCheck = new AnnoncesChecking() ;

// intialisation du presenter avec accès aux données de AnnoncesCheking
$presenter = new Presenter($annoncesCheck);

// chemin de l'URL demandée au navigateur
// (p.ex. /annonces/index.php)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// route la requête en interne
// i.e. lance le bon contrôleur en fonction de la requête effectuée
if ( '/annonces/' == $uri || '/annonces/index.php' == $uri) {

    $controller->loginAction();
}


// première connexion (avec le POST)
elseif ( '/annonces/index.php/annonces' == $uri
    && isset($_POST['login']) && isset($_POST['password']) ){

    $result = $controller->annoncesAction($_POST['login'], $_POST['password'], $data, $annoncesCheck);

    if ($result) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        $layout = new Layout("gui/layout.html" );
        $vueAnnonces= new ViewAnnonces( $layout, $_SESSION['login'], $presenter);

        $vueAnnonces->display();
    }
    else {
        $controller->loginAction();
        header('Location: /annonces/index.php');
    }

}
// pendant la session (avec les variables de session)
elseif ( '/annonces/index.php/annonces' == $uri
    && isset($_SESSION['login']) && isset($_SESSION['password'])){

    $controller->annoncesAction($_SESSION['login'], $_SESSION['password'], $data, $annoncesCheck);

    $layout = new Layout("gui/layout.html" );
    $vueAnnonces= new ViewAnnonces( $layout, $_SESSION['login'], $presenter);

    $vueAnnonces->display();
}
elseif ( '/annonces/index.php/post' == $uri
    && isset($_GET['id']) && isset($_SESSION['login']) && isset($_SESSION['password'])) {

    $controller->postAction($_GET['id'], $data, $annoncesCheck);

    $layout = new Layout("gui/layout.html" );
    $vuePost= new ViewPost( $layout, $presenter );

    $vuePost->display();
}
elseif ( '/annonces/index.php/signup' == $uri) {

    $layout = new Layout("gui/layout.html" );
    $vueSignup= new ViewSignup( $layout );

    $vueSignup->display();
}
elseif ( '/annonces/index.php/signupsuccess' == $uri) {

    $result = $controller->signupAction($_POST['username'], $_POST['password'], $_POST['name'], $_POST['surname'], $data, $annoncesCheck);
    $layout = new Layout("gui/layout.html" );
    if ($result) {
        $vueSignupSuccess= new ViewLogin( $layout );

    }
    else {
        $vueSignupSuccess= new ViewSignup( $layout );

    }
    $vueSignupSuccess->display();
}

// Si l'utilisateur a réussi à créer une annonce, il est redirigé vers la page des annonces
elseif ('/annonces/index.php/createsuccess' == $uri) {
    $result = $controller->createAction($_POST['title'], $_POST['content'], $_SESSION['login'], $data, $annoncesCheck);
    $layout = new Layout("gui/layout.html");

    $vueAnnonces = new ViewAnnonces($layout, $_SESSION['login'], $presenter);

    if ($result) {
        $vueAnnonces->display();
        header('Location: /annonces/index.php/annonces');
    }
}
elseif ( '/annonces/index.php/delete' == $uri
    && isset($_GET['id']) && isset($_SESSION['login']) && isset($_SESSION['password'])) {

    $result = $controller->deleteAction($_GET['id'], $data, $annoncesCheck);

    $layout = new Layout("gui/layout.html" );
    $vueAnnonces= new ViewAnnonces( $layout, $_SESSION['login'], $presenter);

    if ($result) {
        $vueAnnonces->display();
        header('Location: /annonces/index.php/annonces');
    }
}
// Je n'arrive pas à récupérer les données du post mais l'ID suffit pour éditer
// Bien que ce soit une grande faille de sécurité car il suffit d'avoir l'URL
// et être connecté avec n'import quel compte pour éditer n'importe quelle annonce
elseif ( '/annonces/index.php/edit' == $uri
    && isset($_GET['id']) && isset($_SESSION['login']) && isset($_SESSION['password'])) {

    $layout = new Layout("gui/layout.html" );
    $vueEdit= new ViewEdit( $layout, $presenter);
    if (isset($_POST['title']) && isset($_POST['body'])) {
        $result = $controller->editAction($_GET['id'], $data, $annoncesCheck, $_POST['title'], $_POST['body']);

        if ($result) {
            $vueEdit->display();
            header('Location: /annonces/index.php/annonces');
        }
    }
    else {
        $vueEdit->display();
    }
}

// 404 Not Found
else {
    header('Status: 404 Not Found');
    echo '<html lang="en">
            <body>
                <h1> Error 404: Page Not Found</h1>
                <button onclick="location.href=\'/annonces/index.php\'">Back to login</button>
            </body></html>';
}