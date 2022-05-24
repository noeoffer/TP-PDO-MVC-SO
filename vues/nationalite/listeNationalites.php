<div class="container">
    <div class="row pt-2">
                <div class="col-9"><h2>Liste des nationalités</h2></div>
                <div class="col-3"><a href="index.php?uc=nationalites&action=add" class="btn btn-success"><i class="fas fa-plus-circle"></i> Ajouter une nationalité</a></div>
    </div>

    <form id="formRecherche" action ="index.php?uc=nationalites&action=list" method="post" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                
                    
                <?php if (empty('libelle')){ // truc pour réecrire la variable de l'utilisateur
                    echo '<input type="text" class="form-control" name="libelle" id="libelle"  placeholder="Saisir le libellé">';
                }
                    else{
                        echo '<input type="text" class="form-control" name="libelle" id="libelle"  value="'.$libelle.'" placeholder="Saisir le libellé">';
                     // affiche le libellé si pas vide
                    } // faut refaire les Div, j'ai mal mis
                ?> 
            </div>
            <div class='col'>
                <select name="continent" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                    <?php echo "<option value='Tous'>Tous les continents</option>";
                    foreach($lesContinents as $continent){
                        $selection = $continent->getNum()==$continentSel ? 'selected' : '';
                        echo "<option value='".$continent->getNum()."'". $selection.">".$continent->getLibelle()."</option>";
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
                        <th scope="col" class="col-md-5">Libellé</th>
                        <th scope="col" class="col-md-3">Continent</th>
                        <th scope="col" class="col-md-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($lesNationalites as $nationalite){

                    echo '<tr class="d-flex">';
                        echo "<td class='col-md-2'>".$nationalite->numero."</td>";
                        echo "<td class='col-md-5'>".$nationalite->libNation."</td>";
                        echo "<td class='col-md-3'>".$nationalite->libContinent."</td>";
                        echo "<td class='col-md-2'>
                                <a href='index.php?uc=nationalites&action=update&num=".$nationalite->numero."' class='btn btn-primary'><i class='fas fa-pen'></i></a>

                                <a href='#modalsuppr' data-suppr='index.php?uc=nationalites&action=delete&num=".$nationalite->numero."' data-toggle='modal' data-message ='Voulez vous supprimer cette nationalité ?' class='btn btn-danger'><i class='fas far fa-trash-alt'></i</a>
                            </td>";
                    echo "</tr>";
                    //'supprNationalite.php?num=$nationalite->num'
                }?>
                </tbody>
            </table>
        </div>
    </div>