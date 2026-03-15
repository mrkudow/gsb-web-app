-- =====================================================================================================
-- Script du 10/03/2024 - SGBD cible : MariaDb
-- > Le jeu de caractères utilisé est utf8.
-- =====================================================================================================
-- set names 'utf8';
DROP DATABASE IF EXISTS gsbbdcr;
CREATE DATABASE `gsbbdcr` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gsbbdcr;
-- ----------------------------------------------------------------------------------------------
create table FAMILLE(fCode VARCHAR(3) not null,fLibelle VARCHAR(83),primary key(fCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
-- 
create table MEDICAMENT(mDepotLegal VARCHAR(10) not null,mNomCommercial VARCHAR(25),mComposition VARCHAR(255),mEffets VARCHAR(255),mContreIndications VARCHAR(255),mPrix FLOAT,fCode VARCHAR(3) not null,primary key(mDepotLegal)) ENGINE=INNODB DEFAULT CHARSET=utf8;
--
create table PRATICIEN(pNum INT not null,pNom VARCHAR(25),pPrenom VARCHAR(30),pRue VARCHAR(50),pCP VARCHAR(5),pVille VARCHAR(32),pCoefNotoriete FLOAT,region SMALLINT,tCode VARCHAR(2) not null,primary key(pNum)) ENGINE=INNODB DEFAULT CHARSET=utf8;
-- 
create table REGION(rCode SMALLINT not null,sCode VARCHAR(1) not null,rNom VARCHAR(50),primary key(rCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
-- 
create table SECTEUR(sCode VARCHAR(1) not null,sLibelle VARCHAR(15),primary key(sCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
-- 
create table TYPE_PRATICIEN(tCode VARCHAR(2) not null,tLibelle VARCHAR(31),tLieu VARCHAR(31),primary key(tCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
--
create table VISITEUR(viNum INT AUTO_INCREMENT,viNom VARCHAR(25), viPrenom VARCHAR(30), viMdp VARCHAR(12), viLabo INT, viRegion SMALLINT, primary key (viNum)) ENGINE=INNODB DEFAULT CHARSET=utf8;
--
create table VISITE(vCode INT AUTO_INCREMENT, vDate DATETIME, vVisiteur INT, vPraticien INT, vRapport TEXT, vMotif VARCHAR(30), primary key(vCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
--
create table LABO(lCode INT AUTO_INCREMENT, lLibelle VARCHAR(255), lChefVente INT, primary key(lCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
--
create table RESPONSABLE(reCode INT AUTO_INCREMENT, reNom VARCHAR(25), rePrenom VARCHAR(30), reMdp VARCHAR(12), reRegion SMALLINT, primary key(reCode)) ENGINE=INNODB DEFAULT CHARSET=utf8;
--
create table PRESENTATION(prVisite INT, prMedicament VARCHAR(10), prQteEchantillon INT, primary key (prVisite, prMedicament)) ENGINE=INNODB DEFAULT CHARSET=utf8;
-- ----------------------------------------------------------------------------------------------
-- 
insert into FAMILLE(fCode,fLibelle) values
     ('AA','Antalgiques en association'),
     ('AAA','Antalgiques antipyrétiques en association'),
     ('AAC','Antidépresseur d''action centrale'),
     ('AAH','Antivertigineux antihistaminique H1'),
     ('ABA','Antibiotique antituberculeux'),
     ('ABC','Antibiotique antiacnéique local'),
     ('ABP','Antibiotique de la famille des béta-lactamines pénicilline A'),
     ('AFC','Antibiotique de la famille des cyclines'),
     ('AFM','Antibiotique de la famille des macrolides'),
     ('AH','Antihistaminique H1 local'),
     ('AIM','Antidépresseur imipraminique tricyclique'),
     ('AIN','Antidépresseur inhibiteur sélectif de la recapture de la sérotonine'),
     ('ALO','Antibiotique local ORL'),
     ('ANS','Antidépresseur IMAO non sélectif'),
     ('AO','Antibiotique ophtalmique'),
     ('AP','Antipsychotique normothymique'),
     ('AUM','Antibiotique urinaire minute'),
     ('CRT','Corticoïde, antibiotique et antifongique à  usage local'),
     ('HYP','Hypnotique antihistaminique'),
     ('PSA','Psychostimulant, antiasthénique');
-- ----------------------------------------------------------------------------------------------
insert into MEDICAMENT(mDepotLegal,mNomCommercial,mComposition,mEffets,mContreIndications,mPrix,fCode) values
     ('3MYC7','TRIMYCINE','Triamcinolone (acétonide) + Néomycine + Nystatine','Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, d''infections de la peau ou de parasitisme non traités, d''acné. Ne pas appliquer sur une plaie, ni sous un pansement occlusif.',null,'CRT'),
     ('ADIMOL9','ADIMOL','Amoxicilline + Acide clavulanique','Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas d''allergie aux pénicillines ou aux céphalosporines.',null,'ABP'),
     ('AMOPIL7','AMOPIL','Amoxicilline','Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas d''allergie aux pénicillines. Il doit être administré avec prudence en cas d''allergie aux céphalosporines.',null,'ABP'),
     ('AMOX45','AMOXAR','Amoxicilline','Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.','La prise de ce médicament peut rendre positifs les tests de dépistage du dopage.',null,'ABP'),
     ('AMOXIG12','AMOXI Gé','Amoxicilline','Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas d''allergie aux pénicillines. Il doit être administré avec prudence en cas d''allergie aux céphalosporines.',null,'ABP'),
     ('APATOUX22','APATOUX Vitamine C','Tyrothricine + Tétracaïne + Acide ascorbique (Vitamine C)','Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, en cas de phénylcétonurie et chez l''enfant de moins de 6 ans.',null,'ALO'),
     ('BACTIG10','BACTIGEL','Erythromycine','Ce médicament est utilisé en application locale pour traiter l''acné et les infections cutanées bactériennes associées.','Ce médicament est contre-indiqué en cas d''allergie aux antibiotiques de la famille des macrolides ou des lincosanides.',null,'ABC'),
     ('BACTIV13','BACTIVIL','Erythromycine','Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas d''allergie aux macrolides (dont le chef de file est l''érythromycine).',null,'AFM'),
     ('BITALV','BIVALIC','Dextropropoxyphène + Paracétamol','Ce médicament est utilisé pour traiter les douleurs d''intensité modérée ou intense.','Ce médicament est contre-indiqué en cas d''allergie aux médicaments de cette famille, d''insuffisance hépatique ou d''insuffisance rénale.',null,'AAA'),
     ('CARTION6','CARTION','Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol','Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.','Ce médicament est contre-indiqué en cas de troubles de la coagulation (tendances aux hémorragies), d''ulcère gastroduodénal, maladies graves du foie.',null,'AAA'),
     ('CLAZER6','CLAZER','Clarithromycine','Ce médicament est utilisé pour traiter des infections bactériennes spécifiques. Il est également utilisé dans le traitement de l''ulcère gastro-duodénal, en association avec d''autres médicaments.','Ce médicament est contre-indiqué en cas d''allergie aux macrolides (dont le chef de file est l''érythromycine).',null,'AFM'),
     ('DEPRIL9','DEPRAMIL','Clomipramine','Ce médicament est utilisé pour traiter les épisodes dépressifs sévères, certaines douleurs rebelles, les troubles obsessionnels compulsifs et certaines énurésies chez l''enfant.','Ce médicament est contre-indiqué en cas de glaucome ou d''adénome de la prostate, d''infarctus récent, ou si vous avez reà§u un traitement par IMAO durant les 2 semaines précédentes ou en cas d''allergie aux antidépresseurs imipraminiques.',null,'AIM'),
     ('DIMIRTAM6','DIMIRTAM','Mirtazapine','Ce médicament est utilisé pour traiter les épisodes dépressifs sévères.','La prise de ce produit est contre-indiquée en cas de d''allergie à  l''un des constituants.',null,'AAC'),
     ('DOLRIL7','DOLORIL','Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol','Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.','Ce médicament est contre-indiqué en cas d''allergie au paracétamol ou aux salicylates.',null,'AAA'),
     ('DORNOM8','NORMADOR','Doxylamine','Ce médicament est utilisé pour traiter l''insomnie chez l''adulte.','Ce médicament est contre-indiqué en cas de glaucome, de certains troubles urinaires (rétention urinaire) et chez l''enfant de moins de 15 ans.',null,'HYP'),
     ('EQUILARX6','EQUILAR','Méclozine','Ce médicament est utilisé pour traiter les vertiges et pour prévenir le mal des transports.','Ce médicament ne doit pas être utilisé en cas d''allergie au produit, en cas de glaucome ou de rétention urinaire.',null,'AAH'),
     ('EVILR7','EVEILLOR','Adrafinil','Ce médicament est utilisé pour traiter les troubles de la vigilance et certains symptomes neurologiques chez le sujet agé.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants.',null,'PSA'),
     ('INSXT5','INSECTIL','Diphénydramine','Ce médicament est utilisé en application locale sur les piqûres d''insecte et l''urticaire.','Ce médicament est contre-indiqué en cas d''allergie aux antihistaminiques.',null,'AH'),
     ('JOVAI8','JOVENIL','Josamycine','Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.','Ce médicament est contre-indiqué en cas d''allergie aux macrolides (dont le chef de file est l''érythromycine).',null,'AFM'),
     ('LIDOXY23','LIDOXYTRACINE','Oxytétracycline +Lidocaïne','Ce médicament est utilisé en injection intramusculaire pour traiter certaines infections spécifiques.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants. Il ne doit pas être associé aux rétinoïdes.',null,'AFC'),
     ('LITHOR12','LITHORINE','Lithium','Ce médicament est indiqué dans la prévention des psychoses maniaco-dépressives ou pour traiter les états maniaques.','Ce médicament ne doit pas être utilisé si vous êtes allergique au lithium. Avant de prendre ce traitement, signalez à  votre médecin traitant si vous souffrez d''insuffisance rénale, ou si vous avez un régime sans sel.',null,'AP'),
     ('PARMOL16','PARMOCODEINE','Codéine + Paracétamol','Ce médicament est utilisé pour le traitement des douleurs lorsque des antalgiques simples ne sont pas assez efficaces.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, chez l''enfant de moins de 15 Kg, en cas d''insuffisance hépatique ou respiratoire, d''asthme, de phénylcétonurie et chez la femme qui allaite.',null,'AA'),
     ('PHYSOI8','PHYSICOR','Sulbutiamine','Ce médicament est utilisé pour traiter les baisses d''activité physique ou psychique, souvent dans un contexte de dépression.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants.',null,'PSA'),
     ('PIRIZ8','PIRIZAN','Pyrazinamide','Ce médicament est utilisé, en association à  d''autres antibiotiques, pour traiter la tuberculose.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, d''insuffisance rénale ou hépatique, d''hyperuricémie ou de porphyrie.',null,'ABA'),
     ('POMDI20','POMADINE','Bacitracine','Ce médicament est utilisé pour traiter les infections oculaires de la surface de l''oeil.','Ce médicament est contre-indiqué en cas d''allergie aux antibiotiques appliqués localement.',null,'AO'),
     ('TROXT21','TROXADET','Paroxétine','Ce médicament est utilisé pour traiter la dépression et les troubles obsessionnels compulsifs. Il peut également être utilisé en prévention des crises de panique avec ou sans agoraphobie.','Ce médicament est contre-indiqué en cas d''allergie au produit.',null,'AIN'),
     ('TXISOL22','TOUXISOL Vitamine C','Tyrothricine + Acide ascorbique (Vitamine C)','Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.','Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants et chez l''enfant de moins de 6 ans.',null,'ALO'),
     ('URIEG6','URIREGUL','Fosfomycine trométamol','Ce médicament est utilisé pour traiter les infections urinaires simples chez la femme de moins de 65 ans.','La prise de ce médicament est contre-indiquée en cas d''allergie à  l''un des constituants et d''insuffisance rénale.',null,'AUM');
-- ----------------------------------------------------------------------------------------------

-- ----------------------------------------------------------------------------------------------
insert into PRATICIEN(pNum,pNom,pPrenom,pRue,pCP,pVille,pCoefNotoriete,region,tCode) values
     (13,'Morel','Catherine','21 rue Chateaubriand','75000','PARIS',379.57,11,'PS'),
     (31,'Rosenstech','Geneviève','27 rue Auvergne','75000','PARIS',366.82,11,'MH'),
     (46,'Riou','Line','43 bd Gén Vanier','77000','MARNE LA VALLEE',193.25,11,'MH'),
     (53,'Vittorio','Myriam','3 pl Champlain','94000','BOISSY SAINT LEGER',356.23,11,'PS'),
     (57,'Robert','Pascal','31 rue St Jean','93000','BOBIGNY',162.41,11,'MV'),
     (2,'Gosselin','Albert','13 rue Devon','41000','BLOIS',307.49,24,'MV'),
     (14,'Guivarch','Chantal','4 av Gén Laperrine','45000','ORLEANS',114.56,24,'PH'),
     (24,'Goussard','Emmanuel','9 rue Demolombe','41000','BLOIS',40.72,24,'PH'),
     (40,'Dennel','Jean-Louis','7 pl St Gilles','28000','CHARTRES',550.69,24,'PO'),
     (43,'Comoz','Jean-Pierre','35 rue Auguste Lechesne','18000','BOURGES',340.35,24,'PS'),
     (61,'Gandon','Patrick','47 av Robert Schuman','37000','TOURS',599.06,24,'MH'),
     (3,'Delahaye','André','36 av 6 Juin','25000','BESANCON',185.79,27,'PS'),
     (29,'Martin','Frédéric','Bât A 90 rue Bayeux','70000','VESOUL',506.06,27,'PH'),
     (30,'Marie','Frédérique','172 rue Caponière','70000','VESOUL',313.31,27,'PO'),
     (39,'Maury','Jean-François','5 rue Pierre Girard','71000','CHALON SUR SAONE',13.73,27,'PH'),
     (49,'Goessens','Marc','6 av 6 Juin','39000','DOLE',548.57,27,'PH'),
     (52,'Dauverne','Marie-Christine','69 av Charlemagne','21000','DIJON',281.05,27,'MV'),
     (36,'Mosquet','Isabelle','22 rue Jules Verne','76000','ROUEN',77.1,28,'MH'),
     (42,'Chemery','Jean-Pierre','51 pl Ancienne Boucherie','14000','CAEN',396.58,28,'MV'),
     (50,'Laforge','Marc','5 résid Prairie','50000','SAINT LO',265.05,28,'PO'),
     (76,'Leroy','Soazig','45 rue Boutiques','61000','ALENCON',570.67,28,'MH'),
     (78,'Delposen','Sylvain','39 av 6 Juin','27000','DREUX',292.01,28,'PS'),
     (4,'Leroux','André','47 av Robert Schuman','60000','BEAUVAIS',172.04,32,'PH'),
     (6,'Mouel','Anne','27 rue Auvergne','80000','AMIENS',45.2,32,'MH'),
     (10,'Lerat','Bernard','31 rue St Jean','59000','LILLE',257.79,32,'PO'),
     (35,'Leveneur','Hugues','7 pl St Gilles','62000','ARRAS',7.39,32,'PO'),
     (41,'Ain','Jean-Pierre','4 résid Olympia','2000','LAON',5.59,32,'MH'),
     (79,'Rault','Sylvie','15 bd Richemond','2000','SOISSON',526.6,32,'PH'),
     (8,'Marcouiller','Arnaud','31 rue St Jean','68000','MULHOUSE',396.52,44,'PS'),
     (11,'Marçais-Lefebvre','Bertrand','86Bis rue Basse','67000','STRASBOURG',450.96,44,'MH'),
     (12,'Boscher','Bruno','94 rue Falaise','10000','TROYES',356.14,44,'MV'),
     (27,'Lefebvre','Frédéric','2 pl Wurzburg','55000','VERDUN',573.63,44,'MV'),
     (34,'Blanchais','Guy','30 rue Authie','8000','SEDAN',502.48,44,'PH'),
     (48,'Lebrun','Lucette','178 rue Auge','54000','NANCY',410.41,44,'PS'),
     (54,'Lapasset','Nhieu','31 av 6 Juin','52000','CHAUMONT',107,44,'PH'),
     (60,'Lecuirot','Patrice','résid St Pères 55 rue Pigacière','54000','NANCY',239.66,44,'PO'),
     (63,'Boireaux','Philippe','14 av Thiès','10000','CHALON EN CHAMPAGNE',454.48,44,'PS'),
     (71,'Leménager','Pierre','39 av 6 Juin','57000','METZ',118.7,44,'MH'),
     (75,'Mabire','Roland','11 rue Boutiques','67000','STRASBOURG',422.39,44,'PO'),
     (80,'Renouf','Sylvie','98 bd Mar Lyautey','88000','EPINAL',425.24,44,'PO'),
     (1,'Notini','Alain','114 rue Authie','85000','LA ROCHE SUR YON',290.03,52,'MH'),
     (19,'Guenon','Dominique','98 bd Mar Lyautey','44000','NANTES',175.89,52,'PH'),
     (21,'Houchard','Eliane','9 rue Demolombe','49100','ANGERS',436.96,52,'MH'),
     (51,'Millereau','Marc','36 av 6 Juin','72000','LA FERTE BERNARD',430.42,52,'MH'),
     (58,'Jean','Pascale','114 rue Authie','49100','SAUMUR',375.52,52,'PS'),
     (66,'Grigy','Philippe','15 rue Mélingue','44000','CLISSON',285.1,52,'MH'),
     (86,'Laurent','Younès','34 rue Demolombe','53000','MAYENNE',496.1,52,'MH'),
     (7,'Desgranges-Lentz','Antoine','1 rue Albert de Mun','29000','MORLAIX',20.07,53,'MV'),
     (18,'Gaffé','Dominique','9 av 1ère Armée Française','35000','RENNES',213.4,53,'PS'),
     (22,'Desmons','Elisabeth','51 rue Bernières','29000','QUIMPER',281.17,53,'MV'),
     (23,'Flament','Elisabeth','11 rue Pasteur','35000','RENNES',315.6,53,'PS'),
     (28,'Lemée','Frédéric','29 av 6 Juin','56000','VANNES',326.4,53,'PS'),
     (44,'Desfaudais','Jean-Pierre','7 pl St Gilles','29000','BREST',71.76,53,'PH'),
     (20,'Prévot','Dominique','29 rue Lucien Nelle','87000','LIMOGES',151.36,75,'PO'),
     (25,'Desprez','Eric','9 rue Vaucelles','33000','BORDEAUX',406.85,75,'PO'),
     (26,'Coste','Evelyne','29 rue Lucien Nelle','19000','TULLE',441.87,75,'MH'),
     (32,'Pontavice','Ghislaine','8 rue Gaillon','86000','POITIERS',265.58,75,'MV'),
     (33,'Leveneur-Mosquet','Guillaume','47 av Robert Schuman','64000','PAU',184.97,75,'PS'),
     (45,'Phan','JérÃ´me','9 rue Clos Caillet','79000','NIORT',451.61,75,'PO'),
     (47,'Chubilleau','Louis','46 rue Eglise','17000','SAINTES',202.07,75,'MV'),
     (55,'Plantet-Besnier','Nicole','10 av 1ère Armée Française','86000','CHATELLEREAULT',369.94,75,'PO'),
     (69,'Dechâtre','Pierre','63 av Thiès','23000','MONTLUCON',253.75,75,'PH'),
     (70,'Goessens','Pierre','22 rue Jean Romain','40000','MONT DE MARSAN',426.19,75,'PO'),
     (85,'Duchemin-Laniel','Véronique','130 rue St Jean','33000','LIBOURNE',265.61,75,'PO'),
     (5,'Desmoulins','Anne','31 rue St Jean','30000','NIMES',94.75,76,'PO'),
     (9,'Dupuy','Benoit','9 rue Demolombe','34000','MONTPELLIER',395.66,76,'PH'),
     (17,'Cauchy','Denis','5 av Ste Thérèse','11000','NARBONNE',458.82,76,'MV'),
     (64,'Cendrier','Philippe','7 pl St Gilles','12000','RODEZ',164.16,76,'PH'),
     (65,'Duhamel','Philippe','114 rue Authie','34000','MONTPELLIER',98.62,76,'PO'),
     (67,'Linard','Philippe','1 rue Albert de Mun','81000','ALBI',486.3,76,'MV'),
     (68,'Lozier','Philippe','8 rue Gaillon','31000','TOULOUSE',48.4,76,'PS'),
     (72,'Née','Pierre','39 av 6 Juin','82000','MONTAUBAN',72.54,76,'MV'),
     (73,'Guyot','Pierre-Laurent','43 bd Gén Vanier','48000','MENDE',352.31,76,'PS'),
     (77,'Guyot','Stéphane','26 rue Hérouville','46000','FIGEAC',28.85,76,'MV'),
     (84,'Bobichon','Tristan','219 rue Caponière','9000','FOIX',218.36,76,'PH'),
     (37,'Giraudon','Jean-Christophe','1 rue Albert de Mun','38100','VIENNE',92.62,84,'MV'),
     (38,'Marie','Jean-Claude','26 rue Hérouville','69000','LYON',120.1,84,'PS'),
     (56,'Chubilleau','Pascal','3 rue Hastings','15000','AURRILLAC',290.75,84,'MH'),
     (62,'Mirouf','Patrick','22 rue Puits Picard','74000','ANNECY',458.42,84,'MV'),
     (81,'Alliet-Grach','Thierry','14 av Thiès','7000','PRIVAS',451.31,84,'MH'),
     (82,'Bayard','Thierry','92 rue Falaise','42000','SAINT ETIENNE',271.71,84,'MV'),
     (83,'Gauchet','Thierry','7 rue Desmoueux','38100','GRENOBLE',406.1,84,'PS'),
     (15,'Bessin-Grosdoit','Christophe','92 rue Falaise','6000','NICE',222.06,93,'PO'),
     (16,'Rossa','Claire','14 av Thiès','6000','NICE',529.78,93,'MH'),
     (59,'Chanteloube','Patrice','14 av Thiès','13000','MARSEILLE',478.01,93,'PH'),
     (74,'Chauchard','Roger','9 rue Vaucelles','13000','MARSEILLE',552.19,93,'PH');
-- ----------------------------------------------------------------------------------------------
insert into REGION(rCode,sCode,rNom) values
     (11,'P','ILE-DE-FRANCE'),
     (24,'P','CENTRE-VAL DE LOIRE'),
     (27,'E','BOURGOGNE-FRANCHE-COMTE'),
     (28,'O','NORMANDIE'),
     (32,'N','HAUTS-DE-FRANCE'),
     (44,'E','ALSACE-CHAMPAGNE-ARDENNE-LORRAINE'),
     (52,'O','PAYS DE LA LOIRE'),
     (53,'O','BRETAGNE'),
     (75,'S','AQUITAINE-LIMOUSIN-POITOU-CHARENTES'),
     (76,'S','LANGUEDOC-ROUSSILLON-MIDI-PYRENEES'),
     (84,'E','AUVERGNE-RHONE-ALPES'),
     (93,'S','PROVENCE-ALPES-COTE D''AZUR'),
     (94,'S','CORSE'),
     (1,'P','GUADELOUPE'),
     (2,'P','MARTINIQUE'),
     (3,'P','GUYANE'),
     (4,'P','LA REUNION'),
     (6,'P','MAYOTTE');
-- ----------------------------------------------------------------------------------------------
insert into SECTEUR(sCode,sLibelle) values
     ('E','Est'),
     ('N','Nord'),
     ('O','Ouest'),
     ('P','Paris centre'),
     ('S','Sud');
-- ----------------------------------------------------------------------------------------------
insert into TYPE_PRATICIEN(tCode,tLibelle,tLieu) values
     ('MH','Médecin Hospitalier','Hopital ou clinique'),
     ('MV','Médecine de Ville','Cabinet'),
     ('PH','Pharmacien Hospitalier','Hopital ou clinique'),
     ('PO','Pharmacien Officine','Pharmacie'),
     ('PS','Personnel de santé','Centre paramédical');
     -- ----------------------------------------------------------------------------------------------
insert into VISITEUR(viNum,viNom,viPrenom, viMdp, viLabo, viRegion) values
     (1,'Erreip', 'Pierre',"jGBh50bCgX", 1, 53),
     (2, 'Kcirtap','Patrick',"euCy9bJfqb", 1, 44),
     (3,'Ennaej','Jeanne',"cmLkC8CfoH", 3, 3);
     -- ----------------------------------------------------------------------------------------------
insert into VISITE(vCode,vDate,vVisiteur,vPraticien,vRapport,vMotif) values
     (1,'2022-05-14 15:00:00',1,6,"Plutôt moyen","Périodicité"),
     (2,'2022-12-28 14:00:00',1,6,"Excellent","Informations complémentaires"),
     (3,'2023-02-07 16:00:00',1,6,"Peut mieux faire","Nouveau produit");
     -- ----------------------------------------------------------------------------------------------
insert into LABO(lCode,lLibelle,lChefVente) values
     (1,'Laboratoire Alpha',1),
     (2,'Laboratoire Beta',3),
     (3,'Laboratoire Zeta',4);
     -- ----------------------------------------------------------------------------------------------
insert into RESPONSABLE(reCode,reNom,rePrenom,reMdp,reRegion) values
     (1,'Naej','Jean',"GXVNuS4L5G",11),
     (2,'Trebor','Robert',"mb9uSNXCX9", 24),
     (3,'Dranreb', 'Bernard',"oicJYUOmb1", 53),
     (4,'Ettedor', 'Rodette',"k2oCDpBIGD", 1),
     (5,'Ettenneaj', 'Jeannette',"aXA5EFGZ2o", 6);
     -- ----------------------------------------------------------------------------------------------
insert into PRESENTATION(prVisite,prMedicament,prQteEchantillon) values
     (1,'ADIMOL9',3),
     (2,'ADIMOL9',1),
     (3,'APATOUX22',3),
     (3,'ADIMOL9',1);
-- ----------------------------------------------------------------------------------------------
-- contraintes d'intégrité référentielles
alter table MEDICAMENT add foreign key (fCode) references FAMILLE(fCode) on update cascade;
alter table PRATICIEN add foreign key (tCode) references TYPE_PRATICIEN(tCode) on update cascade;
alter table REGION add foreign key (sCode) references SECTEUR(sCode) on update cascade;
alter table PRATICIEN add foreign key (region) references REGION(rCode);
alter table VISITE add foreign key (vVisiteur) references VISITEUR(viNum);
alter table VISITE add foreign key (vPraticien) references PRATICIEN(pNum);
alter table VISITEUR add foreign key (viLabo) references LABO(lCode);
alter table VISITEUR add foreign key (viRegion) references REGION(rCode);
alter table LABO add foreign key (lChefVente) references RESPONSABLE(reCode);
alter table RESPONSABLE add foreign key (reRegion) references REGION(rCode);
alter table PRESENTATION add foreign key (prVisite) references VISITE(vCode);
alter table PRESENTATION add foreign key (prMedicament) references MEDICAMENT(mDepotLegal);
-- ----------------------------------------------------------------------------------------------

create user if not exists 'adminGSB'@'%' identified by 'g8sdvdb448';
grant all privileges on gsbbdcr.* to 'adminGSB'@'%';

commit;