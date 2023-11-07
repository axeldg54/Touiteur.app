<?php

namespace iutnc\deefy\action;
use iutnc\deefy\auth\Auth;

class SignInAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = '
            <form id="form" method="POST" action="index.php?action=sign-in">
                <label for="form"> email : </label>
                <input type="email" id="email" name="email" value="user2@mail.com" required>
                <label for="password"> mot de passe : </label>
                <input type="password" id="password" name="password" value="user2" required>
                <input type="submit" value="Connexion">
                ';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password']);
            if (Auth::authenticate($email, $password)) $htmlContent = 'OK, mot de passe correct et email correct';
            else $htmlContent = 'FAUX, mot de passe incorrect';
        }
        return $htmlContent;
    }
}
