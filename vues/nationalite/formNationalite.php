<div class="container mt-5">
        <h2 class="pt-3 text-center"><?php echo $mode ?> une nationalité</h2>

       <form action="index.php?uc=nationalites&action=valideform" method="post" class=" col-md-6 offset-md-3 border border-primary p-3 round">
            <div class="form-group ">
           
                    <label for="libelle"><strong>Libellé</strong></label>
                    <input type='text' class='form-control mb-3' id='libelle' placeholder='Saisir le libellé' name='libelle' value="<?php if ($mode =='Modifier') {echo $nationalite->getLibelle() ;}?>">
                    
            
                <div class='mb-3'>
                    <select name="continent" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                    <?php echo "<option value='Tous'>Tous les continents</option>";
                    foreach($lesContinents as $continent){
                        $selection = $continent->getNum()==$continentSel ? 'selected' : '';
                        echo "<option value='".$continent->getNum()."'". $selection.">".$continent->getLibelle()."</option>";
                    }
                    ?>
                    </select>
                </div>
            </div>
            
            
               
            <input type='hidden' id='num' name='num' value="<?php if ($mode =='Modifier')  echo $nationalite->getNum() ;?>">   
            
            <div class="row">
                <div class="col"><a href="index.php?uc=nationalites&action=list" class="btn btn-warning btn-block">Revenir a la liste</a></div>
           
                <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode ?></button></div>
            </div>
        
        </form>
</div>