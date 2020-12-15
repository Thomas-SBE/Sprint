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
        CtlSupprimerUtlisateur($_POST["supprimeragent"]);
    }
    else{
        CtlAfficherPageConnection();
    }
}catch(Exception $e)
{
    CtlAfficherErreurGenerale($e->getMessage());
}



?>