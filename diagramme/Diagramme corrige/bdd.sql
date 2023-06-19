/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  15/06/2023 19:11:46                      */
/*==============================================================*/


drop table if exists Administrateur;

drop table if exists Annee;

drop table if exists Classe;

drop table if exists Eleve;

drop table if exists Parent;

drop table if exists Trimestre;

drop table if exists association6;

/*==============================================================*/
/* Table : Administrateur                                       */
/*==============================================================*/
create table Administrateur
(
   idAdmin              int,
   nom                  varchar(254),
   premon               varchar(254),
   email                int,
   motPasse             int
);

/*==============================================================*/
/* Table : Annee                                                */
/*==============================================================*/
create table Annee
(
   idAnnee              int,
   nomannee             varchar(254) not null,
   nomclasse            varchar(254) not null,
   primary key (nomannee),
   key AK_Identifiant_1 (idAnnee)
);

/*==============================================================*/
/* Table : Classe                                               */
/*==============================================================*/
create table Classe
(
   idClasse             int not null,
   nomclasse            varchar(254) not null,
   primary key (nomclasse),
   key AK_Identifiant_1 (idClasse),
   key AK_Identifiant_2 (idClasse)
);

/*==============================================================*/
/* Table : Eleve                                                */
/*==============================================================*/
create table Eleve
(
   idEleve              int,
   matricule            int not null,
   nomclasse            varchar(254) not null,
   numTel               numeric(8,0) not null,
   nom                  varchar(254),
   prenom               varchar(254),
   genre                varchar(254),
   primary key (matricule)
);

/*==============================================================*/
/* Table : Parent                                               */
/*==============================================================*/
create table Parent
(
   idParent             int,
   numTel               numeric(8,0) not null,
   nom                  varchar(254),
   prenom               varchar(254),
   primary key (numTel) 
);

/*==============================================================*/
/* Table : Trimestre                                            */
/*==============================================================*/
create table Trimestre
(
   idTrimestre          int,
   nomtrimestre         varchar(254) not null,
   primary key (nomtrimestre)
);

/*==============================================================*/
/* Table : association6                                         */
/*==============================================================*/
create table association6
(
   nomtrimestre         varchar(254) not null,
   matricule            int not null,
   moyenne              real,
   primary key (nomtrimestre, matricule)
);

alter table Annee add constraint FK_association5 foreign key (nomclasse)
      references Classe (nomclasse) on delete restrict on update restrict;

alter table Eleve add constraint FK_association4 foreign key (nomclasse)
      references Classe (nomclasse) on delete restrict on update restrict;

alter table Eleve add constraint FK_association8 foreign key (numTel)
      references Parent (numTel) on delete restrict on update restrict;

alter table association6 add constraint FK_association6 foreign key (matricule)
      references Eleve (matricule) on delete restrict on update restrict;

alter table association6 add constraint FK_association6 foreign key (nomtrimestre)
      references Trimestre (nomtrimestre) on delete restrict on update restrict;

