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

function getRendezVousComplet($id, $date)
{
    $c = getConnection();
    $req = "SELECT *, CAST(`DATE` AS TIME) AS `HEURES` FROM `rendezvous` NATURAL JOIN `etudiants` WHERE CAST(`DATE` AS DATE) = \"$date\" AND ID_UTILISATEUR = \"$id\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $rdv = $res->fetchAll();
    $res->closeCursor();
    return $rdv;
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

function rechercherEtudiant($nom){
    $c = getConnection();
    $req = "SELECT * FROM `etudiants` WHERE `NOM`=\"$nom\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $etu = $res->fetch();
    $res->closeCursor();
    return $etu;
}

function modifierEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance){
    $c = getConnection();
    $req = "UPDATE etudiants SET ID_ETUDIANT = \"$id_etu\", NOM = \"$nom\", PRENOM = \"$prenom\", ADRESSE = \"$adresse\", TELEPHONE = \"$tel\", MAIL = \"$mail\", DECOUVERT = \"$decouvert\", DATE_NAISSANCE = \"$datenaissance\" WHERE NOM = \"$nom\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function supprimerEtu($nom){
    $c = getConnection();
    $req = "DELETE FROM etudiants WHERE NOM = \"$nom\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function getMontantEnDiffere($id_etu)
{
    $c = getConnection();
    $req = "SELECT SUM(`MONTANT`) AS `DIFERE` FROM `paiement` NATURAL JOIN `services` WHERE `ETAT_DU_PAIEMENT`=\"DIFFERE\" AND `ID_ETUDIANT`=\"$id_etu\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $montant = $res->fetch();
    $res->closeCursor();
    return $montant->DIFERE;
}

function peutDiffere($id_etu, $montant)
{
    $c = getConnection();
    $req = "SELECT `DECOUVERT` FROM `etudiants` WHERE `ID_ETUDIANT`=\"$id_etu\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $data = $res->fetch();
    $res->closeCursor();
    $differeactuel = getMontantEnDiffere($id_etu);
    if($differeactuel + $montant > $data->DECOUVERT){return false;}
    else {return true;}
}

function changerDecouvert($id_etu, $montant)
{
    $c = getConnection();
    $req = "UPDATE etudiants SET `DECOUVERT`=\"$montant\" WHERE `ID_ETUDIANT`=\"$id_etu\"";
    $res = $c->query($req);
    $res->closeCursor();
}

function getListePaiements($id_etu)
{
    $c = getConnection();
    $req = "SELECT * FROM `paiement` NATURAL JOIN `services` WHERE `ID_ETUDIANT`=\"$id_etu\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $data = $res->fetchAll();
    $res->closeCursor();
    return $data;
}

function effectuerUnPaiement($idp)
{
    $c = getConnection();
    $req = "UPDATE `paiement` SET `ETAT_DU_PAIEMENT`=\"PAYE\" WHERE `ID_PAIEMENT`=\"$idp\" LIMIT 1";
    $res = $c->query($req);
    $res->closeCursor();
}

function passerEnDiffere($idp)
{
    $c = getConnection();
    $req = "UPDATE `paiement` SET `ETAT_DU_PAIEMENT`=\"DIFFERE\" WHERE `ID_PAIEMENT`=\"$idp\" LIMIT 1";
    $res = $c->query($req);
    $res->closeCursor();
}

function getPaiementByID($id)
{
    $c = getConnection();
    $req = "SELECT * FROM `paiement` WHERE `ID_PAIEMENT`=\"$id\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $paie = $res->fetch();
    $res->closeCursor();
    return $paie;
}

function getNomEtuByIdRdv($id_rdv){
    $c = getConnection();
    $req = "SELECT * FROM rendezvous INNER JOIN etudiants ON rendezvous.ID_ETUDIANT = etudiants.ID_ETUDIANT WHERE ID_RDV = \"$id_rdv\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $rdv = $res->fetch();
    $res->closeCursor();
    return $rdv;
}

function getEtudiantByID($id)
{
    $c = getConnection();
    $req = "SELECT * FROM `etudiants` WHERE `ID_ETUDIANT`=\"$id\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $data = $res->fetch();
    $res->closeCursor();
    return $data;
}

function getServiceByIdRdv($id_rdv){
    $c = getConnection();
    $req = "SELECT * FROM rendezvous INNER JOIN services ON rendezvous.ID_SERVICE = services.ID_SERVICE WHERE ID_RDV = \"$id_rdv\"";
    $res = $c->query($req);
    $res->setFetchMode(PDO::FETCH_OBJ);
    $serv = $res->fetch();
    $res->closeCursor();
    return $serv;
}

?>