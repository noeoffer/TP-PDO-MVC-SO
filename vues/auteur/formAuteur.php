<div class="container mt-5">
        <h2 class="pt-3 text-center"><?php echo $mode ?> un auteur</h2>

       <form action="index.php?uc=auteurs&action=valideform" method="post" class=" col-md-6 offset-md-3 border border-primary p-3 round">
            <div class="form-group ">
           
                    <label for="Nom"><strong>Nom</strong></label>
                    <input type='text' class='form-control mb-3' id='nom' name='nom' value = '<?php if ($mode =='Modifier') {echo $auteur->GetNom() ;}?>'>

                    <label for="Prénom"><strong>Prénom</strong></label>
                    <input type='text' class='form-control mb-3' id='prenom' name='prenom' value = '<?php if ($mode =='Modifier') {echo $auteur->GetPrenom() ;}?>'>
                    
            
                    <label for="LibNationalite"><strong>Nationalité</strong></label>
                    <div class='mb-3'>
                        <select name="LibNationalite" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                        <?php echo "<option value='Tous'>Toutes les nationalités</option>";
                        foreach($lesNationalites as $nationalite){
                            $selection = $nationalite->numero==$nationaliteSel ? 'selected' : '';
                            echo "<option value='".$nationalite->numero."'". $selection.">".$nationalite->libNation."</option>";
                        }
                        ?>
                        </select>
                    </div>

            </div>
            
            
               
            <input type='hidden' id='numero' name='numero' value="<?php if ($mode =='Modifier')  echo $auteur->GetNum() ;?>">   
            
            <div class="row">
                <div class="col"><a href="index.php?uc=auteurs&action=list" class="btn btn-warning btn-block">Revenir a la liste</a></div>
           
                <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode ?></button></div>
            </div>
        
        </form>
</div>