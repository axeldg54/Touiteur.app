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
            <input type="text" id="nom" name="nom" value="User" required>
        </div>
        <div class="input-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="One" required>
        </div>
        <div class="input-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="user1@mail.com" required>
        </div>
        <div class="input-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" value="User1User1*" required>
        </div>
        <input type="submit" value="Inscription" class="login-button">
        <div class="footer">
            <small>Déjà membre ? <a href="?action=sign-in">Connectez-vous</a></small>
        </div>

    </form>
</div>

</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #8458B3 0%, #E98181 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    h1 {
        position: absolute;
        top: 35%;
        left: 15%;
        transform: translate(-50%, -50%);
        color: whitesmoke;
        font-size: 60px;
    }

    .login-box {
        position: relative;
        top: -50px;
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
</style>