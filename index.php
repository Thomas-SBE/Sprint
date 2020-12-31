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
        CtlAjoutUtilisateur($_POST["nouveaulogin"], $_POST["nouveaumdp"], $_POST["nouveaurole"], $_POST["nouveaunom"], $_POST["nouveauprenom"]);
    }
    elseif(isset($_POST["affdir"]))
    {
        CtlAfficherPageDirecteur();
    }
    elseif (isset($_POST["affacc"])){
        CtlAfficherPageAgentAccueil();
    }
    elseif (isset($_POST["affadm"])){
        CtlAfficherPageAgentAdmin();
    }
    elseif(isset($_POST["supplog"]))
    {
        CtlSupprimerUtilisateur($_POST["agent"]);
    }
    elseif(isset($_POST["modiflog"])){
        CtlAffichePageModifLogin($_POST["agent"]);
    }
    elseif (isset($_POST["activemodiflogin"])){
        CtlModifLogin($_POST["modiflogin"], $_POST["modifmdp"], $_POST["idagent"], $_POST["modifnom"], $_POST["modifprenom"]);
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
    elseif (isset($_POST["modifser"])){
        CtlAffichePageModifService($_POST["services"]);
    }
    elseif(isset($_POST["activemodifservice"])){
        if (isset($_POST["justifafournir"])){
            CtlModifService($_POST["modifservice"], $_POST["modifmontant"], $_POST["idservice"], $_POST["justifafournir"]);

        }else{
            CtlModifService($_POST["modifservice"], $_POST["modifmontant"], $_POST["idservice"]);

        }
    }
    elseif(isset($_POST["suppser"])){
        CtlSupprimerService($_POST["services"]);
    }
    elseif (isset($_POST["creeretu"])){
        CtlAjouterEtudiant($_POST["nouveaunumetu"],$_POST["nouveaunometu"],$_POST["nouveauprenometu"],$_POST["nouvelleadresseetu"],$_POST["nouveauteletu"],$_POST["nouveaumailetu"],$_POST["nouveaudecouvertetu"],$_POST["nouvelledatenaissanceetu"]);
    }
    elseif (isset($_POST["rechercheetu"])){
        CtlRechercherEtudiant($_POST["etudiant"]);

    }
    elseif (isset($_POST["activemodifetu"])){
        CtlModifierEtudiant($_POST["modifnumetu"], $_POST["modifnometu"], $_POST["modifprenometu"], $_POST["modifdatenaissanceetu"], $_POST["modifadresseetu"], $_POST["modifteletu"], $_POST["modifmailetu"], $_POST["modifdecouvertetu"]);
    }
    elseif (isset($_POST["activesuppetu"])){
        CtlSupprimerEtu($_POST["modifnometu"]);
    }
    elseif (isset($_POST["changedecouvert"]))
    {
        CtlChangerDecouvert($_POST["numetu"], $_POST["nouveaudecouvert"]);
    }
    elseif (isset($_POST["payer"]))
    {
        CtlAfficherListeAPayer($_POST["etudiant"]);
    }
    elseif (isset($_POST["paiementbtn"]))
    {
        CtlEffectuerUnPaiement($_POST["paiementsamodif"], $_POST["etuname"]);
    }
    elseif (isset($_POST["differebtn"]))
    {
        CtlPasserEnDiffere($_POST["paiementsamodif"], $_POST["etuname"]);
    }
    elseif (isset($_POST["affpaie"]))
    {
        CtlAfficherListeAPayer($_POST["etuname"]);
    }
    elseif (isset($_POST["btnrdv"])){
        $id_rdv = $_POST["btnrdv"];
        CtlSyntheseRdv($id_rdv);
    }
    elseif (isset($_POST["consultesynth"]))
    {
        CtlSyntheseEtu($_POST["etudiant"]);
    }
    else{
        CtlAfficherPageConnection();
    }
}catch(Exception $e)
{
    CtlAfficherErreurGenerale($e->getMessage());
}



?>