<?php

namespace iutnc\deefy\action;
use iutnc\deefy\exception\AuthException;
use iutnc\deefy\inscription\inscr;

class AddUserAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = '
            <form id="form" method="POST" action="index.php?action=register" enctype="multipart/form-data">
                <label for="form"> Nom :</label>
                <input type="text" id="nom" name="nom" required>
                <label for="form"> Prenom :</label>
                <input type="text" id="prenom" name="prenom" required>
                <label for="form"> Email : </label>
                <input type="email" id="email" name="email"  required>
                <label for="password"> Mot de passe : </label>
                <input type="text" id="password" name="password" required>
                <input type="submit" value="Inscription">
                </form>
                ';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
            $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password']);

            try {
                if (inscr::register($nom,$prenom,$email, $password, 0)) $htmlContent = "Vous avez créé votre compte en tant que " . $email;
                else $htmlContent = "Problème mot de passe pas assez sécurisé";
            } catch (AuthException $e) {
                echo $e;
            }
        }
        return $htmlContent;
    }
}
