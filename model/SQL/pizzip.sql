-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------

-- Tables Section
-- _____________ 

create table COM_DETAIL (
     Num_Detail int not null,
     Quant int not null,
     NumCom int not null,
     constraint FKCon_DETAIL_ID primary key (Num_Detail))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table COMMANDE (
     NumCom int(5) not null AUTO_INCREMENT,
     NomClient char(25) not null,
     TelClient char(12) not null,
     AdrClient char(30),
     CP_Client char(5) not null,
     VilClient char(20),
     Date date not null,
     HeureDispo date not null,
     TypeEmbal enum('carton','thermo') COLLATE utf8_bin NOT NULL DEFAULT 'carton',
     A_Livrer enum('O','N') COLLATE utf8_bin NOT NULL DEFAULT 'N',
     EtatLivraison char(1) default 'N',
     CoutLiv float(6,2),
     IdLivreur int(5),
     DateArchiv date,
     constraint ID_COMMANDE_ID primary key (NumCom))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table DETAIL_INGR (
     Num_Detail int not null,
     IdIngred int not null,
     constraint ID_Utilise_ID primary key (IdIngred, Num_Detail))
      ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table DETAIL (
     Num_Detail int not null AUTO_INCREMENT,
     NomPizza char(30) not null,
     IngBase1 char(20) not null,
     IngBase2 char(20),
     IngBase3 char(20),
     IngBase4 char(20),
     IngOpt1 char(20),
     IngOpt2 char(20),
     IngOpt3 char(20),
     IngOpt4 char(20),
     IdPizza int not null,
     DateArchiv date,
     constraint ID_DETAIL_ID primary key (Num_Detail))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table FOURN_INGR (
     NomFourn char(25) not null,
     IdIngred int not null,
     PrixUHT float(5,2) not null,
     constraint ID_Provient_ID primary key (NomFourn, IdIngred))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table FOURNISSEUR (
     NomFourn char(25) not null,
     Adresse char(30) not null,
     CodePostal char(5) not null,
     Ville char(20) not null,
     Tel char(12) not null,
     ParDefaut enum('O','N') COLLATE utf8_bin NOT NULL DEFAULT 'N',
     DateArchiv date,
     constraint ID_FOURNISSEUR_ID primary key (NomFourn))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table INGREDIENT (
     IdIngred int not null AUTO_INCREMENT,
     NomIngred char(30) not null,
     Frais enum('O','N') COLLATE utf8_bin NOT NULL DEFAULT 'N',
     Unite char(10) default '"sans"' not null,
     StockMin int not null,
     StockReel float(6,2) not null,
     PrixUHT_Moyen float(5,2) not null,
     Q_A_Com int not null,
     DateArchiv date,
     constraint ID_INGREDIENT_ID primary key (IdIngred))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table LIVREUR (
     IdLivreur int not null AUTO_INCREMENT,
     Nom char(20) not null,
     Prenom char(20) not null,
     Tel char(16) not null,
     NumSS char(15) not null,
     DateArchiv date,
     constraint ID_LIVREUR_ID primary key (IdLivreur))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table PIZZA_INGR (
     IdIngred int not null,
     IdPizza int not null,
     Quant int not null,
     constraint ID_Comporte_ID primary key (IdIngred, IdPizza))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table PIZZA (
     IdPizza int not null AUTO_INCREMENT,
     NomPizza char(20) not null,
     Taille enum('L','XL') COLLATE utf8_bin DEFAULT 'L',
     NbIngBase int,
     NbIngOpt int,
     PrixUHT float(5,2) not null,
     Image char(50),
     IngBase1 char(20) not null,
     IngBase2 char(20),
     IngBase3 char(20),
     IngBase4 char(20),
     IngBase5 char(20),
     IngOpt1 char(20),
     IngOpt2 char(20),
     IngOpt3 char(20),
     IngOpt4 char(20),
     IngOpt5 char(20),
     IngOpt6 char(20),
     NbOptMax int,
     DateArchiv date,
     constraint ID_PIZZA_ID primary key (IdPizza))
     ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- Constraints Section
-- ___________________ 

alter table COM_DETAIL add constraint FKCon_DETAIL_FK
     foreign key (Num_Detail)
     references DETAIL (Num_Detail);

alter table COM_DETAIL add constraint FKCon_COM
     foreign key (NumCom)
     references COMMANDE (NumCom);

alter table COMMANDE add constraint FKLivre
     foreign key (IdLivreur)
     references LIVREUR (IdLivreur);

alter table DETAIL_INGR add constraint FKUti_ING
     foreign key (IdIngred)
     references INGREDIENT (IdIngred);

alter table DETAIL_INGR add constraint FKUti_DETAIL
     foreign key (Num_Detail)
     references DETAIL (Num_Detail);

-- Not implemented
-- alter table DETAIL add constraint ID_DETAIL_CHK
--    check(exists(select * from DETAIL_INGR
--                 where DETAIL_INGR.Num_Detail = Num_Detail)); 

-- Not implemented
-- alter table DETAIL add constraint ID_DETAIL_CHK
--    check(exists(select * from COM_DETAIL
--                 where COM_DETAIL.Num_Detail = Num_Detail));

alter table DETAIL add constraint FKEstChoisi
     foreign key (IdPizza)
     references PIZZA (IdPizza);

alter table FOURN_INGR add constraint FKPro_ING
     foreign key (IdIngred)
     references INGREDIENT (IdIngred);

alter table FOURN_INGR add constraint FKPro_FOU
     foreign key (NomFourn)
     references FOURNISSEUR (NomFourn);

alter table PIZZA_INGR add constraint FKCom_PRO
     foreign key (IdPizza)
     references PIZZA (IdPizza);

alter table PIZZA_INGR add constraint FKCom_ING
     foreign key (IdIngred)
     references INGREDIENT (IdIngred);

-- Not implemented
-- alter table PIZZA add constraint ID_PIZZA_CHK
--    check(exists(select * from PIZZA_INGR
--                 where PIZZA_INGR.IdPizza = IdPizza)); 


-- Index Section
-- _____________ 

create unique index FKCon_DETAIL_IND
     on COM_DETAIL (Num_Detail);

create unique index ID_COMMANDE_IND
     on COMMANDE (NumCom);

create unique index ID_Utilise_IND
     on DETAIL_INGR (IdIngred, Num_Detail);

create unique index ID_DETAIL_IND
     on DETAIL (Num_Detail);

create unique index ID_Provient_IND
     on FOURN_INGR (NomFourn, IdIngred);

create unique index ID_FOURNISSEUR_IND
     on FOURNISSEUR (NomFourn);

create unique index ID_INGREDIENT_IND
     on INGREDIENT (IdIngred);

create unique index ID_LIVREUR_IND
     on LIVREUR (IdLivreur);

create unique index ID_Comporte_IND
     on PIZZA_INGR (IdIngred, IdPizza);

create unique index ID_PIZZA_IND
     on PIZZA (IdPizza);

