<?php

namespace iutnc\deefy\inscription;

use iutnc\deefy\db\ConnectionFactory;

class inscr
{
    public static function authenticate(string $email, string $passwd2check): bool{
        $pdo = ConnectionFactory::makeConnection();
        $query = "select prenom, nom, password from Utilisateur where email = ?";
        $st = $pdo-> prepare($query);
        $st -> execute([$email]);
        $row = $st->fetch();
        $hash = $row['password'];
        $_SESSION['user'] = ['prenom'=>$row['prenom'], 'nom'=>$row['nom']];
        return (password_verify($passwd2check, $hash));
    }

    public static function register(string $nom, string $prenom, string $email, string $pass, int $idimage): bool {
        $pdo = ConnectionFactory::makeConnection();
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost'=> 12]);
        $mdp = (inscr::checkPasswordStrength($pass, 10));

        // incrémentation
        $query = "select max(idUser) as max from Utilisateur";
        $st = $pdo-> prepare($query);
        $st -> execute();
        $row = $st->fetch();
        $id = $row['max'] + 1;

        $query = "select count(*) as compteur from Utilisateur where email = ?";
        $st = $pdo-> prepare($query);
        $st -> execute([$email]);
        $row = $st->fetch();
        if($row['compteur'] > 0) $mdp = false;

        if($mdp) {
            $query = "insert into utilisateur(idUser ,nom, prenom, email, password, idimage) values('$id', '$nom','$prenom','$email','$hash','$idimage')";
            $pdo->exec($query);
        }

        return $mdp;
    }

    private static function checkPasswordStrength(string $pass, int $minimumLength): bool {
        $length = (strlen($pass) > $minimumLength); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $special = preg_match("#[\W]#", $pass); // au moins un car. spécial
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if (!$length || !$digit || !$special || !$lower || !$upper) return false;
        else return true;
    }

}