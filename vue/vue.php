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

function afficherPageDirecteur($listeagents, $listedetoutlesjus, $listeservice, $utilisateur, $msg_e="")
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
    $username = $utilisateur->NOM . " " . $utilisateur->PRENOM;
    $msg_erreur = $msg_e;
    require_once("vue/directeur.php");
}

function afficherPageAgentAccueil()
{
    require_once("vue/agentaccueil.php");
}

function afficherPageAdmin($listeagentsadmin, $formations=null, $employeselect=null, $dateselect=null, $rdvlist=null)
{
    $agentADM = "";
    foreach ($listeagentsadmin as $agent)
    {
        $agentADM .= "<option value='$agent->ID_UTILISATEUR'>$agent->NOM $agent->PRENOM</option>";
    }
    $call = array();
    $call["date"] = $dateselect;
    $call["name"] = $employeselect;
    $forms = $formations;
    if($formations != null)
    {
        foreach ($forms as $formation)
        {
            $time = explode(":", $formation->HEURES);
            $call[$time[0]] = "<p>FORMATION</p>";
        }
    }
    if($rdvlist != null)
    {
        foreach ($rdvlist as $rendezvous)
        {
            $time = explode(":", $rendezvous->HEURES);
            $call[$time[0]] = "<button type='submit' name='btnrdv' value='$rendezvous->ID_RDV'>Rendez vous avec $rendezvous->NOM $rendezvous->PRENOM</button>";
        }
    }
    $dateTodayRaw = getdate();
    $dateToday = $dateTodayRaw["year"]."-".$dateTodayRaw["mon"]."-".$dateTodayRaw["mday"];
    require_once("vue/agentadmin.php");
}

function afficherListePourPaiement($paiements, $nometu)
{
    echo("<form action='index.php' method='post'><button type='submit' name='affacc'>Revenir a l'accueil</button><form action='index.php' method='post'><br><br>");

    $listedespaiements = "<form action='index.php' method='post' name='listedespaiements'><input type='hidden' name='etuname' value='$nometu'><br><h2>Liste des paiements de $nometu :</h2><ul>";
    foreach ($paiements as $p)
    {
        if($p->ETAT_DU_PAIEMENT == "PAYE")
        {
            $listedespaiements .= "<li><input type='checkbox' name='paiementsamodif[]' value='$p->ID_PAIEMENT' disabled>[ $p->ETAT_DU_PAIEMENT ] - $p->NOM - $p->MONTANT € ";
        }else{
            $listedespaiements .= "<li><input type='checkbox' name='paiementsamodif[]' value='$p->ID_PAIEMENT'>[ $p->ETAT_DU_PAIEMENT ] - $p->NOM - $p->MONTANT € ";
        }

        $listedespaiements .= "</input></li>";
    }
    $listedespaiements .= "<br><button name='paiementbtn'>Effectuer les paiements</button> - ";
    $listedespaiements .= "<button name='differebtn'>Passer en différé les paiements</button>";
    $listedespaiements .= "</ul></form>";
    echo($listedespaiements);
}