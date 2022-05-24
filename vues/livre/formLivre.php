<div class="container mt-5">
        <h2 class="pt-3 text-center"><?php echo $mode ?> un livre</h2>

       <form action="index.php?uc=livres&action=valideform" method="post" class=" col-md-6 offset-md-3 border border-primary p-3 round">
            <div class="form-group ">
           
                    <label for="Titre"><strong>Titre</strong></label>
                    <input type='text' class='form-control mb-3' id='titre' name='titre' value = '<?php if ($mode =='Modifier') {echo $livre->getTitre() ;}?>'>

                    <label for="ISBN"><strong>ISBN</strong></label>
                    <input type='text' class='form-control mb-3' id='isbn' name='isbn' value = '<?php if ($mode =='Modifier') {echo $livre->getISBN() ;}?>'>

                    <label for="Prix"><strong>Prix</strong></label>
                    <input type='number' class='form-control mb-3' id='prix' name='prix' value = '<?php if ($mode =='Modifier') {echo $livre->getPrix() ;}?>'>

                    <label for="Editeur"><strong>Editeur</strong></label>
                    <input type='text' class='form-control mb-3' id='editeur' name='editeur' value = '<?php if ($mode =='Modifier') {echo $livre->getEditeur() ;}?>'>
                    
                    <label for="Annee"><strong>Année</strong></label>
                    <input type='number' class='form-control mb-3' id='annee' name='annee' value = '<?php if ($mode =='Modifier') {echo $livre->getAnnee() ;}?>'>

                    <label for="Langue"><strong>Langue</strong></label>
                    <input type='text' class='form-control mb-3' id='langue' name='langue' value = '<?php if ($mode =='Modifier') {echo $livre->getLangue() ;}?>'>
                    
            
                    <label for="Auteur"><strong>Auteur</strong></label>
                    <div class='mb-3'>
                        <select name="NomAuteur" class="form-control">
                        <?php echo "<option value='Tous'>Tout les auteurs</option>";
                            foreach($lesAuteurs as $auteur){
                            $selection = $auteur->numero==$auteurSel ? 'selected' : '';
                            echo "<option value='".$auteur->numero."'". $selection.">".$auteur->nom."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <label for="Genre"><strong>Genre</strong></label>
                    <div class='mb-3'>
                        <select name="NomGenre" class="form-control">
                        <?php echo "<option value='Tous'>Tout les genres</option>";
                        foreach($lesGenres as $genre){
                            $selection = $genre->getNum()==$genreSel ? 'selected' : '';
                            echo "<option value='".$genre->getNum()."'". $selection.">".$genre->getLibelle()."</option>";
                            //Si ca bug c le get Numero et le Get libelle qui devraient etre 'numero' et 'libelle'
                            }
                            
                            ?>

                            
                        </select>
                    </div>



            </div>
            
            
               
            <input type='hidden' id='numero' name='numero' value="<?php if ($mode =='Modifier')  echo $livre->GetNum() ;?>">   
            
            <div class="row">
                <div class="col"><a href="index.php?uc=auteurs&action=list" class="btn btn-warning btn-block">Revenir a la liste</a></div>
           
                <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode ?></button></div>
            </div>
        
        </form>
</div>