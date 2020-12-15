<?php

require_once("modele/modele.php");
require_once("vue/vue.php");

function CtlAfficherPageConnection()
{
    afficherLogin();
}

function CtlSeConnecter($username, $password)
{
    $user = getUtilisateurByLogin($username, $password);
    if(!empty($user))
    {
        $_SESSION["user_id"] = $user->ID_UTILISATEUR;
        if($user->ROLE == "D")
        {
            CtlAfficherPageDirecteur();
        }
        elseif($user->ROLE == "ACC")
        {
            afficherPageAgentAccueil();
        }elseif($user->ROLE == "ADM")
        {
            $agentsadmin = recupererAgentsAdministratifs();
            afficherPageAdmin($agentsadmin);
        }
    }else{
        afficherLoginAvecMessage("<strong style='color:red'>Le nom d'utilisateur ou le mot de passe n'est pas correct !</strong>");
    }
}

function CtlAfficherErreurGenerale($err)
{
    afficherPageErreurGenerale($err);
}

function CtlAjoutUtilisateur($login, $mdp, $role)
{
    ajouterUtilisateurUniv($login, $mdp, $role);
    echo("<form action='index.php' method='post'><p>L'utilisateur $login a été ajouté avec succes !<button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");
}

function CtlAfficherPageDirecteur()
{
    $agents = recupererListeAgents($_SESSION["user_id"]);
    afficherPageDirecteur($agents);
}

function CtlSupprimerUtlisateur($id)
{
    supprimerUtilisateur($id);
    echo("<form action='index.php' method='post'><p>L'utilisateur n° $id a été supprimé avec succes !<button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");
}

?>