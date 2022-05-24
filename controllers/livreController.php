<?php
$action=$_GET['action'];
switch($action){
    
    case 'list' : 
        // Traitement du formulaire de recherche
        $titre="";
        $auteurSel="Tous";
        $genreSel="Tous";

        if (!empty($_POST['nom']) || !empty($_POST['NomAuteur']) || !empty($_POST['NomGenre']))  {
            $titre=$_POST['titre'];
            $auteurSel=$_POST['NomAuteur'];
            $genreSel=$_POST['NomGenre'];
            //AuteurSel et GenreSel ne contiennent rien (bug)
           
        }
        $lesAuteurs=Auteur::findAll();
        $lesGenres=Genre::findAll();
        $lesLivres=Livre::findAll();
        $lesLivres=Livre::findAll($titre,$auteurSel,$genreSel);

        include('vues/livre/listeLivres.php');
    break;

    case 'add' :
        $mode="Ajouter";
        $lesGenres = Genre::findAll();
        $lesAuteurs = Auteur::findAll();
        include ("vues/livre/formLivre.php");
    break;

    case 'update' :
        $auteurSel="Tous";
        $genreSel="Tous";
        $mode="Modifier";
    
        $lesAuteurs=Auteur::findAll();
        $lesGenres=Genre::findAll();
        $lesLivres=Livre::findAll();
        $livre=Livre::findById($_GET['num']);
        include ("vues/livre/formLivre.php");
        break;

    case 'delete' :  
        $livre=Livre::findById($_GET['num']);
        $nb=Livre::delete($livre);
        if ($nb==1){
            $_SESSION['message']=["success"=>"livre à bien été supprimé"];
        }
        else{
           $_SESSION['message']=["danger"=>"L'livre n'a pas été supprimé"];

        }
        header('location:index.php?uc=livres&action=list');
        exit();
    break;

    case 'valideform' :
         $livre = new  Livre();
         if (empty($_POST['numero'])){ //Création

             $livre->setTitre($_POST['titre']);
             $livre->setISBN($_POST['isbn']);
             $livre->setPrix($_POST['prix']);
             $livre->setEditeur($_POST['editeur']);
             $livre->setAnnee($_POST['annee']);
             $livre->setLangue($_POST['langue']);
             $auteurSel= Auteur::findById($_POST['NomAuteur']);
             $genreSel= Genre::findById($_POST['NomGenre']);
             $livre->setNumAuteur($auteurSel);
             $livre->setNumGenre($genreSel);

             $nb=Livre::add($livre);
             $message="ajouté";

         }else{ //Modification
            $livre->setTitre($_POST['titre']);
            $livre->setISBN($_POST['isbn']);
            $livre->setNum($_POST['numero']);
            $livre->setPrix($_POST['prix']);
            $livre->setEditeur($_POST['editeur']);
            $livre->setAnnee($_POST['annee']);
            $livre->setLangue($_POST['langue']);  
            $auteurSel= Auteur::findById($_POST['auteurSel']);
            $genreSel= Genre::findById($_POST['genreSel']);
            $livre->setNumAuteur($auteurSel);
             $livre->setNumGenre($genreSel);

            $nb=Livre::update($livre);
            $message="modifié";
         }
         if ($nb==1){
             $_SESSION['message']=["success"=>"L'livre à bien été $message"];
         }
         else{
            $_SESSION['message']=["danger"=>"L'livre à bien été $message"];

         }
         header('location:index.php?uc=livres&action=list');
        exit();
        break; 
}