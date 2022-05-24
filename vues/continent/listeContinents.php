<div class="container">
    <div class="row pt-5">
                <div class="col-9"><h2>Liste des continents</h2></div>
                <div class="col-3"><a href="index.php?uc=continents&action=add" class="btn btn-success"><i class="fas fa-plus-circle"></i>Ajouter un continent</a></div>
    </div>

    <table class="table table-striped table-hover">
                <thead>
                    <tr class="d-flex">
                        <th scope="col" class="col-md-2">Numéro</th>
                        <th scope="col" class="col-md-8">Libellé</th>
                        <th scope="col" class="col-md-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($lesContinents as $continent){

                    echo '<tr class="d-flex">';
                        echo "<td class='col-md-2'>".$continent->getNum()."</td>";
                        echo "<td class='col-md-8'>".$continent->getLibelle()."</td>";
                        echo "<td class='col-md-2'>
                                <a href='index.php?uc=continents&action=update&num=".$continent->getNum()."' class='btn btn-primary'><i class='fas fa-pen'></i></a>

                                <a href='#modalsuppr' data-suppr='index.php?uc=continents&action=delete&num=".$continent->getNum()."' data-toggle='modal' data-message ='Voulez vous supprimer ce continent ?' class='btn btn-danger'><i class='fas far fa-trash-alt'></i</a>
                            </td>";
                    echo "</tr>";
                    //'supprNationalite.php?num=$nationalite->num'
                }?>
                </tbody>
            </table>
        </div>
    </div>

        