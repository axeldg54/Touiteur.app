<?php
echo <<< FIN
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur Touiteur.app</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Bienvenue sur Touiteur.app</h1>
            <div class="user-info">
                <p>Nom : {$_SESSION['user']['nom']}</p>
                <p>Prénom : {$_SESSION['user']['prenom']}</p>
                <p>ID : {$_SESSION['user']['id']}</p>
            </div>
            <div class="actions">
                <a href="?action=accueil">Accueil</a>
                <a href="?action=sign-in">Connexion</a>
                <a href="?action=register">Inscription</a>
                <a href="?action=deconnexion">Se déconnecter</a>
            </div>
        </div>
    </div>
</body>
</html>

<style>
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #8458B3 0%, #E98181 100%);
    color: #ffffff;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

.content {
    padding: 20px;
}

h1 {
    color: #353b48;
    font-size: 24px;
    margin-bottom: 20px;
}

.user-info p {
    color: #353b48;
    font-size: 16px;
    margin: 10px 0;
}

.actions a {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background: #353b48;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

    .input-group label {
        display: block;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .login-button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background: black;
        color: white;
        cursor: pointer;
    }

    .footer {
        text-align: center;
        margin-top: 1rem;
    }

    .footer a {
        text-decoration: none;
        color: #000;
    }
    
    .actions a:hover {
        background: #222831;
    }
</style>
FIN;
