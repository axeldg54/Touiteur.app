<?php

namespace iutnc\deefy\action;
use iutnc\deefy\list\ListTouite;

class AddTouiteAction extends Action {

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
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
            }
            $contenu = $_POST['contenu'];
            ;
            $htmlContent = '<img src="$tmpName" />
';
        }
        return $htmlContent;
    }
}
