<div class="container mt-5">
        <h2 class="pt-3 text-center"><?php echo $mode ?> un genre</h2>

       <form action="index.php?uc=genres&action=valideform" method="post" class=" col-md-6 offset-md-3 border border-primary p-3 round">
            <div class="form-group ">
           
                    <label for="libelle"><strong>Libellé</strong></label>
                    <input type='text' class='form-control mb-3' id='libelle' placeholder='Saisir le libellé' name='libelle' value="<?php if ($mode =='Modifier') {echo $genre->getLibelle() ;}?>">
                    
            </div>
            
            
               
            <input type='hidden' id='num' name='num' value="<?php if ($mode =='Modifier')  echo $genre->getNum() ;?>">   
            
            <div class="row">
                <div class="col"><a href="index.php?uc=genres&action=list" class="btn btn-warning btn-block">Revenir a la liste</a></div>
           
                <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode ?></button></div>
            </div>
        
        </form>
    </div>