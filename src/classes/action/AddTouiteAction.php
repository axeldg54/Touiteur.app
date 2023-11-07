<?php

namespace iutnc\deefy\action;
use iutnc\deefy\db\ConnectionFactory;

class AddTouiteAction extends Action {

    public function execute(): string {
        $htmlContent = include 'modele/accueil.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_FILES['file'])){
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
            }
            move_uploaded_file($tmpName, './img/'.$name);

            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            // incrementation de l'id de l'image
            $query = "select max(idImage) as max from Image";
            $st = $pdo-> prepare($query);
            $st -> execute();
            $row = $st->fetch();
            $idImage = $row['max'] + 1;

            // insertion de l'image
            $query = "insert into image(idImage,chemin,description) values($idImage,?, 'image')";
            $st = $pdo-> prepare($query);
            $st -> execute(['./img/'.$name]);

            /**
            $query = "select chemin from Image where chemin = ?";
            $st = $pdo-> prepare($query);
            $st -> execute(['./img/'.$name]);
            $row = $st->fetch();
            */

            // incrementation de l'id du tuite
            $query = "select max(idTouite) as max from touite";
            $st = $pdo-> prepare($query);
            $st -> execute();
            $row = $st->fetch();
            $idTouite = $row['max'] + 1;

            // insertion du touite
            $contenu = $_POST['contenu'];
            $query = "insert into touite(idTouite,texte,idImage) values($idTouite,?,$idImage)";
            $st = $pdo-> prepare($query);
            $st -> execute([$contenu]);
        }
        return $htmlContent;
    }
}