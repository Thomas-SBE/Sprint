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

function afficherPageDirecteur($listeagents, $listedetoutlesjus, $listeservice, $msg_e="")
{
    $listeagentsuniv = "";
    foreach ($listeagents as $agent)
    {
        $listeagentsuniv .= "<option value='$agent->ID_UTILISATEUR'>[$agent->ROLE] $agent->LOGIN</option>";
    }

    $listejus="";
    $listejustif="";
    foreach ($listedetoutlesjus as $justificatif){
        $listejus .= "<option value='$justificatif->ID_JUSTIFICATIF'>$justificatif->NOM</option>";
        $listejustif .= "<p><input type='checkbox' name='justifafournir[]' value='$justificatif->ID_JUSTIFICATIF'> $justificatif->NOM</p>";
    }

    $listeser = "";
    foreach ($listeservice as $services){
        $listeser .= "<option value='$services->ID_SERVICE'>$services->NOM - $services->MONTANT €</option>";
    }



    $user = getUtilisateurByID($_SESSION["user_id"]);
    $username = $user->LOGIN;
    $msg_erreur = $msg_e;
    require_once("vue/directeur.php");
}

function afficherPageAgentAccueil()
{
    require_once("vue/agentaccueil.php");
}

function afficherPageAdmin($listeagentsadmin, $formations=null, $employeselect=null, $dateselect=null)
{
    $agentADM = "";
    foreach ($listeagentsadmin as $agent)
    {
        $agentADM .= "<option value='$agent->ID_UTILISATEUR'>$agent->NOM $agent->PRENOM</option>";
    }
    if($formations != null && $employeselect != null)
    {
        $call = array();
        $call["date"] = $dateselect;
        $call["name"] = $employeselect;
        $forms = $formations;
        foreach ($forms as $formation)
        {
            $time = explode(":", $formation->HEURES);
            $call[$time[0]] = 1;
        }
    }
    $dateTodayRaw = getdate();
    $dateToday = $dateTodayRaw["year"]."-".$dateTodayRaw["mon"]."-".$dateTodayRaw["mday"];
    require_once("vue/agentadmin.php");
}