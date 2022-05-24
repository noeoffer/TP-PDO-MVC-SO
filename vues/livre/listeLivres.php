<div class="container">
    <div class="row pt-2">
                <div class="col-9"><h2>Liste des Livres</h2></div>
                <div class="col-3"><a href="index.php?uc=livres&action=add" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajouter un livre</a></div>
    </div>

    <form id="formRecherche" action ="index.php?uc=livres&action=list" method="post" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                
                    
                <?php if (empty('titre')){ // truc pour réecrire la variable de l'utilisateur
                    echo '<input type="text" class="form-control" name="titre" id="titre"  placeholder="Saisir le titre">';
                }
                    else{
                        echo '<input type="text" class="form-control" name="titre" id="titre"  value="'.$titre.'" placeholder="Saisir le titre">';
                     // affiche le libellé si pas vide
                    } // faut refaire les Div, j'ai mal mis
                ?> 
            </div>
            <div class='col'>
                <select name="NomAuteur" class="form-control">
                    <?php echo "<option value='Tous'>Tout les auteurs</option>";
                    foreach($lesAuteurs as $auteur){
                        $selection = $auteur->numero==$auteurSel ? 'selected' : '';
                        echo "<option value='".$auteur->numero."'". $selection.">".$auteur->nom."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class='col'>
                <select name="NomGenre" class="form-control">
                    <?php echo "<option value='Tous'>Tout les genres</option>";
                    foreach($lesGenres as $genre){
                        $selection = $genre->getNum()==$genreSel ? 'selected' : '';
                        echo "<option value='".$genre->getNum()."'". $selection.">".$genre->getLibelle()."</option>";
                        //Si ca bug c le get NUm et le Get libelle qui devraient etre 'num' et 'libelle
                        /*Aussi quand on sélectionne par genre ça prend le num du genre qu'on sélectionne et tri par le num d'auteur 
                        (genre on sélectionne bd qui est = à 4 et ça prend l'auteur num 4 donc steinbeck et ça marche inversement si on 
                        prend un auteur ça prend son num et trie par le num du genre*/
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block">Rechercher</button>
            </div>
        </div>

    </form>

    <table class="table table-striped table-hover">
                <thead>
                    <tr class="d-flex">
                        <th scope="col" class="col-md-1">ISBN</th>
                        <th scope="col" class="col-md-2">Titre</th>
                        <th scope="col" class="col-md-1">Prix</th>
                        <th scope="col" class="col-md-2">Editeur</th>
                        <th scope="col" class="col-md-1">Annee</th>
                        <th scope="col" class="col-md-1">Langue</th>
                        <th scope="col" class="col-md-1">Auteur</th>
                        <th scope="col" class="col-md-1">Genre</th>
                        <th scope="col" class="col-md-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($lesLivres as $livre){

                    echo '<tr class="d-flex">';
                        echo "<td class='col-md-1'>".$livre->ISBN."</td>";
                        echo "<td class='col-md-2'>".$livre->titre."</td>";
                        echo "<td class='col-md-1'>".$livre->prix." €</td>";
                        echo "<td class='col-md-2'>".$livre->editeur."</td>";
                        echo "<td class='col-md-1'>".$livre->annee."</td>";
                        echo "<td class='col-md-1'>".$livre->langue."</td>";
                        echo "<td class='col-md-1'>".$livre->numAuteur."</td>";
                        echo "<td class='col-md-1'>".$livre->numGenre."</td>";
                        //var_dump($livre->numAuteur);
                        /*BUG ICI on arrive à récuperer le numAuteur et le numGenre mais on arrive pas le transformer en nomAuteur et nomGenre qui 
                        sont pas dans la même table*/
                        

                        echo "<td class='col-md-2'>
                                <a href='index.php?uc=livres&action=update&num=".$livre->ISBN."' class='btn btn-primary'><i class='fas fa-pen'></i></a>

                                <a href='#modalsuppr' data-suppr='index.php?uc=livres&action=delete&num=".$livre->ISBN."' data-toggle='modal' data-message ='Voulez vous supprimer ce livre ?' class='btn btn-danger'><i class='fas far fa-trash-alt'></i</a>
                            </td>";
                    echo "</tr>";
                    //'supprNationalite.php?num=$nationalite->num'
                }?>
                </tbody>
            </table>
        </div>
    </div>