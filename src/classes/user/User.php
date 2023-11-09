<?php

declare(strict_types=1);

namespace iutnc\deefy\user;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\InvalidPropertyNameException;
use PDO;
use Stringable;

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

    public static function getAbonnement() : string {
        $html = '';
        $pdo = ConnectionFactory::makeConnection();

        // récupération des ids qui suivent le user
        $query = "SELECT idUser2 FROM suivre WHERE idUser = ?";
        $st = $pdo->prepare($query);
        $st->execute([$_SESSION['user']['id']]);

        // Récupère toutes les lignes résultantes
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $idAbo = $row['idUser2'];

            // récupération nom et prénom de l'id
            $query = "SELECT nom, prenom FROM utilisateur WHERE idUser = ?";
            $st2 = $pdo->prepare($query); // Nouvelle instance de $st2
            $st2->execute([$idAbo]);

            while ($row2 = $st2->fetch()) {
                $nom = $row2['nom'];
                $prenom = $row2['prenom'];

                // Affiche le nom et le prénom
                $html .= '<p>'.$nom.' '.$prenom.'</p><br>';
            }
        }

        return $html;
    }

    public static function getAbonne() : string {
        $html = '';
        $pdo = ConnectionFactory::makeConnection();

        // Récupération des ids des utilisateurs qui suivent l'utilisateur actuel
        $query = "SELECT idUser FROM suivre WHERE idUser2 = ?";
        $st = $pdo->prepare($query);
        $st->execute([$_SESSION['user']['id']]);

        // Récupère toutes les lignes résultantes
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $idAbo = $row['idUser'];

            // Récupération du nom et du prénom de l'id
            $query = "SELECT nom, prenom FROM utilisateur WHERE idUser = ?";
            $st2 = $pdo->prepare($query); // Nouvelle instance de $st2
            $st2->execute([$idAbo]);

            while ($row2 = $st2->fetch()) {
                $nom = $row2['nom'];
                $prenom = $row2['prenom'];

                // Ajoute le nom et le prénom à la chaîne HTML
                $html .= '<p>'.$nom.' '.$prenom.'</p><br>';
            }
        }

        return $html;
    }

    public static function getTag() : string {
        $html = '';
        $pdo = ConnectionFactory::makeConnection();

        // Récupération des ids des utilisateurs qui suivent l'utilisateur actuel
        $query = "SELECT idTag FROM abonnement WHERE idUser = ?";
        $st = $pdo->prepare($query);
        $st->execute([$_SESSION['user']['id']]);

        // Récupère toutes les lignes résultantes
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $idTag = $row['idTag'];

            // Récupération du nom et du prénom de l'id
            $query = "SELECT libelle, description FROM tag WHERE idTag = ?";
            $st2 = $pdo->prepare($query); // Nouvelle instance de $st2
            $st2->execute([$idTag]);

            while ($row2 = $st2->fetch()) {
                $libelle = $row2['libelle'];
                $desc = $row2['description'];

                // Ajoute le nom et le prénom à la chaîne HTML
                $html .= '<p>'.$libelle.' - '.$desc.'</p><br>';
            }
        }

        return $html;
    }

}