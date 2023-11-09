<?php

namespace iutnc\deefy\likes;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\db\ConnectionFactory;

class Likes{

    private int $nbLikes;

    public function __construct(int $nb){
        $this->nbLikes = $nb;
    }

    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }

    public static function insertLikes($idTouite) {
        // connexion bd
        $pdo = ConnectionFactory::makeConnection();

        // Insertion dans la table likes
        $query = "insert into likes(idUser,idTouite,nbLike) values(?,?,?)";
        $st = $pdo->prepare($query);
        $st->execute([$_SESSION['user']['id'],$idTouite,0]);    
    }
}