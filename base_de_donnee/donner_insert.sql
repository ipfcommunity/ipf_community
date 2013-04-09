


# #######################################################################
# INSERET DONNEE
# #######################################################################
#


						
insert into level values(1,1,1),
                        (2,0,1),
                        (3,1,0),
                        (4,0,0);


insert into ADMINISTRATEUR (ID_USER,NOM_USER,PRENOM_USER,MAIL_ECOLE,MDP)
                values(1,'Riviere','Julien','julien.riviere@moniris.com',md5('mdp'));


drop user administrateur@'localhost';
drop user ADMINISTRATION@'localhost';
drop user professeur@'localhost';
drop user eleve@'localhost';
drop user generique@'localhost';

Create user administrateur@'localhost' identified by 'iris';
grant all on ipf_com.* to administrateur@'localhost' with grant option;

Create user ADMINISTRATION@'localhost' identified by 'iris';
grant select,update,delete,insert on ipf_com.* to ADMINISTRATION@'localhost';

Create user professeur@'localhost' identified by 'iris';
grant all on ipf_com.* to professeur@'localhost';

Create user eleve@'localhost' identified by 'iris';
grant select,update,delete,insert on ipf_com.* to eleve@'localhost';
grant all on *.* to eleve@'localhost';

Create user generique@'localhost' identified by 'iris';
grant select on ipf_com.IPF_USER to generique@'localhost';
grant select on ipf_com.eleve to generique@'localhost';
grant select on ipf_com.classe to generique@'localhost';

