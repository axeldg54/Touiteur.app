<?php

namespace iutnc\deefy\tag;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\db\ConnectionFactory;

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
            array_push($tab, new Tag($row[$i]["description"], $row[$i]["libelle"]));
            $i++;
        }
        return $tab;
    }
}