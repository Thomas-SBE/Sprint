<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page directeur</title>
    <link rel="stylesheet"  href="style/master.css" />
</head>
<body>

<p>Bienvenue <?php if(isset($username)){echo $username;} ?>,</p>

<fieldset>
    <legend>Nouvel Utilisateur</legend>
    <form action="index.php" id="gestionlogin" method="post">
        <p><label for="nouveauprenom">Prénom : </label><input type="text" name="nouveauprenom" required></p>
        <p><label for="nouveaunom">Nom : </label><input type="text" name="nouveaunom" required></p>
        <p><label for="nouveaulogin">Login : </label><input type="text" name="nouveaulogin" required></p>
        <p><label for="nouveaumdp">Mot de passe : </label><input type="text" name="nouveaumdp" required></p>
        <p><label for="nouveaurole">Type de compte : </label> <select name="nouveaurole">
                <option value="D">Directeur</option>
                <option value="ADM">Agent Administratif</option>
                <option value="ACC">Agent Accueil</option>
            </select></p>
        <p><input type="submit" value="Créer login" name="creerlog"></p><br>
    </form>
</fieldset>
<fieldset>
    <legend>Gestion des utilisateurs</legend>
    <form action="index.php" id="gestionlogin" method="post">
        <p><select name="agent"><?php echo $listeagentsuniv; ?></select></p>
        <p><input type="submit" value="Supprimer login" name="supplog"></p>
        <p><input type="submit" value="Modifier login" name="modiflog"></p>
    </form>
</fieldset>
<br>
<fieldset>
    <legend>Nouveau service</legend>
    <form action="index.php" id="gestionservice" method="post">
        <p><label for="nouveauservice">Nouveau service : </label><input type="text" name="nouveauservice" required></p>
        <p>Choisissez la liste des justificatifs à fournir par l'étudiant : </p>
        <?php echo $listejustif; ?>

        <p><label for="prixservice">Le prix du service : </label><input type="number" name="prixservice" required value="0"></p>
        <p><input type="submit" value="Créer service" name="creerser"></p><br>
    </form>
</fieldset>
<fieldset>
    <legend>Gestion des services</legend>
    <form action="index.php" id="gestionservice" method="post">
        <p><select name="services"><?php echo $listeser; ?></select></p>
        <p><input type="submit" value="Supprimer service" name="suppser"></p>
        <p><input type="submit" value="Modifier service" name="modifser"></p>
    </form>
</fieldset>
<br>
<fieldset>
    <legend>Nouveau justificatif à fournir par l'étudiant</legend>
    <form action="index.php" id="gestionjus" method="post">
        <p><label for="nouveaujus">Nouveau justificatif : </label><input type="text" name="insererjus" required></p>
        <p><input type="submit" value="Créer justificatif" name="creerjus"></p>
    </form>
</fieldset>
<fieldset>
    <legend>Liste des justificatifs à fournir par l'étudiant</legend>
    <form action="index.php" id="gestionjus" method="post">
        <p><select name="justificatif"><?php echo $listejus; ?></select></p>
        <p><input type="submit" value="Supprimer justificatif" name="suppjus"></p>
        <p><input type="submit" value="Modifier justificatif" name="modifjus"></p>
    </form>
</fieldset>
<br
<fieldset>
    <form action="index.php" id="afficherstats" method="post">
        <p><input type="submit" value="Afficher les statistiques" name="stats"></p>
    </form>
</fieldset>





</body>
</html>