<div class="container">
    <div class="row pt-2">
                <div class="col-9"><h2>Liste des auteurs</h2></div>
                <div class="col-3"><a href="index.php?uc=auteurs&action=add" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajouter un auteur</a></div>
    </div>

    <form id="formRecherche" action ="index.php?uc=auteurs&action=list" method="post" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                
                    
                <?php if (empty('nom')){ // truc pour réecrire la variable de l'utilisateur
                    echo '<input type="text" class="form-control" name="nom" id="nom"  placeholder="Saisir le nom">';
                }
                    else{
                        echo '<input type="text" class="form-control" name="nom" id="nom"  value="'.$nom.'" placeholder="Saisir le nom">';
                     // affiche le libellé si pas vide
                    } // faut refaire les Div, j'ai mal mis
                ?> 
            </div>
            <div class="col">
                
                    
                <?php if (empty('prenom')){ // truc pour réecrire la variable de l'utilisateur
                    echo '<input type="text" class="form-control" name="prenom" id="prenom"  placeholder="Saisir le prénom">';
                }
                    else{
                        echo '<input type="text" class="form-control" name="prenom" id="prenom"  value="'.$prenom.'" placeholder="Saisir le prénom">';
                     // affiche le libellé si pas vide
                    } // faut refaire les Div, j'ai mal mis
                ?> 
            </div>
            <div class='col'>
                <select name="LibNationalite" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                    <?php echo "<option value='Tous'>Toutes les nationalités</option>";
                    foreach($lesNationalites as $nationalite){
                        $selection = $nationalite->numero==$nationaliteSel ? 'selected' : '';
                        echo "<option value='".$nationalite->numero."'". $selection.">".$nationalite->libNation."</option>";
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
                        <th scope="col" class="col-md-2">Numéro</th>
                        <th scope="col" class="col-md-3">Nom</th>
                        <th scope="col" class="col-md-3">Prénom</th>
                        <th scope="col" class="col-md-3">Nationalité</th>
                        <th scope="col" class="col-md-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($lesAuteurs as $auteur){

                    echo '<tr class="d-flex">';
                        echo "<td class='col-md-2'>".$auteur->numero."</td>";
                        echo "<td class='col-md-3'>".$auteur->nom."</td>";
                        echo "<td class='col-md-3'>".$auteur->prenom."</td>";
                        echo "<td class='col-md-3'>".$auteur->libNation."</td>";

                        echo "<td class='col-md-2'>
                                <a href='index.php?uc=auteurs&action=update&num=".$auteur->numero."' class='btn btn-primary'><i class='fas fa-pen'></i></a>

                                <a href='#modalsuppr' data-suppr='index.php?uc=auteurs&action=delete&num=".$auteur->numero."' data-toggle='modal' data-message ='Voulez vous supprimer cette auteur ?' class='btn btn-danger'><i class='fas far fa-trash-alt'></i</a>
                            </td>";
                    echo "</tr>";
                    //'supprNationalite.php?num=$nationalite->num'
                }?>
                </tbody>
            </table>
        </div>
    </div>