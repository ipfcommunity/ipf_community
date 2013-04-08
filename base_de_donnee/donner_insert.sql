


# #######################################################################
# INSERET DONNEE
# #######################################################################
#

									
insert into SALLE values(1,'porte champéret',2.6,'salle chouaki'),
			(2,'porte champéret',2.7,'salle velon'),
			(3,'porte champéret',2.8,'salle vinet'),
			(4,'porte champéret',1.6,'salle mus');
						
insert into level values(1,1,1),
                        (2,0,1),
                        (3,1,0),
                        (4,0,0);


insert into ADMINISTRATEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(1,'Riviere','Julien','julien.riviere@moniris.com',md5('mdp'));


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

