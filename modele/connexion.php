<?php
$refus = \iutnc\deefy\dispatch\Dispatcher::$refus;
echo <<<FIN
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<h1>Touiteur.app</h1>

<div class="login-box">
    <form id="form" method="POST" action="index.php?action=sign-in" class="login-container">
        <h2>Connectez-vous</h2>
        <div class="input-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <small><a href="#">Mot de passe oublié ?</a></small>
        </div>
        <input type="submit" value="Connexion" class="login-button">
        <div class="footer">
            <small>Vous n'êtes pas membre ? <a href="?action=register">Inscrivez-vous maintenant</a></small>
        </div>
        <p class="msgRefus">$refus</p>
    </form>
</div>

</body>
</html>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
    background: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 350px;
    text-align: center;
}


.login-container {
    display: flex;
    flex-direction: column;
}

.input-group {
    margin-bottom: 1rem;
}

.input-group label {
    display: block;
    text-align: left;
    margin-bottom: 0.5rem;
    color: #333;
}
.input-group input {
    width: 100%;
    padding: .75rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}

.login-button {
    padding: .75rem;
    border: none;
    border-radius: 4px;
    background: #5D3FD3;
    color: white;
    cursor: pointer;
    margin-top: 1rem; 
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.login-button:hover {
    background-color: #4a31c3;
}

.footer {
    margin-top: 1.5rem;
}

.footer a {
    text-decoration: none;
    color: #5D3FD3;
    font-weight: bold;
}

.footer a:hover {
    text-decoration: underline;
}

.msgRefus {
    color: red;
    margin-top: .75rem;
}

</style>
FIN;