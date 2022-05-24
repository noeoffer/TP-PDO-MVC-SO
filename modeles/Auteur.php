<?php
class Auteur {

    /**
     * numéro de l'auteur
     * 
     * @var int
     */

    private $num;


        /**
         * nom de l'auteur
         *
         * @var string
         */
    private $nom;

    private $prenom;

    private $numNationalite;


    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set the value of num
     *
     * @return  self
     */ 
    public function setNum($num):self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * lit le libelle
     *
     * @return string
     */
    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * Set nom de l'auteur
     *
     * @param  string  $nom  nom de l'auteur
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom() : string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
 * renvoie l'objet Nationalite associé
 *
 * @return Nationalite
 */

    public function getNumNationalite() : Nationalite
    {
        return Nationalite::findById($this->numNationalite);
    }

    /**
     * Set the value of numNationalite
     *
     * @return  self
     */ 

    public function setNumNationalite(Nationalite $nationalite) : self
    {
        $this->numNationalite = $nationalite->getNum();

        return $this;
    }


    /**
     * Retourne l'ensemble des auteurs
     *
     * @return Auteur[] tableau d'objet d'auteur
     */
    public static function findAll(?string $nom="",?string $prenom="",?string $nationalite="Tous") : array 
    {
        $textReq="Select a.num as numero, a.nom as nom, a.prenom as prenom, n.libelle as 'libNation' from auteur a inner join nationalite n 
                        on a.numNationalite=n.num";

                        if($nom != ""){
                            $textReq .= " and a.nom like '%" . $nom . "%'";
                        }
                        
                        if($prenom != ""){
                            $textReq .= " and a.prenom like '%" . $prenom . "%'";
                        }

                        if($nationalite !="Tous") {
                            $textReq .= " and n.num =" . $nationalite;
                        }
                     
                        $req=MonPdo::getInstance()->prepare ($textReq);
                        $req->setFetchMode(PDO::FETCH_OBJ);
                        $req->execute();
                        $lesResultats=$req->fetchAll();
                        return $lesResultats;
    }



    /**
     * Trouve un auteur par son num
     *
     * @param integer $id numéro du auteur
     * @return Auteur objet auteur trouvé
     */

    public static function findById(int $id) : Auteur 
    {
        var_dump($id);
        $req=MonPdo::getInstance()->prepare ("Select * from auteur where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Auteur');
        $req->bindParam(':id',$id);
        $req->execute();
        $leResultats=$req->fetch();
        return $leResultats;
    }

/**
 * Permet d'ajouter un auteur
 *
 * @param Auteur $auteur auteur a ajouter
 * @return integer resultat (1 si l'opération a réussi, 0 sinon)
 */
    public static function add(Auteur $auteur) :int 
    {
        $req=MonPdo::getInstance()->prepare ("Insert into auteur(nom,prenom,numNationalite) values( :nom, :prenom, :numNationalite)");
                                        

        $nom=$auteur->getNom();
        $prenom=$auteur->getPrenom();
        $numNationalite=$auteur->getNumNationalite()->getNum();
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);
        $req->bindParam(':numNationalite',$numNationalite);
        $nb=$req->execute();
        return $nb;
    }

/**
 * Permet de modifier un auteur
 *
 * @param Auteur $auteur auteur a modifier
 * @return integer resultat (1 si l'opération a réussi, 0 sinon)
 */
    public static function update(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare ("update auteur set nom= :nom,prenom= :prenom, numNationalite= :numNationalite where num= :id");


        $id=$auteur->getNum();
        $nom=$auteur->getNom();
        $prenom=$auteur->getPrenom();
        $numNationalite=$auteur->getNumNationalite()->getNum();


        $req->bindParam(':id',$id);
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);
        $req->bindParam(':numNationalite',$numNationalite);

        $nb=$req->execute();
        return $nb;
    }


/**
 * Permet de suppr un auteur
 *
 * @param Auteur $auteur
 * @return integer
 */
    public static function delete(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare ("delete from auteur where num= :id");
        $num=$auteur->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }

}