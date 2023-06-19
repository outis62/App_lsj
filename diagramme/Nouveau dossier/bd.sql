/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  15/06/2023 13:59:36                      */
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
   motsPasse            int
);

/*==============================================================*/
/* Table : Annee                                                */
/*==============================================================*/
create table Annee
(
   idAnnee              int not null,
   nom                  varchar(254),
   primary key (idAnnee)
);

/*==============================================================*/
/* Table : Classe                                               */
/*==============================================================*/
create table Classe
(
   idClasse             int not null,
   idAnnee              int not null,
   nom                  varchar(254),
   primary key (idClasse),
   key AK_Identifiant_1 (idClasse)
);

/*==============================================================*/
/* Table : Eleve                                                */
/*==============================================================*/
create table Eleve
(
   idEleve              int not null,
   idClasse             int not null,
   nom                  varchar(254),
   prenom               varchar(254),
   genre                varchar(254),
   numTelParent         numeric(8,0),
   primary key (idEleve)
);

/*==============================================================*/
/* Table : Parent                                               */
/*==============================================================*/
create table Parent
(
   id                   int,
   numTel               numeric(8,0) not null,
   idEleve              int,
   nom                  varchar(254),
   prenom               varchar(254),
   primary key (numTel)
);

/*==============================================================*/
/* Table : Trimestre                                            */
/*==============================================================*/
create table Trimestre
(
   idTrimestre          int not null,
   nom                  varchar(254),
   primary key (idTrimestre),
   key AK_Identifiant_1 (idTrimestre)
);

/*==============================================================*/
/* Table : association6                                         */
/*==============================================================*/
create table association6
(
   idTrimestre          int not null,
   idEleve              int not null,
   moyenne              real,
   primary key (idTrimestre, idEleve)
);

alter table Classe add constraint FK_association5 foreign key (idAnnee)
      references Annee (idAnnee) on delete restrict on update restrict;

alter table Eleve add constraint FK_association4 foreign key (idClasse)
      references Classe (idClasse) on delete restrict on update restrict;

alter table Parent add constraint FK_association8 foreign key (idEleve)
      references Eleve (idEleve) on delete restrict on update restrict;

alter table association6 add constraint FK_association6 foreign key (idEleve)
      references Eleve (idEleve) on delete restrict on update restrict;

alter table association6 add constraint FK_association6 foreign key (idTrimestre)
      references Trimestre (idTrimestre) on delete restrict on update restrict;

