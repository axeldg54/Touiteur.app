<?php

namespace iutnc\deefy\list;

use iutnc\deefy\user\User;

class ListUser{

    protected array $tabUsers;

    public function __construct(){
        $this->tabUsers = array();
    }

    public function ajouterUser(User $user): void{
        $this->tabUsers[] = $user;
    }

    public function supprimerUser(User $user): void{
        foreach ($this->tabUsers as $key => $valeur){
            if($valeur == $user){
                unset($this->tabUsers[$key]);
                //array_slice($this->tabUsers,$key,1);
            }
        }
    }

}