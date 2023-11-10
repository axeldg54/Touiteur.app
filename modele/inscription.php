<?php
$refus = \iutnc\deefy\dispatch\Dispatcher::$refus;

echo <<<FIN
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Touiteur.app</h1>

<div class="login-box">
    <form id="form" method="POST" action="index.php?action=register" enctype="multipart/form-data" class="login-container">
        <h2>Inscription</h2>
        <div class="input-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="input-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="input-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Inscription" class="login-button">
        <div class="footer">
            <small>Déjà membre ? <a href="?action=sign-in">Connectez-vous</a></small>
        </div>
            <p class="msgRefus">$refus</p>
    </form>
</div>

</body>
</html>


<style>
   body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h1 {
    color: #ffffff;
    font-size: 3rem;
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    text-align: center;
    margin: 0;
    padding: 1rem 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
.login-box {
    position: relative;
    margin: auto;
}

.login-container {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

.login-container h2 {
    margin-bottom: 1rem;
}

.input-group {
    margin-bottom: 1rem;
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
    background: #333;
    color: white;
    cursor: pointer;
    margin-top: 20px;
}

.footer {
    text-align: center;
    margin-top: 1rem;
}

.footer a {
    text-decoration: none;
    color: #000;
}

.msgRefus {
    color: red;
    margin-top: 1rem;
}

</style>
FIN;