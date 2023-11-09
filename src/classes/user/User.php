<?php

declare(strict_types=1);

namespace iutnc\deefy\user;

use iutnc\deefy\exception\InvalidPropertyNameException;

class User{

    private string $nom;
    private string $prenom;
    private string $email;

    /**

    Constructeur de la classe User
    @param $nom nom utilisateur
    @param $prenom prenom utilisateur
    @param $email email utilisateur
     */
    public function __construct(string $nom, string $prenom, string $email){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
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