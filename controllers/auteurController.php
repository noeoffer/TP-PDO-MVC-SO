<?php
$action=$_GET['action'];
switch($action){
    
    case 'list' : 
        // Traitement du formulaire de recherche
        $nom="";
        $prenom="";
        $nationaliteSel="Tous";

        if (!empty($_POST['nom']) || !empty($_POST['LibNationalite']) || !empty($_POST['prenom']))  {
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $nationaliteSel=$_POST['LibNationalite'];
           
        }
        
        $lesNationalites=Nationalite::findAll();
        $lesAuteurs=Auteur::findAll($nom,$prenom,$nationaliteSel);
        include('vues/auteur/listeAuteurs.php');
    break;

    case 'add' :
        $mode="Ajouter";
        $lesNationalites = Nationalite::findAll();
        include ("vues/auteur/formAuteur.php");
    break;

    case 'update' :
        $mode="Modifier";
        //$nom=$_POST['nom'];
        //$prenom=$_POST['prenom'];
        $lesNationalites = Nationalite::findAll();
        $auteur=Auteur::findById($_GET['num']);
        include ("vues/auteur/formAuteur.php");
        break;

    case 'delete' :  
        $auteur=Auteur::findById($_GET['num']);
        $nb=Auteur::delete($auteur);
        if ($nb==1){
            $_SESSION['message']=["success"=>"L'auteur à bien été supprimé"];
        }
        else{
           $_SESSION['message']=["danger"=>"L'auteur n'a pas été supprimé"];

        }
        header('location:index.php?uc=auteurs&action=list');
        exit();
    break;

    case 'valideform' :
         $auteur = new  Auteur();
         if (empty($_POST['numero'])){ //Création

             $auteur->setNom($_POST['nom']);
             $auteur->setPrenom($_POST['prenom']);
             $nationaliteSel= Nationalite::findById($_POST['LibNationalite']);
             $auteur->setNumNationalite($nationaliteSel);
             
             $nb=Auteur::add($auteur);
             $message="ajouté";

         }else{ //Modification
            $auteur->setNum($_POST['numero']);
            $auteur->setNom($_POST['nom']);
            $auteur->setPrenom($_POST['prenom']);
            $nationaliteSel= Nationalite::findById($_POST['LibNationalite']);
            $auteur->setNumNationalite($nationaliteSel);

            $nb=Auteur::update($auteur);
            $message="modifié";
         }
         if ($nb==1){
             $_SESSION['message']=["success"=>"L'auteur à bien été $message"];
         }
         else{
            $_SESSION['message']=["danger"=>"L'auteur à bien été $message"];

         }
         header('location:index.php?uc=auteurs&action=list');
        exit();
        break; 
}