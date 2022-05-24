<?php
$action=$_GET['action'];
switch($action){
    
    case 'list' : 
        // Traitement du formulaire de recherche
        $libelle="";
        $continentSel="Tous";

        if (!empty($_POST['libelle']) || !empty($_POST['continent']))  {
            $libelle=$_POST['libelle'];
            $continentSel=$_POST['continent'];
           
        }
        
        $lesContinents=Continent::findAll();
        $lesNationalites = Nationalite::findAll($libelle,$continentSel);
        include('vues/nationalite/listeNationalites.php');
    break;

    case 'add' :
        $lesContinents = Continent::findAll();
        $mode="Ajouter";
        include ("vues/nationalite/formNationalite.php");
    break;

    case 'update' :
        $mode="Modifier";
        $lesContinents = Continent::findAll();
        $nationalite=Nationalite::findById($_GET['num']);
        include ("vues/nationalite/formNationalite.php");
        break;

    case 'delete' :  
        $nationalite=Nationalite::findById($_GET['num']);
        var_dump($nationalite);
        $nb=Nationalite::delete($nationalite);
        
        if ($nb==1){
            $_SESSION['message']=["success"=>"Le nationalite à bien été supprimé"];
        }
        else{
           $_SESSION['message']=["danger"=>"Le nationalite n'a pas été supprimé"];

        }
        header('location:index.php?uc=nationalites&action=list');
        exit();
    break;

    case 'valideform' :
         $nationalite = new  Nationalite();
         if (empty($_POST['num'])){ //Création
            
             $nationalite->setLibelle($_POST['libelle']);
             $continentSel= Continent::findById($_POST['continent']);
             $nationalite->setNumContinent($continentSel);
             $nb=Nationalite::add($nationalite);
             $message="ajouté";
             
         }else{ //Modification
            $nationalite->setNum($_POST['num']); echo 'coucou';
            $nationalite->setLibelle($_POST['libelle']);
            $continentSel= Continent::findById($_POST['continent']);
             $nationalite->setNumContinent($continentSel);
            $nb=Nationalite::update($nationalite);
            $message="modifié";
         }
         if ($nb==1){
             $_SESSION['message']=["success"=>"Le nationalite à bien été $message"];
         }
         else{
            $_SESSION['message']=["danger"=>"Le nationalite à bien été $message"];

         }
         header('location:index.php?uc=nationalites&action=list');
        exit();
        break; 
}