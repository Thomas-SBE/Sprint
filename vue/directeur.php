<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page directeur</title>
    <link rel="stylesheet"  href="style/master.css" />
</head>
<body>

<p>Bienvenue <?php if(isset($username)){echo $username;} ?> ,</p>

<fieldset>
    <form action="index.php" id="gestionlogin" method="post">
        <p><label for="nouveaulogin">Nouveau nom utilisateur : </label><input type="text" name="nouveaulogin"></p>
        <p><label for="nouveaumdp">Nouveau mot de passe : </label><input type="text" name="nouveaumdp"></p>
        <p><label for="nouveaurole">Nouveau type de compte : </label> <select name="nouveaurole">
                <option value="D">Directeur</option>
                <option value="ADM">Agent Administratif</option>
                <option value="ACC">Agent Accueil</option>
            </select></p>
        <p><input type="submit" value="Créer login" name="creerlog"></p><br>
        <p><select name="supprimeragent"><?php echo $listeagentsuniv; ?></select></p>
        <p><input type="submit" value="Supprimer login" name="supplog"></p>
        <p><input type="submit" value="Modifier login" name="modiflog"></p>
    </form>
</fieldset>

<fieldset>
    <form action="index.php" id="gestionservice" method="post">
        <p><input type="submit" value="Créer service" name="creerser"></p>
        <p><input type="submit" value="Supprimer service" name="suppser"></p>
        <p><input type="submit" value="Modifier service" name="modifser"></p>
    </form>
</fieldset>

<fieldset>
    <legend>Liste des éléments à fournir par l'étudiant</legend>
    <form action="index.php" id="gestionelement" method="post">
        <p><input type="submit" value="Créer élément" name="creerelem"></p>
        <p><input type="submit" value="Supprimer élément" name="suppelem"></p>
        <p><input type="submit" value="Modifier élément" name="modifelem"></p>
    </form>
</fieldset>

<fieldset>
    <form action="index.php" id="afficherstats" method="post">
        <p><input type="submit" value="Afficher les statistiques" name="stats"></p>
    </form>
</fieldset>





</body>
</html>