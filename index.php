<?php ob_start();
session_start(); 
include "vues/header.php";
include "modeles/Livre.php";
include "modeles/Genre.php";
include 'modeles/Auteur.php';
include 'modeles/Nationalite.php';
include 'modeles/Continent.php';
include 'modeles/monPdo.php';
include 'vues/messagesFlash.php';

$uc = empty($_GET['uc']) ? "accueil" : $_GET['uc'];

switch($uc){
    case 'accueil' :
        include('vues/Accueil.php');
        break;
    case 'continents' :
        include('controllers/continentController.php');
        break;
    case 'nationalites' :
        include('Controllers/nationaliteController.php');
        break;
    case 'auteurs' :
        include('controllers/auteurController.php');
        break;    
    case 'livres' :
        include('controllers/livreController.php');
        break;
    case 'genres' :
        include('controllers/genreController.php');
        break;    
    
}

include "vues/footer.php";?>