<?php

namespace iutnc\deefy\tag;

use iutnc\deefy\exception\InvalidPropertyNameException;

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
}