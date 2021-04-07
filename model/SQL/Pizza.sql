
-- Database Section
-- ________________ 

create database Pizzip;
use Pizzip;


-- Tables Section
-- _____________ 

create table CLIENT (
     IdClient int not null auto_increment,
     Nom char(25) not null,
     Tel char(10) not null,
     Prenom char(20),
     Adresse char(30),
     CodePost char(5),
     Ville char(20),
     constraint ID_CLIENT_ID primary key (IdClient));

create table COMMANDE (
     NumCom int not null auto_increment,
     Date date not null,
     HeureDispo TIME not null,
     TypeEmbal ENUM('carton', 'thermo') default 'carton' not null,
     A_Livrer ENUM('O', 'N') default 'N' not null,
     EtatLivraison ENUM('O', 'N')  default 'N',
     CoutLiv float(6,2),
     IdClient int not null,
     IdLivreur int,
     constraint ID_COMMANDE_ID primary key (NumCom));

create table PIZZA_INGREDIENT (
     NomIngred char(20) not null,
     NomPizza char(25) not null,
     Quant int not null,
     constraint ID_Comporte_ID primary key (NomIngred, NomPizza));

create table COMMANDE_OPTION (
     Num_OF int not null,
     Quant int not null,
     NumCom int not null,
     constraint FKCon_OPT_ID primary key (Num_OF));

create table FOURNISSEUR (
     NomFourn char(25) not null,
     Adresse char(30) not null,
     CodePostal char(5) not null,
     Ville char(20) not null,
     Tel char(12) not null,
     ParDefaut ENUM('O', 'N')  default 'N' not null,
     constraint ID_FOURNISSEUR_ID primary key (NomFourn));

create table INGREDIENT (
     NomIngred char(20) not null,
     Frais char(1) not null,
     Unite char(10) default 'sans' not null,
     StockMin int not null,
     StockReel float(7.2) not null,
     PrixUHT float(5.2) not null,
     Q_A_Com int not null,
     constraint ID_INGREDIENT_ID primary key (NomIngred));

create table LIVREUR (
     IdLivreur int not null auto_increment,
     Nom char(20) not null,
     Prenom char(20) not null,
     Tel char(16) not null,
     constraint ID_LIVREUR_ID primary key (IdLivreur));

create table OPTIONS (
     Num_OF int not null auto_increment,
     IngBase1 char(20) not null,
     IngBase2 char(20),
     IngBase3 char(20),
     IngBase4 char(20),
     IngOpt1 char(20),
     IngOpt2 char(20),
     IngOpt3 char(20),
     IngOpt4 char(20),
     NomPizza char(25) not null,
     constraint ID_OPTION_ID primary key (Num_OF));

create table PIZZA (
     NomPizza char(25) not null,
     Taille char(1),
     NbIngBase int,
     NbIngOpt int,
     PrixUTTC float(5) not null,
     Image char(60),
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
     NbOptMax int default 0,
     constraint ID_PIZZA_ID primary key (NomPizza));

create table FOURNISSEUR_INGREDIENT (
     NomFourn char(25) not null,
     NomIngred char(20) not null,
     constraint ID_Provient_ID primary key (NomFourn, NomIngred));

create table OPTION_INGREDIENT (
     NomIngred char(20) not null,
     Num_OF int not null,
     constraint ID_Utilise_ID primary key (NomIngred, Num_OF));


-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table COMMANDE add constraint ID_COMMANDE_CHK
--     check(exists(select * from COM_OPT
--                  where COM_OPT.NumCom = NumCom)); 

alter table COMMANDE add constraint FKPasse
     foreign key (IdClient)
     references CLIENT (IdClient);

alter table COMMANDE add constraint FKLivre
     foreign key (IdLivreur)
     references LIVREUR (IdLivreur);

alter table PIZZA_INGREDIENT add constraint FKCom_PRO
     foreign key (NomPizza)
     references PIZZA (NomPizza);

alter table PIZZA_INGREDIENT add constraint FKCom_ING
     foreign key (NomIngred)
     references INGREDIENT (NomIngred);

alter table COMMANDE_OPTION add constraint FKCon_OPT_FK
     foreign key (Num_OF)
     references OPTIONS (Num_OF);

alter table COMMANDE_OPTION add constraint FKCon_COM
     foreign key (NumCom)
     references COMMANDE (NumCom);

-- Not implemented
-- alter table OPTIONS add constraint ID_OPTION_CHK
--     check(exists(select * from OPT_INGR
--                  where OPT_INGR.Num_OF = Num_OF)); 

-- Not implemented
-- alter table OPTIONS add constraint ID_OPTION_CHK
--     check(exists(select * from COM_OPT
--                  where COM_OPT.Num_OF = Num_OF)); 

alter table OPTIONS add constraint FKEstChoisi
     foreign key (NomPizza)
     references PIZZA (NomPizza);

-- Not implemented
-- alter table PIZZA add constraint ID_PIZZA_CHK
--     check(exists(select * from Pizza_INGR
--                  where Pizza_INGR.NomPizza = NomPizza)); 

alter table FOURNISSEUR_INGREDIENT add constraint FKPro_ING
     foreign key (NomIngred)
     references INGREDIENT (NomIngred);

alter table FOURNISSEUR_INGREDIENT add constraint FKPro_FOU
     foreign key (NomFourn)
     references FOURNISSEUR (NomFourn);

alter table OPTION_INGREDIENT add constraint FKUti_OPT
     foreign key (Num_OF)
     references OPTIONS (Num_OF);

alter table OPTION_INGREDIENT add constraint FKUti_ING
     foreign key (NomIngred)
     references INGREDIENT (NomIngred);


-- Index Section
-- _____________ 

create unique index ID_CLIENT_IND
     on CLIENT (IdClient);

create unique index ID_COMMANDE_IND
     on COMMANDE (NumCom);

create unique index ID_Comporte_IND
     on PIZZA_INGREDIENT (NomIngred, NomPizza);

create unique index FKCon_OPT_IND
     on COMMANDE_OPTION (Num_OF);

create unique index ID_FOURNISSEUR_IND
     on FOURNISSEUR (NomFourn);

create unique index ID_INGREDIENT_IND
     on INGREDIENT (NomIngred);

create unique index ID_LIVREUR_IND
     on LIVREUR (IdLivreur);

create unique index ID_OPTION_IND
     on OPTIONS (Num_OF);

create unique index ID_PIZZA_IND
     on PIZZA (NomPizza);

create unique index ID_Provient_IND
     on FOURNISSEUR_INGREDIENT (NomFourn, NomIngred);

create unique index ID_Utilise_IND
     on OPTION_INGREDIENT (NomIngred, Num_OF);

