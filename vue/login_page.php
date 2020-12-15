<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page connection à l'Université</title>
    <meta charset="utf-8">
    <link rel="stylesheet"  href="style/master.css" />
</head>

<body>
<form id="login" action="index.php" method="post" autocomplete="off">
    <p><label>Nom d'utilisateur : </label><input type="text" name="nomutilisateur" /> </p>
    <p><label>Mot de passe : </label><input type="password" name="mdp" /> </p>
    <p><input type="submit" value="Se connecter" name="connecter"/></p>
</form>

<?php if (isset($message_err)){ echo $message_err; } ?>




</body>
</html>