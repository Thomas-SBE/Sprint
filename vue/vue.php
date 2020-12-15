<?php

function afficherLogin()
{
    require_once("vue/login_page.php");
}

function afficherLoginAvecMessage($message)
{
    $message_err = $message;
    require_once("vue/login_page.php");
}

function afficherPageErreurGenerale($erreur)
{
    echo("<strong style='color:red'>Une erreur est survenue :</strong><br><p style='color:red'>$erreur</p>");
}

function afficherPageDirecteur($listeagents)
{
    $listeagentsuniv = "";
    foreach ($listeagents as $agent)
    {
        $listeagentsuniv .= "<option value='$agent->ID_UTILISATEUR'>[$agent->ROLE] $agent->LOGIN</option>";
    }
    $user = getUtilisateurByID($_SESSION["user_id"]);
    $username = $user->LOGIN;
    require_once("vue/directeur.php");
}

function afficherPageAgentAccueil()
{
    require_once("vue/agentaccueil.php");
}

function afficherPageAdmin($listeagentsadmin)
{
    $agentADM = "";
    foreach ($listeagentsadmin as $agent)
    {
        $agentADM .= "<option value='$agent->ID_UTILISATEUR'>$agent->LOGIN</option>";
    }
    require_once("vue/agentadmin.php");
}