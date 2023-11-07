<?php

namespace iutnc\deefy\action;
use iutnc\deefy\auth\Inscr;
use iutnc\deefy\exception\AuthException;
class AddUserAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = '
            <form id="form" method="POST" action="index.php?action=register">
                <label for="form"> email : </label>
                <input type="email" id="email" name="email" value="axel@mail.com" required>
                <label for="password"> mot de passe : </label>
                <input type="text" id="password" name="password" value="Axel2004**&" required>
                <input type="submit" value="Inscription">
                ';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password']);
            try {
                if (inscr::register($email, $password)) $htmlContent = 'L\'ajout du user ' . $email . ' a bien été effectué';
            } catch (AuthException $e) {
                echo $e;
            }
        }
        return $htmlContent;
    }
}
