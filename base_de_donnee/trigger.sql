# ##################################################################################################

#                               TRIGGERS

# ##################################################################################################



# ##############################################################################

#                       heritage user

# ##############################################################################

Drop trigger InsertAdmin ;
Drop trigger updateAdmin ;
Drop trigger deleteAdmin ;

Drop trigger InsertEleve ;
Drop trigger updateEleve ;
Drop trigger deleteEleve ;

Drop trigger InsertProf ;
Drop trigger updateProf ;
Drop trigger deleteProf ;

Drop trigger InsertMod ;
Drop trigger updateMod ;
Drop trigger deleteMod ;


# #############################################
#           ADMINISTRATEUR
# #############################################

#       INSERTION

Delimiter //


create trigger InsertAdmin
before Insert ON ADMINISTRATEUR
for EACH row
begin

declare nu int;
declare na int;
declare ne int;
declare nprof int;
declare nmod int;


# compte dans les tables le nombre id_user qui son identique au nouvelle id_user 
select count(*) into nu from IPF_USER where id_user = new.id_user;	
select count(*) into ne from eleve where id_user = new.id_user;
select count(*) into nprof from PROFESSEUR where id_user = new.id_user;
select count(*) into nmod from ADMINISTRATION where id_user = new.id_user;


# dans le cas ou il y en a un il génére un message d'erreur
if ( ne > 0) or (nprof > 0) or (nmod > 0) or (nu > 0)
	then
		delete from administrateur where id_user=new.id_user;
        else
            
                insert into IPF_USER values(new.id_user,1,new.nom_user,new.prenom_user,new.mail_ecole,new.mdp);
                
           

END if;
end;

#                MODIFICATION

create trigger updateAdmin
before update ON ADMINISTRATEUR
for EACH row
begin


update IPF_USER
set
	id_user = new.id_user,
	nom_user = new.nom_user,
	prenom_user = new.prenom_user,
        mail_ecole = new.mail_ecole,
        mdp = new.mdp
where id_user = old.id_user and (nom_user=old.nom_user or prenom_user = old.prenom_user);
	
END; 

#               SUPRESSION

create trigger deleteAdmin
before delete ON ADMINISTRATEUR
for EACH row
begin


delete from IPF_USER where id_user = old.id_user;

end;//
Delimiter ;





# #############################################
#           ELEVE
# #############################################

#       INSERTION

Delimiter //


create trigger InsertEleve
before Insert ON eleve
for EACH row
begin

declare nu int;
declare na int;
declare ne int;
declare nprof int;
declare nmod int;


# compte dans les tables le nombre id_user qui son identique au nouvelle id_user 
select count(*) into nu from IPF_USER where id_user = new.id_user;	
select count(*) into na from administrateur where id_user = new.id_user;
select count(*) into nprof from PROFESSEUR where id_user = new.id_user;
select count(*) into nmod from ADMINISTRATION where id_user = new.id_user;


# dans le cas ou il y en a un il génére un message d'erreur
if ( na > 0) or (nprof > 0) or (nmod > 0) or (nu > 0)
	then
		delete from eleve where id_user=new.id_user;
        else
            
                insert into IPF_USER values(new.id_user,2,new.nom_user,new.prenom_user,new.mail_ecole,new.mdp);

           

END if;
end;
		


#                MODIFICATION

create trigger updateEleve
before update ON eleve
for EACH row
begin


update IPF_USER
set
	id_user = new.id_user,
	nom_user = new.nom_user,
	prenom_user = new.prenom_user,
        mail_ecole = new.mail_ecole,
        mdp = new.mdp
where id_user = old.id_user and (nom_user=old.nom_user or prenom_user = old.prenom_user);
	
END;

#               SUPRESSION

create trigger deleteEleve
before delete ON eleve
for EACH row
begin


delete from IPF_USER where id_user = old.id_user;

end;//
Delimiter ;




# #############################################
#           PROFESSEUR
# #############################################

#       INSERTION

Delimiter //


create trigger InsertProf
before Insert ON PROFESSEUR
for EACH row
begin

declare nu int;
declare na int;
declare ne int;
declare nprof int;
declare nmod int;


# compte dans les tables le nombre id_user qui son identique au nouvelle id_user 
select count(*) into nu from IPF_USER where id_user = new.id_user;	
select count(*) into ne from eleve where id_user = new.id_user;
select count(*) into na from administrateur where id_user = new.id_user;
select count(*) into nmod from ADMINISTRATION where id_user = new.id_user;


# dans le cas ou il y en a un il génére un message d'erreur
if ( ne > 0) or (na > 0) or (nmod > 0) or (nu > 0)
	then
		delete from PROFESSEUR where id_user=new.id_user;
        else
            
                insert into IPF_USER values(new.id_user,3,new.nom_user,new.prenom_user,new.mail_ecole,new.mdp);

           

END if;
end;
		


		

#                MODIFICATION

create trigger updateProf
before update ON PROFESSEUR 
for EACH row
begin


