<?php
class Livre {


    /**
     * Retourne l'ensemble des auteurs
     *
     * @return Livre[] tableau d'objet d'auteur
     */
    public static function findAll(?string $titre="",string $NomGenre="Tous",string $NomAuteur="Tous") : array 
    {
        $textReq="Select l.num as ISBN, l.titre as titre, l.prix as prix, l.editeur as 'editeur', l.annee as annee, l.langue as langue, l.numAuteur as numAuteur,l.numGenre as numGenre from livre l inner join auteur a 
                        on l.numAuteur=a.num";

                        if($titre != ""){
                            $textReq .= " and l.titre like '%" . $titre . "%'";
                        }
                        if($NomGenre !="Tous") {
                            $textReq .= " and l.numGenre =" . $NomGenre;
                        }
                        if($NomAuteur !="Tous") {
                            $textReq .= " and l.numAuteur =" . $NomAuteur;
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
     * @return Livre objet auteur trouvé
     */

    public static function findById(int $num) : Livre 
    {
        
        $req=MonPdo::getInstance()->prepare ("Select * from livre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Livre');
        $req->bindParam(':id',$num);
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
   /* public static function add(Auteur $auteur) :int 
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
    }*/

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


    public static function add(Livre $livre) :int 
    {
        $req=MonPdo::getInstance()->prepare ("Insert into livre(num,isbn,titre,prix,editeur,annee,langue,numAuteur,numGenre) values( :titre, :isbn, :prix
        :editeur, :annee, :langue, :numAuteur, :numGenre)");
                                        

        $num=$livre->getNum();
        $isbn=$livre->getISBN();
        $titre=$livre->getTitre();
        $prix=$livre->getPrix();
        $editeur=$livre->getEditeur();
        $annee=$livre->getAnnee();
        $langue=$livre->getLangue();
        $numAuteur=$livre->getNumAuteur();
        $numGenre=$livre->getNumGenre();
        $req->bindParam(':num',$num);
        $req->bindParam(':isbn',$isbn);
        $req->bindParam(':titre',$titre);
        $req->bindParam(':prix',$prix);
        $req->bindParam(':editeur',$editeur);
        $req->bindParam(':annee',$annee);
        $req->bindParam(':langue',$langue);       
        $req->bindParam(':numAuteur',$numAuteur);
        $req->bindParam(':numGenre',$numGenre);
        
        $nb=$req->execute();
        return $nb;
    }


    private $isbn;

    private $titre;

    private $prix;

    private $editeur;

    private $annee;

    private $langue;

    private $numAuteur;

    private $numGenre;

    private $num;


    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set the value of num
     *
     * @return  self
     */ 
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    

    /**
     * Get the value of num
     */ 
    public function getISBN()
    {
        return $this->isbn;
    }

    /**
     * Set the value of ISBN
     *
     * @return  self
     */ 
    public function setISBN($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of editeur
     */ 
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set the value of editeur
     *
     * @return  self
     */ 
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get the value of annee
     */ 
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */ 
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get the value of langue
     */ 
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set the value of langue
     *
     * @return  self
     */ 
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get the value of auteur
     */ 
    public function getNumAuteur()
    {
        return $this->numAuteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */ 
    public function setNumAuteur($numAuteur):self
    {
        $this->numAuteur = $numAuteur;

        return $this;
    }

    /**
     * Get the value of genre
     */ 
    public function getNumGenre()
    {
        return $this->numGenre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setNumGenre($numGenre)
    {
        $this->numGenre = $numGenre;

        return $this;
    }


    
}