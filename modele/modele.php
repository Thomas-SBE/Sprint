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

function ajouterUtilisateurUniv($login, $mdp, $role)
{
    $c = getConnection();
    $req = "INSERT INTO utilisateurs(`LOGIN`,`MOT_DE_PASSE`,`ROLE`) VALUES (\"$login\", \"$mdp\", \"$role\")";
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

function modifLogin($login,$mdp, $user_id){
    $c = getConnection();
    $req = "UPDATE utilisateurs SET LOGIN = \"$login\", MOT_DE_PASSE =\"$mdp\" WHERE ID_UTILISATEUR = \"$user_id\"";
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

