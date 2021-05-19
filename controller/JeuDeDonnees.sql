


/* Table LIVREUR */
INSERT INTO `LIVREUR`(`Nom`, `Prenom`, `Tel`, `NumSS`) VALUES
('DURANT','Michel','0612121212','12345671002021'),
('DUPONT','Thierry','0637373737','1234567100202'),
('PORAUT','Valérie','0655553333','2234567100203');

/* Table INGREDIENT */
INSERT INTO `INGREDIENT` (`IdIngred`,`NomIngred`, `Frais`, `Unite`, `StockMin`, `StockReel`, `PrixUHT_Moyen`, `Q_A_Com`) VALUES
(1,'Ananas', 'N', 'sans', 3, 4.00, 3.50, 0),
(2,'Oignon', 'O', 'sans', 50, 51.00, 0.50, 30),
(3,'Champignon', 'O', 'sans', 99, 123.00, 0.85, 10),
(4,'Lardon', 'N', 'sans', 50, 65.00, 1.50, 0),
(5,'Jambon', 'N', 'sans', 50, 200, 1.50, 0),
(6,'Mozarella', 'N', 'sans', 5, 6.00, 1.00, 1),
(7,'Chèvre', 'O', 'gramme', 10, 15.00, 2.50, 1),
(8,'Bleu', 'O', 'gramme', 300, 700.00, 4.25, 1),
(9,'Tomate', 'O', 'sans', 18, 20.00, 1.50, 1),
(10,'Boursin', 'N', 'gramme', 200, 210.00, 3.25, 200),
(11,'Crème fraîche', 'N', 'sans', 180, 105.00, 3.00, 0),
(12,'Comté', 'N', 'gramme', 100, 150.00, 18.00, 200),
(13,'Cheddar', 'N', 'gramme', 100, 170.00, 17.00, 200),
(14,'Sauce tomate', 'O', 'sans', 100, 75.00, 2.85, 0);
(15,'Basilic', 'N', 'gramme', 50, 90.00, 1.20, 30);

/* Table PIZZA */
INSERT INTO `PIZZA` (`IdPizza`,`NomPizza`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpt1`, `IngOpt2`, `IngOpt3`, `IngOpt4`, `IngOpt5`, `IngOpt6`, `NbOptMax`) VALUES
(1,'4 Fromages','L',6,2,15.00,NULL,'Sauce tomate','Cheddar','Comté','Bleu','Mozzarella','Basilic','Chèvre','Boursin', NULL, NULL, NULL, NULL),
(2,'pizza_1', 'L', 2, 2, 13.00, NULL, 'Tomate', 'Champignon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3,'Reine', 'L', 3, 3, 16.00, NULL, 'Tomate', 'Jambon', 'Champignon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4,'pizza_3', 'L', 3, NULL, 16.00, NULL, 'Tomate', 'Oignon', 'Champignon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5,'pizza_4', 'XL', 2, NULL, 10.00, NULL, 'Tomate', 'Lardon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6,'pizza_5', 'XL', 4, 1, 17.00, NULL, 'Tomate', 'Champignon', 'Oignon', 'Lardon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/* Table PIZZA_INGR */
INSERT INTO `PIZZA_INGR`(`IdPizza`, `IdIngred`, `Quant`) VALUES
(1,14,50),
(1,13,50),
(1,12,50),
(1,8,50),
(1,6,50),
(1,15,50),
(1,7,50),
(1,10,50),
(2,9,30),
(2,3,30),
(3,9,70),
(3,5,70),
(3,3,70),
(4,9,80),
(4,2,80),
(4,3,80),
(5,9,110),
(5,4,110),
(6,9,60),
(6,3,60),
(6,2,60),
(6,4,60);