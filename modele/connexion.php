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
            <input type="email" id="email" name="email" value="user1@mail.com" required>
        </div>
        <div class="input-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" value="User1User1*" required>
            <small><a href="#">Mot de passe oublié ?</a></small>
        </div>
        <input type="submit" value="Connexion" class="login-button">
        <div class="footer">
            <small>Vous n'êtes pas membre ? <a href="?action=register">Inscrivez-vous maintenant</a></small>
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
        top: 5%;
        left: 50%;
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