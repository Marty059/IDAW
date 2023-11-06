/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  27/10/2023 10:36:56                      */
/*==============================================================*/




/*==============================================================*/
/* Table : ALIMENTS                                             */
/*==============================================================*/
create table ALIMENTS
(
   ID_ALIMENT           int not null,
   ID_TYPE              int not null,
   NOM_ALIMENT          varchar(100),
   primary key (ID_ALIMENT)
);

/*==============================================================*/
/* Index : NOM_ALIMENT                                          */
/*==============================================================*/
create index NOM_ALIMENT on ALIMENTS
(
   NOM_ALIMENT
);

/*==============================================================*/
/* Table : COMPOSITION_ALIMENT                                  */
/*==============================================================*/
create table COMPOSITION_ALIMENT
(
   ID_ALIMENT           int not null,
   ID_NUTRIMENT         int not null,
   QUANTITE_POUR_100G   float,
   primary key (ID_ALIMENT, ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : COMPOSITION_PLAT                                     */
/*==============================================================*/
create table COMPOSITION_PLAT
(
   ID_PLAT              int not null,
   ID_ALIMENT           int not null,
   POURCENTAGE          float,
   primary key (ID_PLAT, ID_ALIMENT)
);

/*==============================================================*/
/* Table : HISTORIQUE                                           */
/*==============================================================*/
create table HISTORIQUE
(
   ID_USER              int not null,
   ID_PLAT              int not null,
   DATE                 date,
   primary key (ID_USER, ID_PLAT)
);

/*==============================================================*/
/* Table : NUTRIMENTS                                           */
/*==============================================================*/
create table NUTRIMENTS
(
   ID_NUTRIMENT         int not null,
   NOM_NUTRIMENT        varchar(100),
   primary key (ID_NUTRIMENT)
);

/*==============================================================*/
/* Index : NOM_NUTRIMENT                                        */
/*==============================================================*/
create index NOM_NUTRIMENT on NUTRIMENTS
(
   NOM_NUTRIMENT
);

/*==============================================================*/
/* Table : PLATS                                                */
/*==============================================================*/
create table PLATS
(
   ID_PLAT              int not null,
   NOM_PLAT             varchar(100),
   primary key (ID_PLAT)
);

/*==============================================================*/
/* Index : NOM_PLAT                                             */
/*==============================================================*/
create index NOM_PLAT on PLATS
(
   NOM_PLAT
);

/*==============================================================*/
/* Table : PRATIQUE_SPORTIVE                                    */
/*==============================================================*/
create table PRATIQUE_SPORTIVE
(
   ID_PRATIQUE          int not null,
   NIVEAU               varchar(100),
   primary key (ID_PRATIQUE)
);

/*==============================================================*/
/* Table : TYPE_ALIMENT                                         */
/*==============================================================*/
create table TYPE_ALIMENT
(
   ID_TYPE              int not null,
   NOM_TYPE             varchar(100),
   primary key (ID_TYPE)
);

/*==============================================================*/
/* Table : USERS                                                */
/*==============================================================*/
create table USERS
(
   ID_USER              int not null,
   ID_PRATIQUE          int not null,
   NOM                  varchar(100),
   PRENOM               varchar(100),
   GENRE                varchar(100),
   TAILLE               float,
   POIDS                float,
   AGE                  int,
   LOGIN                varchar(100),
   MOT_DE_PASSE         varchar(100),
   primary key (ID_USER)
);


/*==============================================================*/
/* Index : NOM                                                  */
/*==============================================================*/
create index NOM on USERS
(
   NOM
);

/*==============================================================*/
/* Index : LOGIN                                                */
/*==============================================================*/
create index LOGIN on USERS
(
   LOGIN
);

alter table ALIMENTS add constraint FK_ASSOCIATION_ALIMENT foreign key (ID_TYPE)
      references TYPE_ALIMENT (ID_TYPE) on delete restrict on update restrict;

alter table COMPOSITION_ALIMENT add constraint FK_COMPOSITION_ALIMENT foreign key (ID_ALIMENT)
      references ALIMENTS (ID_ALIMENT) on delete restrict on update restrict;

alter table COMPOSITION_ALIMENT add constraint FK_COMPOSITION_ALIMENT2 foreign key (ID_NUTRIMENT)
      references NUTRIMENTS (ID_NUTRIMENT) on delete restrict on update restrict;

alter table COMPOSITION_PLAT add constraint FK_COMPOSITION_PLAT foreign key (ID_PLAT)
      references PLATS (ID_PLAT) on delete restrict on update restrict;

alter table COMPOSITION_PLAT add constraint FK_COMPOSITION_PLAT2 foreign key (ID_ALIMENT)
      references ALIMENTS (ID_ALIMENT) on delete restrict on update restrict;

alter table HISTORIQUE add constraint FK_HISTORIQUE foreign key (ID_USER)
      references USERS (ID_USER) on delete restrict on update restrict;

alter table HISTORIQUE add constraint FK_HISTORIQUE2 foreign key (ID_PLAT)
      references PLATS (ID_PLAT) on delete restrict on update restrict;

alter table USERS add constraint FK_ASSOCIATION_SPORT foreign key (ID_PRATIQUE)
      references PRATIQUE_SPORTIVE (ID_PRATIQUE) on delete restrict on update restrict;

--création nutriment--
INSERT INTO `nutriments` (`ID_NUTRIMENT`, `NOM_NUTRIMENT`) VALUES
(6, 'calcium'),
(3, 'fat'),
(4, 'fiber'),
(7, 'iron'),
(10, 'potassium'),
(1, 'proteins'),
(2, 'sugars'),
(8, 'vitamin-a'),
(5, 'vitamin-c'),
(9, 'vitamin-d');
--insertion type d'aliment--
INSERT INTO `type_aliment` (`ID_TYPE`, `NOM_TYPE`) VALUES
(1, 'unsweetened-beverages'),
(2, 'vegetables'),
(3, 'cereals'),
(4, 'poultry');
--insertion aliment--
INSERT INTO `aliments` (`ID_ALIMENT`, `ID_TYPE`, `NOM_ALIMENT`, `Kcal`) VALUES
(1, 4, 'Poulet', 106);
--composition des aliments--
INSERT INTO `composition_aliment` (`ID_ALIMENT`, `ID_NUTRIMENT`, `QUANTITE_POUR_100G`) VALUES
(1, 1, 23),
(1, 3, 1.5);