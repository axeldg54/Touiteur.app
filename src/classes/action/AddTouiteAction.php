<?php

namespace iutnc\deefy\action;

use DateTime;
use iutnc\deefy\db\ConnectionFactory;

class AddTouiteAction extends Action
{

    public function execute(): string
    {
        $htmlContent = include 'modele/accueil.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            if (isset($_FILES['file'])) {
                // récupération des informations de l'image
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
            }

            // ajout de l'image dans le dossier img
            move_uploaded_file($tmpName, './img/' . $name);

            // regarde si l'image n'existe pas déjà
            //$query = "select idImage from Image where chemin = '$name'";
            //$st = $pdo->prepare($query);
            //$st->execute();
            //$row = $st->fetch();
            //$idImage = $row['idImage'];

            // si elle existe déjà alors
            //if ($idImage > -1) {
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
            //}

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
            echo $idUser;
            $query = "insert into publier(idTouite,idUser,date) values(?,?,?)";
            $st = $pdo->prepare($query);
            $st->execute([$idTouite,$idUser,new DateTime("Y-m-d\\TH:i:sP")]);
        }
        return $htmlContent;
    }
}