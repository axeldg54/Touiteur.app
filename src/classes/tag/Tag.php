<?php

namespace iutnc\deefy\tag;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\list\ListTag;

class Tag {
    private string $libelle;
    private string $description;

    public function __construct(string $d, string $l){
        $this->description = $d;
        $this->libelle = $l;
    }

    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }

    public static function recupererTags(int $idTouite) : array{
        $db = ConnectionFactory::makeConnection();
        $query = "select * from contient c inner join tag t on c.idtag = t.idtag where idTouite like ?";
        $st = $db->prepare($query);
        $st->execute([$idTouite]);
        $tab = array();
        $i = 0;

        while($row = $st->fetchAll()){
            while($i < count($row)){
                array_push($tab, new Tag($row[$i]["description"], $row[$i]["libelle"]));
                $i++;
            }
        }
        echo "<br>";
        //echo "<pre>";
        //var_dump($tab);
        return $tab;
    }

    public static function insertTag($idTouite) {
        // connexion bd
        $pdo = ConnectionFactory::makeConnection();

        $contenu = $_POST['contenu'];
        // trouver les # dans le touite et les ajouter dans la liste tags
        $tags = ListTag::recupererTagsDansTouite($contenu);

        // insertion dans la table tag et contient
        foreach ($tags as $key => $value) {
            // vérifie si le tag n'existe pas déjà
            $query = "select idTag from tag where libelle like  ?";
            $st = $pdo->prepare($query);
            $idTag = $st->execute([$value]);


            // si il existe pas alors il le créé
            if ($st->rowCount() < 1) {
                // incrementation de l'id du tag
                $query = "select max(idTag) as max from tag";
                $st = $pdo->prepare($query);
                $st->execute();
                $row = $st->fetch();
                $idTag = $row['max'] + 1;

                // insertion tag
                $query = "insert into tag(idTag,libelle,description) values(?,?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$idTag,substr($value, 1),"description du tag"]);
            }

            // insertion dans la table contient
            $query = "insert into contient(idTouite, idTag) values(?,?)";
            $st = $pdo->prepare($query);
            $st->execute([$idTouite, $idTag]);
        }
    }
}