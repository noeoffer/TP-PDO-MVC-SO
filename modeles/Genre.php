<?php
class Genre {

    /**
     * numéro du continent
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
     * Retourne l'ensemble des continents
     *
     * @return Continent[] tableau d'objet continent
     */
    public static function findAll() : array 
    {
        $req=MonPdo::getInstance()->prepare ("Select num,libelle from Genre");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Genre');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }



    /**
     * Trouve un continent par son num
     *
     * @param integer $id numéro du continent
     * @return Continent objet continent trouvé
     */

    public static function findById(int $libelle) : Genre 
    {
        var_dump($libelle);
        $req=MonPdo::getInstance()->prepare ("Select * from genre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Genre');
        $req->bindParam(':id',$libelle);
        $req->execute();
        $leResultats=$req->fetch();
        return $leResultats;
    }



/**
 * Permet d'ajouter un continent
 *
 * @param Continent $continent continent a ajouter
 * @return integer resultat (1 si l'opération a réussi, 0 sinon)
 */
    public static function add(Genre $genre) :int 
    {
        $req=MonPdo::getInstance()->prepare ("Insert into genre(libelle) values(:libelle)");
        $libelle=$genre->getLibelle();
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

/**
 * Permet de modifier un continent
 *
 * @param Continent $continent continent a modifier
 * @return integer resultat (1 si l'opération a réussi, 0 sinon)
 */
    public static function update(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare ("update genre set libelle= :libelle where num= :id");
        $num=$genre->getNum();
        $libelle=$genre->getLibelle();
        $req->bindParam(':id',$num);
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }


/**
 * Permet de suppr un continent
 *
 * @param Continent $continent
 * @return integer
 */
    public static function delete(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare ("delete from genre where num= :id");
        $num=$genre->getNum();
        $req->bindParam(':id',$num);
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