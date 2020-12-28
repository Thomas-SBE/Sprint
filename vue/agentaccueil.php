<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page agent d'acceuil</title>
    <link rel="stylesheet"  href="style/master.css" />
</head>
<body>
<fieldset>
    <legend>Création nouvel étudiant</legend>
    <form action="index.php" id="etu" method="post" autocomplete="off">
        <p><label for="nouveaunumetu">Numéro étudiant : </label><input type="number" name="nouveaunumetu" required></p>
        <p><label for="nouveauprenometu">Prénom : </label><input type="text" name="nouveauprenometu" required></p>
        <p><label for="nouveaunometu">Nom : </label><input type="text" name="nouveaunometu" required></p>
        <p><label for="nouvelleadresseetu">Adresse : </label><input type="text" name="nouvelleadresseetu" required></p>
        <p><label for="nouveauteletu">Numéro de téléphone : </label><input type="tel" name="nouveauteletu" required></p>
        <p><label for="nouveaumailetu">Adresse mail : </label><input type="email" name="nouveaumailetu" required></p>
        <p><label for="nouveaudecouvertetu">Découvert autorisé : </label><input type="number" name="nouveaudecouvertetu" required></p>
        <p><label for="nouvelledatenaissanceetu">Date de naissance : </label><input type="date" name="nouvelledatenaissanceetu" required></p>
        <p><input type="submit" value="Créer l'étudiant" name="creeretu"></p>
    </form>
</fieldset>

<fieldset>
    <legend>Les étudiants</legend>
    <form action="index.php" id="etu" method="post">
        <p><input type="submit" value="Saisir ou modifier informations" name="saisiinfo"></p>
        <p><input type="submit" value="Consulter synthèse" name="consultesynth"></p>
        <p><input type="submit" value="Effectuer payement" name="payer"></p>
        <p><input type="submit" value="Remboursement" name="rembourser"></p>
        <p><input type="submit" value="Prendre RDV" name="prendrerdv"></p>
    </form>
</fieldset>
</body>
</html>