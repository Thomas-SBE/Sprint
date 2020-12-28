<?php

function getConnection()
{
    $connexion=new PDO('mysql:host=127.0.0.1;dbname=adminuniversite','root','') ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

function getUtilisateurByLogin($login, $password)
{
    $c = getConnection();
    $req = "SELECT * FROM `utilisateurs` WHERE `LOGIN`=\"$login\" AND `MOT_DE_PASSE`=\"$password\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $user = $res->fetch();
    $res->closeCursor();
    return $user;
}

function getUtilisateurByID($id)
{
    $c = getConnection();
    $req = "SELECT * FROM `utilisateurs` WHERE `ID_UTILISATEUR`=\"$id\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $user = $res->fetch();
    $res->closeCursor();
    return $user;
}

function getJustificatifByID($id){
    $c = getConnection();
    $req = "SELECT * FROM `justificatif` WHERE `ID_JUSTIFICATIF`=\"$id\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $justif = $res->fetch();
    $res->closeCursor();
    return $justif;
}

function ajouterUtilisateurUniv($login, $mdp, $role, $nom, $prenom)
{
    $c = getConnection();
    $req = "INSERT INTO utilisateurs(`LOGIN`,`MOT_DE_PASSE`,`ROLE`,`NOM`,`PRENOM`) VALUES (\"$login\", \"$mdp\", \"$role\",\"$nom\", \"$prenom\")";
    $res = $c->query($req);
    $res->closeCursor();
}

function recupererListeAgents($id)
{
    $c = getConnection();
    $req = "SELECT * FROM utilisateurs WHERE `ID_UTILISATEUR`!=$id";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $agents = $res->fetchAll();
    $res->closeCursor();
    return $agents;
}

function supprimerUtilisateur($id)
{
    $c = getConnection();
    $req = "DELETE FROM utilisateurs WHERE `ID_UTILISATEUR`=$id";
    $res = $c->query($req);
    $res->closeCursor();
}

function recupererAgentsAdministratifs()
{
    $c = getConnection();
    $req = "SELECT * FROM utilisateurs WHERE `ROLE`=\"ADM\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $agents = $res->fetchAll();
    $res->closeCursor();
    return $agents;
}

function modifLogin($login,$mdp, $user_id, $nom, $prenom){
    $c = getConnection();
    $req = "UPDATE utilisateurs SET LOGIN = \"$login\", MOT_DE_PASSE =\"$mdp\", NOM =\"$nom\", PRENOM =\"$prenom\" WHERE ID_UTILISATEUR = \"$user_id\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function recupererListeJustificatif(){
    $c = getConnection();
    $req = "SELECT * FROM justificatif";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $justificatif = $res->fetchAll();
    $res->closeCursor();
    return $justificatif;
}
function ajouterJustificatif($nomjus){
    $c = getConnection();
    $req = "INSERT INTO justificatif (`NOM`) VALUE (\"$nomjus\")";
    $res = $c->query($req);
    $res->closeCursor();
}
function supprimerJustificatif($id){
    $c = getConnection();
    $req = "DELETE FROM justificatif WHERE `ID_JUSTIFICATIF`=\"$id\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function modifJustificatif($nom, $id_justificatif){
    $c = getConnection();
    $req = "UPDATE justificatif SET NOM = \"$nom\" WHERE ID_JUSTIFICATIF = \"$id_justificatif\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function getFormations($id, $date)
{
    $c = getConnection();
    $req = "SELECT CAST(DATEFORMATION AS TIME) AS `HEURES` FROM `formation` WHERE CAST(DATEFORMATION AS DATE) = \"$date\" AND ID_UTILISATEUR = $id";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $formations = $res->fetchAll();
    $res->closeCursor();
    return $formations;
}

function ajouterService($nom, $montant){
    $c = getConnection();
    $req = "INSERT INTO services (NOM,MONTANT) VALUES (\"$nom\",\"$montant\")";
    $res = $c->query($req);
    $id = $c->lastInsertId();
    $res->closeCursor();
    return $id;
}

function ajouterAFournir($id_service, $id_justificatif){
    $c = getConnection();
    $req = "INSERT INTO a_fournir (ID_SERVICE,ID_JUSTIFICATIF) VALUES (\"$id_service\",\"$id_justificatif\")";
    $res = $c->query($req);
    $res->closeCursor();
}

function modifService($nom, $montant, $id_service){
    $c = getConnection();
    $req = "UPDATE services SET NOM = \"$nom\", MONTANT = \"$montant\" WHERE ID_SERVICE = \"$id_service\"";
    $res = $c->query($req);
    $id = $c->lastInsertId();
    $res->closeCursor();
    return $id;
}

function suppAFournir($id_service){
    $c = getConnection();
    $req = "DELETE FROM a_fournir WHERE ID_SERVICE = \"$id_service\"";
    $res = $c->query($req);
    $res->closeCursor();
}
function recupererListeService(){
    $c = getConnection();
    $req = "SELECT * FROM services";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $service = $res->fetchAll();
    $res->closeCursor();
    return $service;
}

function getServiceByID($id){
    $c = getConnection();
    $req = "SELECT * FROM `services` WHERE `ID_SERVICE`=\"$id\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $service = $res->fetch();
    $res->closeCursor();
    return $service;
}

function supprimerService($id){
    $c = getConnection();
    $req = "DELETE FROM services WHERE `ID_SERVICE`=\"$id\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function ajouterEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance){
    $c = getConnection();
    $req = "INSERT INTO etudiants (ID_ETUDIANT, NOM, PRENOM, ADRESSE, TELEPHONE, MAIL, DECOUVERT, DATE_NAISSANCE) VALUES (\"$id_etu\", \"$nom\", \"$prenom\", \"$adresse\", \"$tel\", \"$mail\", \"$decouvert\", \"$datenaissance\")";
    $res = $c->query($req);
    $res->closeCursor();
}


?>