update IPF_USER
set
	id_user = new.id_user,
	nom_user = new.nom_user,
	prenom_user = new.prenom_user,
        mail_ecole = new.mail_ecole,
        mdp = new.mdp
where id_user = old.id_user and (nom_user=old.nom_user or prenom_user = old.prenom_user);
	
END;

#               SUPRESSION

create trigger deleteProf
before delete ON PROFESSEUR 
for EACH row
begin


delete from IPF_USER where id_user = old.id_user;

end;//
Delimiter ;



# #############################################
#           ADMINISTRATION
# #############################################

#       INSERTION

Delimiter //


create trigger InsertMod
before Insert ON ADMINISTRATION 
for EACH row
begin

declare nu int;
declare na int;
declare ne int;
declare nprof int;
declare nmod int;


# compte dans les tables le nombre id_user qui son identique au nouvelle id_user 
select count(*) into nu from IPF_USER where id_user = new.id_user;	
select count(*) into ne from eleve where id_user = new.id_user;
select count(*) into nprof from PROFESSEUR where id_user = new.id_user;
select count(*) into na from administrateur where id_user = new.id_user;


# dans le cas ou il y en a un il génére un message d'erreur
if ( ne > 0) or (nprof > 0) or (na > 0) or (nu > 0)
	then
		delete from ADMINISTRATION where id_user=new.id_user;
        else
            
                insert into IPF_USER values(new.id_user,4,new.nom_user,new.prenom_user,new.mail_ecole,new.mdp);

           

END if;
end;
	
#                MODIFICATION

create trigger updateMod
before update ON ADMINISTRATION 
for EACH row
begin


update IPF_USER
set
	id_user = new.id_user,
	nom_user = new.nom_user,
	prenom_user = new.prenom_user,
        mail_ecole = new.mail_ecole,
        mdp = new.mdp
where id_user = old.id_user and (nom_user=old.nom_user or prenom_user = old.prenom_user);
	
END;

#               SUPRESSION

create trigger deleteMod
before delete ON ADMINISTRATION 
for EACH row
begin


delete from IPF_USER where id_user = old.id_user;

end;//
Delimiter ;


# ##############################################################################

#                       heritage fichier

# ##############################################################################
Drop trigger InsertCourExercice;
drop trigger updateCourExercice;
drop trigger deleteCourExercice;

Drop trigger Insertvrac;
drop trigger updatevrac;
drop trigger deletevrac;



# #############################################
#           cour exercice
# #############################################

#       INSERTION

Delimiter //


create trigger InsertCourExercice
before Insert ON cour_exercice 
for EACH row
begin

declare nf int;
declare nv int;
declare nc int;


# compte dans les tables le nombre id_fichier qui son identique au nouvelle id_user 
select count(*) into nf from fichier where id_fichier = new.id_fichier;	
select count(*) into nv from vrac where id_fichier = new.id_fichier;



# dans le cas ou il y en a un il génére un message d'erreur
if ( nf > 0) or (nv > 0)
	then
		delete from cour_exercice where id_fichier=new.id_fichier;
        else
            
                insert into fichier(id_fichier,id_user,date_depot,description,lien_fichier) 
                    values(new.id_fichier,new.id_user,new.date_depot,new.description,new.lien_fichier);

           

END if;
end;
	
#                MODIFICATION

create trigger updateCourExercice
before update ON cour_exercice
for EACH row
begin


update fichier
set
	id_fichier = new.id_fichier,
	
	date_depot = new.date_depot,
        description = new.description,
        lien_fichier = new.lien_fichier
where id_fichier = old.id_fichier ;
	
END;

#               SUPRESSION

create trigger deleteCourExercice
before delete ON cour_exercice 
for EACH row
begin


delete from fichier where id_fichier = old.id_fichier;

end;//
Delimiter ;


# #############################################
#           vrac
# #############################################

#       INSERTION

Delimiter //


create trigger Insertvrac
before Insert ON vrac 
for EACH row
begin

declare nf int;
declare nv int;
declare nc int;


# compte dans les tables le nombre id_fichier qui son identique au nouvelle id_user 
select count(*) into nf from fichier where id_fichier = new.id_fichier;	
select count(*) into nc from cour_exercice where id_fichier = new.id_fichier;



# dans le cas ou il y en a un il génére un message d'erreur
if ( nf > 0) or (nc > 0)
	then
		delete from vrac where id_fichier=new.id_fichier;
        else
            
                insert into fichier values(new.id_fichier,new.id_user,new.date_depot,new.description,new.lien_fichier);

           

END if;
end;
	
#                MODIFICATION

create trigger updatevrac
before update ON vrac
for EACH row
begin


update fichier
set
	id_fichier = new.id_fichier,
	date_depot = new.date_depot,
        description = new.description,
        lien_fichier = new.lien_fichier
where id_fichier = old.id_fichier;
	
END;

#               SUPRESSION

create trigger deletevrac
before delete ON vrac
for EACH row
begin


delete from fichier where id_fichier = old.id_fichier;

end;//
Delimiter ;



