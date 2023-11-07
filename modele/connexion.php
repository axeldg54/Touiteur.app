<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .social-buttons {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1rem;
        }
        .social-button {
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .input-group {
            margin-bottom: 1rem;
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

        h1 {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: whitesmoke;
            font-size: 60px;
            font-family: ;
        }

        .login-box {
            position: relative;
            top: -50px;
            margin: auto;
        }


    </style>
</head>
<body>

<h1>Touiteur.app</h1>

<form id="form" method="POST" action="index.php?action=sign-in" class="login-container">
    <h2>Connectez-vous</h2>
    <div class="input-group">
        <label for="form"> email : </label>
        <input type="email" id="email" name="email" value="axeldung2004@gmail.com" required>
    </div>
    <div class="input-group">
        <label for="password"> mot de passe : </label>
        <input type="text" id="password" name="password" value="Axeldung2004&**" required>
        <small><a href="#">Mot de passe oublié ?</a></small>
    </div>
    <input type="submit" value="Connexion" class="login-button">
    <div class="footer">
        <small>Vous n'êtes pas membre ? <a href="?action=register">Inscrivez-vous maintenant</a></small>
    </div>
</form>

</body>
</html>