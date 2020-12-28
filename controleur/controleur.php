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
    if (!empty($user)) {
        $_SESSION["user_id"] = $user->ID_UTILISATEUR;
        if ($user->ROLE == "D") {
            CtlAfficherPageDirecteur();
        } elseif ($user->ROLE == "ACC") {
            afficherPageAgentAccueil();
        } elseif ($user->ROLE == "ADM") {
            $agentsadmin = recupererAgentsAdministratifs();
            afficherPageAdmin($agentsadmin);
        }
    } else {
        afficherLoginAvecMessage("<strong style='color:red'>Le nom d'utilisateur ou le mot de passe n'est pas correct !</strong>");
    }
}

function CtlAfficherErreurGenerale($err)
{
    afficherPageErreurGenerale($err);
}

function CtlAjoutUtilisateur($login, $mdp, $role, $nom, $prenom)
{
    ajouterUtilisateurUniv($login, $mdp, $role, $nom, $prenom);
    echo("<form action='index.php' method='post'><p>L'utilisateur $login a été ajouté avec succes !<br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");
}

function CtlAfficherPageDirecteur()
{
    $agents = recupererListeAgents($_SESSION["user_id"]);
    $justif = recupererListeJustificatif();
    $service = recupererListeService();
    afficherPageDirecteur($agents, $justif, $service);

}

function CtlAfficherPageAgentAccueil(){
    afficherPageAgentAccueil();
}

function CtlSupprimerUtilisateur($id)
{
    supprimerUtilisateur($id);
    echo("<form action='index.php' method='post'><p>L'utilisateur n° $id a été supprimé avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");
}

function CtlModifLogin($login, $mdp, $user_id, $nom, $prenom)
{
    $user = getUtilisateurByID($user_id);
    $prenomuti = $user->PRENOM;
    modifLogin($login, $mdp, $user_id, $nom, $prenom);
    echo("<form action='index.php' method='post'><p>L'utilisateur $prenomuti a été modifié avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAffichePageModifLogin($user_id)
{
    $user = getUtilisateurByID($user_id);
    $prenom = $user->PRENOM;
    echo(" <p>Modification du login de $prenom </p>
            <fieldset>
                    <form action='index.php' id='modifierlogin' method='post'>
                    <p><input name='idagent' type='hidden' value='$user_id'></p>
                    <p><label for='modifprenom'>Choisissez un nouveau prenom : </label><input type='text' name='modifprenom'></p>
                    <p><label for='modifnom'>Choisissez un nouveau nom : </label><input type='text' name='modifnom'></p>
                    <p><label for='modiflogin'>Choisissez un nouveau login : </label><input type='text' name='modiflogin'></p>
                    <p><label for='modifmdp'>Choisissez un nouveau mot de passe : </label><input type='text' name='modifmdp'></p>
                    <p><input type='submit' name='activemodiflogin' value='Modifier'></p>
            </fieldset>");
}

function CtlAjouterJustificatif($nom)
{
    ajouterJustificatif($nom);
    echo("<form action='index.php' method='post'><p>Le justificatif $nom a été ajouté avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlSupprimerJustificatif($id)
{
    supprimerJustificatif($id);
    echo("<form action='index.php' method='post'><p>Le justificatif n° $id a été supprimé avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlModifJustificatif($nom, $id_justificatif)
{
    $_res = getJustificatifByID($id_justificatif);
    $justif = $_res->NOM;
    modifJustificatif($nom, $id_justificatif);
    echo("<form action='index.php' method='post'><p>L'utilisateur $justif a été modifié avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAffichePageModifJustificatif($id_justificatif)
{
    $_temp = getJustificatifByID($id_justificatif);
    $justif = $_temp->NOM;
    echo(" <p>Modification du login de $justif </p>
            <fieldset>
                    <form action='index.php' id='modifierjustif' method='post'>
                    <p><input name='idjustif' type='hidden' value='$id_justificatif'></p>
                    <p><label for='modifjustif'>Choisissez un nouveau justificatif : </label><input type='text' name='modifjustif'></p>
                    <p><input type='submit' name='activemodifjustif' value='Modifier'></p>
            </fieldset>");
}

function CtlAfficherPageAdminAvecPlanning($employe, $date)
{
    $agentsadmin = recupererAgentsAdministratifs();
    $formations = getFormations($employe, $date);
    $employename = getUtilisateurByID($employe);
    afficherPageAdmin($agentsadmin, $formations, $employename->NOM . " " . $employename->PRENOM, $date);
}

function CtlAjouterService($nom, $montant, $checked = null)
{
    $sid = ajouterService($nom, $montant);
    if ($checked != null) {
        foreach ($checked as $check) {
            ajouterAFournir($sid, $check);
        }
    }

    echo("<form action='index.php' method='post'><p>Le service $nom a été ajouté avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAffichePageModifService($id_service)
{
    $service = getServiceByID($id_service);
    $nomservice = $service->NOM;
    $listejus="";
    $listejustif="";
    $listedetoutlesjus= recupererListeJustificatif();
    foreach ($listedetoutlesjus as $justificatif){
        $listejus .= "<option value='$justificatif->ID_JUSTIFICATIF'>$justificatif->NOM</option>";
        $listejustif .= "<p><input type='checkbox' name='justifafournir[]' value='$justificatif->ID_JUSTIFICATIF'> $justificatif->NOM</p>";
    }
    echo(" <p>Modification du service $nomservice </p>
            <fieldset>
                    <form action='index.php' id='modifierservice' method='post'>
                    <p><input name='idservice' type='hidden' value='$id_service'></p>
                    <p><label for='modifservice'>Choisissez un nouveau nom pour le service : </label><input type='text' name='modifservice'></p>
                    <p>Choisissez les nouveaux justificatifs à fournir : </p>
                    <p> $listejustif</p>
                    <p><label for='modifmontant'>Choisissez un nouveau montant : </label><input type='text' name='modifmontant'></p>
                    <p><input type='submit' name='activemodifservice' value='Modifier'></p>
                    </form>
            </fieldset>");
}

function CtlModifService($nom, $montant, $id_service, $checked = null){
    modifService($nom, $montant, $id_service);
    suppAFournir($id_service);
    if ($checked != null){
        foreach ($checked as $check){
            ajouterAFournir($id_service, $check);
        }
    }
    echo("<form action='index.php' method='post'><p>Le service $nom a été modifié avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");


}

function CtlSupprimerService($id){
    supprimerService($id);
    echo("<form action='index.php' method='post'><p>Le service $id a été supprimé avec succès ! <br><button type='submit' name='affdir'>Retour vers la direction</button><form action='index.php' method='post'>");

}

function CtlAjouterEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance){
    ajouterEtudiant($id_etu, $nom, $prenom, $adresse, $tel, $mail, $decouvert, $datenaissance);
    echo("<form action='index.php' method='post'><p>L'étudiant $nom $prenom a été ajouté avec succès ! <br><button type='submit' name='affacc'>Retour vers l'accueil</button><form action='index.php' method='post'>");

}



