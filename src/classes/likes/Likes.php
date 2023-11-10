<?php

namespace iutnc\deefy\likes;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\db\ConnectionFactory;

/**
 * Classe représentant les likes d'un touite
 */
class Likes{

    /**
     * Déclarations des attributs
     */
    private int $nbLikes;

    /**
     * Constructeur de la classe likes
     * @param int nombre de like
     */
    public function __construct(int $nb){
        $this->nbLikes = $nb;
    }


    /**
     * Getter de la classe Likes
     * @param string nom de l'attribut
     * @return mixed valeur correspond au nom de l'attribut
     * @throws InvalidPropertyNameException si le nom de l'attribut n'existe pas
     */
    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }


    /**
     * Insert un Likes dans la base de donnée
     * @param int id du Touite
     */
    public static function insertLikes(int $idTouite) {
        // connexion bd
        $pdo = ConnectionFactory::makeConnection();

        // Insertion dans la table likes
        $query = "insert into likes(idUser,idTouite,nbLike) values(?,?,?)";
        $st = $pdo->prepare($query);
        $st->execute([$_SESSION['user']['id'],$idTouite,0]);    
    }
}