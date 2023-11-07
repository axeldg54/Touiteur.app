<?php

namespace iutnc\deefy\image;

use iutnc\deefy\exception\InvalidPropertyNameException;

class Image
{
    private string $description;
    private string $chemin;

    public function __construct(string $d, string $c){
        $this->description = $d;
        $this->chemin = $c;
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