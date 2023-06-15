/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  14/06/2023 08:00:11                      */
/*==============================================================*/


drop table if exists ADMIN;

drop table if exists MOYENNE;

drop table if exists PARENT;

/*==============================================================*/
/* Table : ADMIN                                                */
/*==============================================================*/
create table ADMIN
(
   NOM                  varchar(50) not null,
   PRENOM               varchar(50) not null,
   TITRE                char(100) not null,
   EMAIL                char(80) not null,
   MOT_DE_PASSE         varchar(200) not null,
   primary key (TITRE)
);

/*==============================================================*/
/* Table : MOYENNE                                              */
/*==============================================================*/
create table MOYENNE
(
   MATRICULE            varchar(100) not null,
   NUM_TEL              int not null,
   TITRE                char(100) not null,
   NOM_ELEVE            varchar(50) not null,
   PRENOM_ELEVE         varchar(50) not null,
   CLASSE               char(50) not null,
   MOYENNE              float(30) not null,
   primary key (MATRICULE)
);

/*==============================================================*/
/* Table : PARENT                                               */
/*==============================================================*/
create table PARENT
(
   NUM_TEL              int not null,
   TITRE                char(100) not null,
   NOM                  varchar(50) not null,
   PRENOM               varchar(50) not null,
   EMAIL                char(80) not null,
   MOT_DE_PASSE         varchar(200) not null,
   ATTRIBUT_11          char(10),
   primary key (NUM_TEL)
);

alter table MOYENNE add constraint FK_AJOUTER foreign key (TITRE)
      references ADMIN (TITRE) on delete restrict on update restrict;

alter table MOYENNE add constraint FK_CONSULTER foreign key (NUM_TEL)
      references PARENT (NUM_TEL) on delete restrict on update restrict;

alter table PARENT add constraint FK_CREER foreign key (TITRE)
      references ADMIN (TITRE) on delete restrict on update restrict;

