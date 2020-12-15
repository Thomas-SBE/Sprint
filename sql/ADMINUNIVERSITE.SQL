DROP DATABASE IF EXISTS AdminUniversite;

CREATE DATABASE IF NOT EXISTS AdminUniversite;
USE AdminUniversite;
# -----------------------------------------------------------------------------
#       TABLE : ETUDIANTS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ETUDIANTS
 (
   ID_ETUDIANT INTEGER NOT NULL  ,
   NOM VARCHAR(64) NULL  ,
   PRENOM VARCHAR(64) NULL  ,
   ADRESSE VARCHAR(255) NULL  ,
   TELEPHONE VARCHAR(10) NULL  ,
   MAIL VARCHAR(64) NULL  ,
   DECOUVERT INTEGER NULL  ,
   DATE_NAISSANCE DATE NULL  
   , PRIMARY KEY (ID_ETUDIANT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : JUTIFICATIF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS JUTIFICATIF
 (
   ID_JUSTIFICATIF INTEGER NOT NULL  ,
   NOM VARCHAR(128) NULL  
   , PRIMARY KEY (ID_JUSTIFICATIF) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : SERVICES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SERVICES
 (
   ID_SERVICE INTEGER NOT NULL  ,
   NOM VARCHAR(128) NULL  ,
   MONTANT INTEGER NULL  
   , PRIMARY KEY (ID_SERVICE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : FORMATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FORMATION
 (
   IDFORMATION INTEGER NOT NULL  ,
   ID_UTILISATEUR INTEGER NOT NULL  ,
   DATEFORMATION DATETIME NULL  
   , PRIMARY KEY (IDFORMATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FORMATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FORMATION_UTILISATEURS
     ON FORMATION (ID_UTILISATEUR ASC);

# -----------------------------------------------------------------------------
#       TABLE : RENDEZVOUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RENDEZVOUS
 (
   ID_RDV INTEGER NOT NULL  ,
   ID_ETUDIANT INTEGER NOT NULL  ,
   ID_SERVICE INTEGER NOT NULL  ,
   ID_UTILISATEUR INTEGER NOT NULL  ,
   DATE DATETIME NULL  ,
   DUREE_MINUTES INTEGER NULL  ,
   MOTIF VARCHAR(255) NULL  ,
   ACCEPTATION VARCHAR(32) NULL  
   , PRIMARY KEY (ID_RDV) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RENDEZVOUS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RENDEZVOUS_ETUDIANTS
     ON RENDEZVOUS (ID_ETUDIANT ASC);

CREATE  INDEX I_FK_RENDEZVOUS_SERVICES
     ON RENDEZVOUS (ID_SERVICE ASC);

CREATE  INDEX I_FK_RENDEZVOUS_UTILISATEURS
     ON RENDEZVOUS (ID_UTILISATEUR ASC);

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEURS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEURS
 (
   ID_UTILISATEUR INTEGER NOT NULL  ,
   LOGIN VARCHAR(32) NOT NULL  ,
   MOT_DE_PASSE VARCHAR(64) NOT NULL  ,
   ROLE VARCHAR(32) NOT NULL  ,
   PRENOM VARCHAR(128) NULL  ,
   NOM VARCHAR(128) NULL  
   , PRIMARY KEY (ID_UTILISATEUR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : A_FOURNIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS A_FOURNIR
 (
   ID_SERVICE INTEGER NOT NULL  ,
   ID_JUSTIFICATIF INTEGER NOT NULL  
   , PRIMARY KEY (ID_SERVICE,ID_JUSTIFICATIF) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE A_FOURNIR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_A_FOURNIR_SERVICES
     ON A_FOURNIR (ID_SERVICE ASC);

CREATE  INDEX I_FK_A_FOURNIR_JUTIFICATIF
     ON A_FOURNIR (ID_JUSTIFICATIF ASC);

# -----------------------------------------------------------------------------
#       TABLE : PAIEMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PAIEMENT
 (
   ID_ETUDIANT INTEGER NOT NULL  ,
   ID_SERVICE INTEGER NOT NULL  ,
   ETAT_DU_PAIEMENT VARCHAR(64) NULL  
   , PRIMARY KEY (ID_ETUDIANT,ID_SERVICE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PAIEMENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PAIEMENT_ETUDIANTS
     ON PAIEMENT (ID_ETUDIANT ASC);

CREATE  INDEX I_FK_PAIEMENT_SERVICES
     ON PAIEMENT (ID_SERVICE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE FORMATION 
  ADD FOREIGN KEY FK_FORMATION_UTILISATEURS (ID_UTILISATEUR)
      REFERENCES UTILISATEURS (ID_UTILISATEUR) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_ETUDIANTS (ID_ETUDIANT)
      REFERENCES ETUDIANTS (ID_ETUDIANT) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_SERVICES (ID_SERVICE)
      REFERENCES SERVICES (ID_SERVICE) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_UTILISATEURS (ID_UTILISATEUR)
      REFERENCES UTILISATEURS (ID_UTILISATEUR) ;


ALTER TABLE A_FOURNIR 
  ADD FOREIGN KEY FK_A_FOURNIR_SERVICES (ID_SERVICE)
      REFERENCES SERVICES (ID_SERVICE) ;


ALTER TABLE A_FOURNIR 
  ADD FOREIGN KEY FK_A_FOURNIR_JUTIFICATIF (ID_JUSTIFICATIF)
      REFERENCES JUTIFICATIF (ID_JUSTIFICATIF) ;


ALTER TABLE PAIEMENT 
  ADD FOREIGN KEY FK_PAIEMENT_ETUDIANTS (ID_ETUDIANT)
      REFERENCES ETUDIANTS (ID_ETUDIANT) ;


ALTER TABLE PAIEMENT 
  ADD FOREIGN KEY FK_PAIEMENT_SERVICES (ID_SERVICE)
      REFERENCES SERVICES (ID_SERVICE) ;

