<?php

namespace iutnc\deefy\action;

use DateTime;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;

class AddTouiteAction extends Action
{

    public function execute(): string
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            // récupération des informations de l'image
            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
            }

            // ajout de l'image dans le dossier img
            move_uploaded_file($tmpName, './img/' . $name);

            // regarde si l'image n'existe pas déjà
            $query = "select idImage from Image where chemin = ?";
            $st = $pdo->prepare($query);
            $idImage = $st->execute(['./img/' . $name]);

            // si elle n'existe pas encore
            if ($st->rowCount() < 1) {
                // incrementation de l'id de l'image
                $query = "select max(idImage) as max from Image";
                $st = $pdo->prepare($query);
                $st->execute();
                $row = $st->fetch();
                $idImage = $row['max'] + 1;

                // insertion de l'image
                $query = "insert into image(idImage,chemin,description) values(?,?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$idImage,'./img/' . $name, 'image']);
            }

            // incrementation de l'id du tuite
            $query = "select max(idTouite) as max from touite";
            $st = $pdo->prepare($query);
            $st->execute();
            $row = $st->fetch();
            $idTouite = $row['max'] + 1;

            // insertion du touite
            $contenu = $_POST['contenu'];
            $query = "insert into touite(idTouite,texte,idImage) values(?,?,?)";
            $st = $pdo->prepare($query);
            $st->execute([$idTouite, $contenu, $idImage]);

            // insertion dans publier
            $idUser = $_SESSION['user']['id'];
            $query = "insert into publier(idTouite,idUser,date) values(?,?,?)";
            $st = $pdo->prepare($query);
            $st->execute([$idTouite,$idUser,(new DateTime())->format("Y-m-d")]);

            // trouver les # dans le touite et les ajouter dans la liste tags
            $lettre = "";
            $tag = "";
            $tags = array();
            for ($i = strlen($contenu); $i > 0 ; $i--) {
                if (isset($contenu[$i])) $lettre = $contenu[$i];
                $tag .= $lettre;
                if ($lettre === "#") {
                    array_push($tags, strrev($tag));
                }
                if ($lettre === " ") {
                    $tag = "";
                }
            }

            // insertion dans la table tag et contient
            foreach ($tags as $key => $value) {
                // vérifie si le tag n'existe pas déjà
                $query = "select idTag from tag where libelle = ?";
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
                    $st->execute([$idTag,$value,"description du tag"]);
                }

                // insertion dans la table contient
                $query = "insert into contient(idTouite, idTag) values(?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$idTouite, $idTag]);
            }

            $htmlContent = Initialisation::initialiser_Touites();
        }
        $lt = ListTouite::recupererListeTouites(3);
        Dispatcher::$tweets = $lt->displayListeTouites($lt);  
        return include 'modele/accueil.php';
    }
}