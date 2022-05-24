<?php
class Nationalite {

    /**
     * numéro du nationalité
     * 
     * @var int
     */

    private $num;


        /**
         * libelle du continent
         *
         * @var string
         */
    private $libelle;
    
    
    /**
     * num continent (clé étrangere) relié a num de Continent
     *
     * @var [int]
     */
    private $numContinent;

    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * lit le libelle
     *
     * @return string
     */
    public function getLibelle() : string
    {
        return $this->libelle;
    }

        /**
         * ecrit dans le libelle
         *
         * @param string $libelle
         * @return self
         */
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }

    

/**
 * renvoie l'objet continent associé
 *
 * @return Continent
 */
    public function getNumContinent() : Continent
    {
        return Continent::findById($this->numContinent);
    }

   /**
    * ecrit le num continent
    *
    * @param Continent $continent
    * @return self
    */
    public function setNumContinent(Continent $continent) : self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }

    /**
     * Retourne l'ensemble des Nationalite
     *
     * @return Nationalite[] tableau d'objet Nationalite
     */
    public static function findAll(?string $libelle="", ?string $continent="Tous") : array 
    {
        $textReq = "select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num";
        
        if($libelle != ""){

            $textReq .= " and n.libelle like '%" . $libelle . "%'";
        }
        if($continent !="Tous") {
            $textReq .= " and c.num =" . $continent;
        }

        $textReq.= " order by n.libelle";        
        $req=MonPdo::getInstance()->prepare ($textReq);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        
        return $lesResultats;
    }



    /**
     * Trouve une nationalite par son num
     *
     * @param integer $id numéro du Nationalite
     * @return Nationalite objet Nationalite trouvé
     */

    public static function findById(int $id) : Nationalite 
    {
        
        $req=MonPdo::getInstance()->prepare ("Select * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Nationalite');
        $req->bindParam(':id',$id);
        var_dump($id);
        $req->execute();
        $lesResultats=$req->fetch();
        return $lesResultats;
    }



/**
 * Permet d'ajouter une Nationalite
 *
 * @param Continent $Nationalite Nationalite a ajouter
 * @return integer resultat (1 si l'opération a réussi, 0 sinon)
 */
    public static function add(Nationalite $nationalite) :int 
    {
        //var_dump($nationalite);
        $libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getnumContinent()->getNum();
        $req=MonPdo::getInstance()->prepare ("Insert into nationalite(libelle,numContinent) values(:libelle, :numContinent)");
        $req->bindParam(':libelle',$libelle);
        $req->bindParam(':numContinent',$numContinent);
        $nb=$req->execute();
        return $nb;
    }

/**
 * Permet de modifier une Nationalite
 *
 * @param Continent $Nationalite Nationalite a modifier
 * @return integer resultat (1 si l'opération a réussi, 0 sinon)
 */
    public static function update(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare ("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
        $id=$nationalite->getNum();
        $libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getnumContinent()->getNum();
        $req->bindParam(':id',$id);
        $req->bindParam(':libelle',$libelle);
        $req->bindParam(':numContinent',$numContinent);
        $nb=$req->execute();
        return $nb;
    }


/**
 * Permet de suppr un Nationalite
 *
 * @param Nationalite $nationalite
 * @return integer
 */
    public static function delete(Nationalite $nationalite) :int
    {
        $id=$nationalite->getNum();
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $req->bindParam(':id',$id);
        $nb=$req->execute();
        return $nb;
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
}