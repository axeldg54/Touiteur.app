<?php

namespace iutnc\deefy\inscription;

use iutnc\deefy\db\ConnectionFactory;

class inscr
{
    public static function authenticate(string $email, string $passxd2check): bool{
        $pdo = ConnectionFactory::makeConnection();
        $query = "select passwd from Utilisateur where email = ?";
        $st = $pdo-> prepare($query);
        $st -> execute([$email]);
        $row = $st->fetch();//une seule ligne
        $hash = $row['passwd'];
        return password_verify($passxd2check,$hash);
    }

    public static function register(string $nom, string $prenom, string $email, string $pass, int $idimage): bool {
        $pdo = ConnectionFactory::makeConnection();

        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost'=> 12]);

        inscr::checkPasswordStrength($pass, 10);

        $query = "select count(*) as compteur from Utilisateur where email = ?";
        $st = $pdo-> prepare($query);
        $st -> execute([$email]);
        $row = $st->fetch();
        if($row['compteur'] > 0) $mdp = false;
        else $mdp = true;

        if($mdp) {
            $query = "insert into utilisateur(nom, prenom, email, password, idimage) values('$nom','$prenom','$email','$hash','$idimage')";
            $pdo->exec($query);
        }

        return $mdp;
    }

    public static function checkPasswordStrength(string $pass, int $minimumLength): bool {
        $length = (strlen($pass) < $minimumLength); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $special = preg_match("#[\W]#", $pass); // au moins un car. spécial
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if (!$length || !$digit || !$special || !$lower || !$upper)return false;
        return true;
    }

}