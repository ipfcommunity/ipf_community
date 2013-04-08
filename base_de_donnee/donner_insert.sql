


# #######################################################################
# INSERET DONNEE
# #######################################################################
#


insert into MATIERE values(1,'Mathématique'),
			(2,'Francais'),
			(3,'Droit'),
			(4,'Informatique'),
			(5,'Anglais');
									
insert into SALLE values(1,'porte champéret',2.6,'salle chouaki'),
			(2,'porte champéret',2.7,'salle velon'),
			(3,'porte champéret',2.8,'salle vinet'),
			(4,'porte champéret',1.6,'salle mus');
	
insert into section values(1,'SIO','BTS','SLAM'),
			(2,'SIO','BTS','SISR'),
			(3,'MUC','BTS','option 1'),
			(4,'MUC','BTS','option 2');							

insert into classe values(1,1,'Sio2devlm'),
			(2,2,'Sio2reslm'),
			(3,1,'Sio2devmv'),
			(4,1,'Sio2devjv'),
			(5,3,'CG2option1'),
			(6,4,'CG2option2'),
                        (7,2,'Sio2resjv');

					
insert into level values(1,1,1),
                        (2,0,1),
                        (3,1,0),
                        (4,0,0);

insert into evenement values(1,"exo 4,5","pour cette exercice il vous faut..."),
                            (2,"devoir 3","reviser les chapiter 1 et 2"),
                            (3,"exo 8","pour cette exercice il vous faut..."),
                            (4,"devoir 1","reviser les chapiter 1 et 2");


insert into ELEVE (TYPE_ELEVE ,ID_CLASSE,ID_USER,DATE_INSCRIPTION,MAIL_PERSO,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values('eleve',1,1,'2012/10/10','mailperso@mail.fr','pire','camille','camille.pire@moniris.com',md5('mdp'));

insert into ELEVE (TYPE_ELEVE ,ID_CLASSE,ID_USER,DATE_INSCRIPTION,MAIL_PERSO,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values('eleve',1,2,'2012/10/10','mailperso@mail.fr','pujade','jeanmarie','jeanmarie.pujade@moniris.com',md5('mdp'));

insert into ELEVE (TYPE_ELEVE ,ID_CLASSE,ID_USER,DATE_INSCRIPTION,MAIL_PERSO,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values('eleve',1,3,'2012/10/10','mailperso@mail.fr','tripot','xavier','jeanmarie.pujade@moniris.com',md5('mdp'));

insert into ELEVE (TYPE_ELEVE ,ID_CLASSE,ID_USER,DATE_INSCRIPTION,MAIL_PERSO,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values('eleve',1,4,'2012/10/10','mailperso@mail.fr','blanquet','thibaud','jeanmarie.pujade@moniris.com',md5('mdp'));

insert into ELEVE (TYPE_ELEVE ,ID_CLASSE,ID_USER,DATE_INSCRIPTION,MAIL_PERSO,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values('eleve',2,5,'2012/10/10','mailperso@mail.fr','plaut','pauline','pauline.plaut@moniris.com',md5('mdp'));

insert into PROFFESSEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(6,'guillemet','vincent','vincent.guilemet@moniris.com',md5('mdp'));

insert into PROFFESSEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(7,'mus','shiro','shiro.mus@moniris.com',md5('mdp'));

insert into PROFFESSEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(8,'lemarchant','jacques','jacques.lemarchant@moniris.com',md5('mdp'));

insert into ADMINISTRATEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(9,'riviere','julien','julien.riviere@moniris.com',md5('mdp'));

insert into MODERATEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(10,'galbas','presilia','presilia.galbas@moniris.com',md5('mdp'));

insert into MODERATEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(11,'oliveira','jose','jose.oliveira@moniris.com',md5('mdp'));

drop user administrateur@'localhost';
drop user moderateur@'localhost';
drop user professeur@'localhost';
drop user eleve@'localhost';
drop user generique@'localhost';

Create user administrateur@'localhost' identified by 'iris';
grant all on ipf_com.* to administrateur@'localhost' with grant option;

Create user moderateur@'localhost' identified by 'iris';
grant select,update,delete,insert on ipf_com.* to moderateur@'localhost';

Create user professeur@'localhost' identified by 'iris';
grant all on ipf_com.* to professeur@'localhost';

Create user eleve@'localhost' identified by 'iris';
grant select,update,delete,insert on ipf_com.* to eleve@'localhost';
grant all on *.* to eleve@'localhost';

Create user generique@'localhost' identified by 'iris';
grant select on ipf_com.IPF_USER to generique@'localhost';
grant select on ipf_com.eleve to generique@'localhost';
grant select on ipf_com.classe to generique@'localhost';


insert into enseigne(ID_CLASSE,ID_MATIERE,ID_SALLE,ID_USER,DATE_DEBUT,DATE_FIN)
                          values(1,2,3,8,20130226110000,20130226120000),
                                (1,4,4,7,20130180090000,20130218103000),
                                (1,4,4,6,20130227170000,20130227183000),
                                (2,4,4,7,20130180090000,20130218103000),
                                (2,4,4,6,20130227170000,20130227183000);

insert into agenda values(1,3,2,20130268090000,20130268103000),
                        (1,1,1,20130219170000,20130219183000),
                        (1,2,1,20130227170000,20130227183000);