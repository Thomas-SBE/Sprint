<?php

require_once("controleur/controleur.php");

session_start();

try{
    if(isset($_POST["connecter"]))
    {
        CtlSeConnecter($_POST["nomutilisateur"], $_POST["mdp"]);
    }
    elseif(isset($_POST["creerlog"]))
    {
        CtlAjoutUtilisateur($_POST["nouveaulogin"], $_POST["nouveaumdp"], $_POST["nouveaurole"]);
    }
    elseif(isset($_POST["affdir"]))
    {
        CtlAfficherPageDirecteur();
    }
    elseif(isset($_POST["supplog"]))
    {
        CtlSupprimerUtilisateur($_POST["agent"]);
    }
    elseif(isset($_POST["modiflog"])){
        CtlAffichePageModifLogin($_POST["agent"]);
    }
    elseif (isset($_POST["activemodiflogin"])){
        CtlModifLogin($_POST["modiflogin"], $_POST["modifmdp"], $_POST["idagent"]);
    }
    elseif (isset($_POST["creerjus"])){
        CtlAjouterJustificatif($_POST["insererjus"]);
    }
    elseif (isset($_POST["suppjus"])){
        CtlSupprimerJustificatif($_POST["justificatif"]);
    }
    elseif (isset($_POST["activemodifjustif"])){
        CtlModifJustificatif($_POST["modifjustif"], $_POST["idjustif"]);
    }
    elseif (isset($_POST["modifjus"])){
        CtlAffichePageModifJustificatif($_POST["justificatif"]);
    }
    elseif (isset($_POST["visuplanning"]))
    {
        CtlAfficherPageAdminAvecPlanning($_POST["choisiagent"], $_POST["calendate"]);
    }elseif (isset($_POST["creerser"])){
        if (isset($_POST["justifafournir"])){
            CtlAjouterService($_POST["nouveauservice"], $_POST["prixservice"], $_POST["justifafournir"]);

        }else{
            CtlAjouterService($_POST["nouveauservice"], $_POST["prixservice"]);

        }
    }
    else{
        CtlAfficherPageConnection();
    }
}catch(Exception $e)
{
    CtlAfficherErreurGenerale($e->getMessage());
}



?>