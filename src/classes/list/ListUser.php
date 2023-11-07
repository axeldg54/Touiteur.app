<?php

namespace iutnc\deefy\list;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\user\User;

class ListUser{

    protected array $tabUsers;

    public function __construct(){
        $this->tabUsers = array();
    }

    /**
     * @throws InvalidPropertyNameException
     */
    public function ajouterUser(User $user): void{
        $existe = true;
        foreach ($this->tabUsers as $key => $valeur){
            if($valeur->__get("pseudo") === $user->__get("pseudo") || $valeur->__get("email") === $user->__get("email")){
                echo "Pseudo ou email déjà utilisé";
                $existe = false;
            }
            if ($existe){
                $this->tabUsers[] = $user;
            }
        }
    }

    public function supprimerUser(User $user): void{
        foreach ($this->tabUsers as $key => $valeur){
            if($valeur == $user){
                unset($this->tabUsers[$key]);
            }
        }
    }

}