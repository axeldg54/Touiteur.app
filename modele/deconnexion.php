<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Touiteur.app</h1>
    <div class="confirmation-box">
        <form id="form" method="POST" action="index.php?action=accueil" class="login-container">
            <h2>Voulez-vous vraiment vous déconnecter ?</h2>
            <input type="submit" value="Oui" class="login-button">
        </form>
    </div>
</div>

</body>
</html>

<style>
    body {
        font-family: 'Open Sans', Arial, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        text-align: center;
        width: 100%;
    }

    h1 {
        color: whitesmoke;
        font-size: 4rem;
        margin-bottom: 2rem;
    }

    .confirmation-box {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin: auto;
    }

    .confirmation-box h2 {
        color: #333;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .confirmation-button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 4px;
        background: #6D55A3;
        color: white;
        cursor: pointer;
        font-weight: 600;
    }

</style>