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