<?php

namespace iutnc\deefy\action;
use iutnc\deefy\db\ConnectionFactory;

class   AddTouiteAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = '
            <form id="form" method="POST" action="index.php?action=add-touite" enctype="multipart/form-data">
                <label for="form"> Contenu : </label>
                <input type="text" id="contenu" name="contenu" required>
                <label for="file"> Image : </label>
                <input type="file" name="file" >
                <input type="submit" value="Ajouter">
                ';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_FILES['file'])){
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
            }
            move_uploaded_file($tmpName, './img/'.$name);

            $pdo = ConnectionFactory::makeConnection();
            $query = "select max(idImage) as max from Image";
            $st = $pdo-> prepare($query);
            $st -> execute();
            $row = $st->fetch();
            $id = $row['max'] + 1;

            $query = "insert into image(idImage,chemin,description) values($id,?, 'image')";
            $st = $pdo-> prepare($query);
            $st -> execute(['./img/'.$name]);

            $query = "select chemin from Image where chemin = ?";
            $st = $pdo-> prepare($query);
            $st -> execute(['./img/'.$name]);
            $row = $st->fetch();

            $contenu = $_POST['contenu'];
            $htmlContent = '<img src='.$row['chemin'].'>';

        }
        return $htmlContent;
    }
}