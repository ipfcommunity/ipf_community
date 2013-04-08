DROP DATABASE IF EXISTS IPF_COM;

CREATE DATABASE IF NOT EXISTS IPF_COM;
USE IPF_COM;


# #############################################################################
#       TABLE : USER
# #############################################################################

CREATE TABLE IF NOT EXISTS IPF_USER
 (
   ID_USER BIGINT(5) NOT NULL  ,
   NB_LEVEL int(2) NOT NULL  ,
   NOM_USER CHAR(32) NOT NULL  ,
   PRENOM_USER CHAR(32) NOT NULL  ,
   MAIL_ECOLE CHAR(32) NOT NULL  ,
   MDP CHAR(32) NOT NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : MODERATEUR
# #############################################################################

CREATE TABLE IF NOT EXISTS MODERATEUR
 (
   ID_USER BIGINT(5) NOT NULL  ,
   NOM_USER CHAR(32) NOT NULL  ,
   PRENOM_USER CHAR(32) NOT NULL  ,
   MAIL_ECOLE CHAR(32) NOT NULL  ,
   MDP CHAR(32) NOT NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : ADMINISTRATEUR
# #############################################################################

CREATE TABLE IF NOT EXISTS ADMINISTRATEUR
 (
   ID_USER BIGINT(5) NOT NULL  ,
   NOM_USER CHAR(32) NOT NULL  ,
   PRENOM_USER CHAR(32) NOT NULL  ,
   MAIL_ECOLE CHAR(32) NOT NULL  ,
   MDP CHAR(32) NOT NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : MATIERE
# #############################################################################

CREATE TABLE IF NOT EXISTS MATIERE
 (
   ID_MATIERE BIGINT(4) NOT NULL  ,
   NOM_MATIERE CHAR(32) NOT NULL  
   , PRIMARY KEY (ID_MATIERE) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : FICHIER
# #############################################################################

CREATE TABLE IF NOT EXISTS FICHIER
 (
   ID_FICHIER BIGINT(6) NOT NULL  ,
   ID_USER BIGINT(5) NOT NULL  ,
   DATE_DEPOT DATETIME NOT NULL  ,
   DESCRIPTION CHAR(32) NOT NULL  ,
   LIEN_FICHIER CHAR(60) NOT NULL  
   , PRIMARY KEY (ID_FICHIER) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : ELEVE
# #############################################################################

CREATE TABLE IF NOT EXISTS ELEVE
 (
   
   ID_CLASSE BIGINT(5) NOT NULL  ,
   ID_USER BIGINT(5) NOT NULL  ,
   DATE_INSCRIPTION DATE NOT NULL  ,
   MAIL_PERSO CHAR(32) ,
   NOM_USER CHAR(32) NOT NULL  ,
   PRENOM_USER CHAR(32) NOT NULL  ,
   MAIL_ECOLE CHAR(32) NOT NULL  ,
   MDP CHAR(32) NOT NULL  
   , PRIMARY KEY (id_user) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : VRAC
# #############################################################################

CREATE TABLE IF NOT EXISTS VRAC
 (
   ID_FICHIER BIGINT(6) NOT NULL  ,
   ID_USER BIGINT(5) NOT NULL  ,
   DATE_DEPOT DATETIME NOT NULL  ,
   DESCRIPTION CHAR(32) NOT NULL  ,
   LIEN_FICHIER CHAR(60) NOT NULL  
   , PRIMARY KEY (ID_FICHIER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COUR_EXERCICE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COUR_EXERCICE
 (
   ID_FICHIER BIGINT(6) NOT NULL  ,
   ID_USER BIGINT(5) NOT NULL  ,
   ID_CLASSE BIGINT(5) NOT NULL  ,
   ID_MATIERE BIGINT(4) NOT NULL,
   DATE_DEPOT DATETIME NOT NULL  ,
   DESCRIPTION CHAR(32) NOT NULL  ,
   COUR_EXERCICE BOOL NOT NULL,
   LIEN_FICHIER CHAR(60) NOT NULL  
   , PRIMARY KEY (ID_FICHIER) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : SECTION
# #############################################################################

CREATE TABLE IF NOT EXISTS SECTION
 (
   ID_SECTION BIGINT(4) NOT NULL  ,
   NOM_SECTION CHAR(32) NOT NULL  ,
   DIPLOME CHAR(32) NOT NULL  ,
   SPECIALITER CHAR(32)   
   , PRIMARY KEY (ID_SECTION) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : LEVEL
# #############################################################################

CREATE TABLE IF NOT EXISTS LEVEL
 (
   NB_LEVEL int(2) NOT NULL  ,
   AUTORISATION1 BOOL NOT NULL  ,
   AUTORISATION2 BOOL NOT NULL  
   , PRIMARY KEY (NB_LEVEL) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : EVENEMENT
# #############################################################################

CREATE TABLE IF NOT EXISTS EVENEMENT
 (
   ID_EVENEMENT BIGINT(6) NOT NULL  ,
   TITRE CHAR(32) NOT NULL  ,
   DESCRIPTION CHAR(32)
   , PRIMARY KEY (ID_EVENEMENT) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : PROFFESSEUR
# #############################################################################

CREATE TABLE IF NOT EXISTS PROFFESSEUR
 (
   ID_USER BIGINT(5) NOT NULL  ,
   NOM_USER CHAR(32) NOT NULL  ,
   PRENOM_USER CHAR(32) NOT NULL  ,
   MAIL_ECOLE CHAR(32) NOT NULL  ,
   MDP CHAR(32) NOT NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : CLASSE
# #############################################################################

CREATE TABLE IF NOT EXISTS CLASSE
 (
   ID_CLASSE BIGINT(5) NOT NULL  ,
   ID_SECTION BIGINT(4) NOT NULL  ,
   NOM_CLASSE CHAR(32) NOT NULL  
   , PRIMARY KEY (ID_CLASSE) 
 ) 
 comment = "";

# #############################################################################
#       TABLE : SALLE
# #############################################################################

CREATE TABLE IF NOT EXISTS SALLE
 (
   ID_SALLE BIGINT(4) NOT NULL  ,
   NOM_SALLE CHAR(32) NOT NULL  ,
   BATIMENT CHAR(32) NOT NULL  ,
   NUM_SALLE REAL(4,2) NOT NULL  
   , PRIMARY KEY (ID_SALLE) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       TABLE : MESSAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MESSAGE
 (
   DATE_ENVOIE DATETIME NOT NULL  ,
   ID_USER BIGINT(5) NOT NULL  ,
   ID_USER_DEST BIGINT(5) NOT NULL  ,
   ID_MESSAGE BIGINT(6) NOT NULL  ,
   CONTENU VARCHAR(1500) NOT NULL  
   , PRIMARY KEY (DATE_ENVOIE,ID_USER,ID_USER_DEST)
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMMENTAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMMENTAIRE
 (
   ID_USER BIGINT(5) NOT NULL  ,
   DATE_ENVOIE DATETIME NOT NULL  ,
   ID_COM BIGINT(6) NOT NULL  ,
   ID_MESSAGE BIGINT(6) NOT NULL  ,
   CONTENU_COMMENTAIRE CHAR(255)NOT NULL  
   , PRIMARY KEY (ID_USER,DATE_ENVOIE,ID_COM)
 ) 
 comment = "";


# #############################################################################
#       TABLE : ENSEIGNE
# #############################################################################

CREATE TABLE IF NOT EXISTS ENSEIGNE
 (
   ID_CLASSE BIGINT(5) NOT NULL  ,
   ID_MATIERE BIGINT(4) NOT NULL  ,
   ID_SALLE BIGINT(4),
   ID_USER BIGINT(5) NOT NULL  ,
   DATE_DEBUT DATETIME,
   DATE_FIN DATETIME 
   
 ) 
 comment = "";


# #############################################################################
#       TABLE : AGENDA
# #############################################################################

CREATE TABLE IF NOT EXISTS AGENDA
 (
   ID_CLASSE BIGINT(5) NOT NULL  ,
   ID_EVENEMENT BIGINT(6) NOT NULL  ,
   ID_USER BIGINT(5) NOT NULL  ,
   DATE_DEBUT DATETIME NOT NULL  ,
   DATE_FIN DATETIME NOT NULL  
   , PRIMARY KEY (ID_CLASSE,ID_EVENEMENT,ID_USER) 
 ) 
 comment = "";


# #############################################################################
#       CREATION DES REFERENCES DE TABLE
# #############################################################################


ALTER TABLE IPF_USER 
  ADD FOREIGN KEY FK_USER_LEVEL (NB_LEVEL)
      REFERENCES LEVEL (NB_LEVEL) ;

ALTER TABLE FICHIER 
  ADD FOREIGN KEY FK_FICHIER_USER (ID_USER)
      REFERENCES IPF_USER (ID_USER)  on delete cascade ;

ALTER TABLE VRAC  
  ADD FOREIGN KEY FK_VRAC_USER (ID_USER)
      REFERENCES IPF_USER (ID_USER)  on delete cascade ;

ALTER TABLE ELEVE 
  ADD FOREIGN KEY FK_ELEVE_CLASSE (ID_CLASSE)
      REFERENCES CLASSE (ID_CLASSE) ;

ALTER TABLE COUR_EXERCICE 
  ADD FOREIGN KEY FK_COUR_EXERCICE_PROFFESSEUR (ID_USER)
      REFERENCES PROFFESSEUR (ID_USER) on delete cascade;

ALTER TABLE COUR_EXERCICE 
  ADD FOREIGN KEY FK_COUR_EXERCICE_MATIERE (ID_MATIERE)
      REFERENCES MATIERE (ID_MATIERE) ;

ALTER TABLE COUR_EXERCICE 
  ADD FOREIGN KEY FK_COUR_EXERCICE_FICHIER (ID_FICHIER)
      REFERENCES FICHIER (ID_FICHIER) ;

ALTER TABLE COUR_EXERCICE 
  ADD FOREIGN KEY FK_COUR_EXERCICE_CLASSE (ID_CLASSE)
      REFERENCES CLASSE (ID_CLASSE) ;

ALTER TABLE CLASSE 
  ADD FOREIGN KEY FK_CLASSE_SECTION (ID_SECTION)
      REFERENCES SECTION (ID_SECTION) ;

ALTER TABLE ENSEIGNE 
  ADD FOREIGN KEY FK_ENSEIGNE_CLASSE (ID_CLASSE)
      REFERENCES CLASSE (ID_CLASSE) ;


ALTER TABLE ENSEIGNE 
  ADD FOREIGN KEY FK_ENSEIGNE_MATIERE (ID_MATIERE)
      REFERENCES MATIERE (ID_MATIERE) ;


ALTER TABLE ENSEIGNE 
  ADD FOREIGN KEY FK_ENSEIGNE_SALLE (ID_SALLE)
      REFERENCES SALLE (ID_SALLE) ;


ALTER TABLE ENSEIGNE 
  ADD FOREIGN KEY FK_ENSEIGNE_PROFFESSEUR (ID_USER)
      REFERENCES PROFFESSEUR (ID_USER) ;


ALTER TABLE AGENDA 
  ADD FOREIGN KEY FK_AGENDA_CLASSE (ID_CLASSE)
      REFERENCES CLASSE (ID_CLASSE) ;


ALTER TABLE AGENDA 
  ADD FOREIGN KEY FK_AGENDA_EVENEMENT (ID_EVENEMENT)
      REFERENCES EVENEMENT (ID_EVENEMENT) ;


ALTER TABLE AGENDA 
  ADD FOREIGN KEY FK_AGENDA_USER (ID_USER)
      REFERENCES IPF_USER (ID_USER) ;
 
