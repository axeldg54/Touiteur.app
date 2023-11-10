<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Bientot sur Touiteur.app</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>A bientot sur Touiteur.app</h1>

<div class="welcome-box">
    <p>Vous vous êtes déconnecté avec succès. Vous pouvez quand même accéder à Touiteur</p>
    <p><a href="?action=accueil">Accueil</a></p>
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