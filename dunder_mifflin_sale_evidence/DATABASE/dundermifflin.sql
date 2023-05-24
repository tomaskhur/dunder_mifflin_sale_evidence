-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 24. kvě 2023, 15:58
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `dundermifflin`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `tbcategories`
--

CREATE TABLE `tbcategories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tbcategories`
--

INSERT INTO `tbcategories` (`id`, `category`) VALUES
(1, 'elektronika'),
(2, 'papír'),
(3, 'psací potřeby'),
(4, 'kancelářské potřeby');

-- --------------------------------------------------------

--
-- Struktura tabulky `tbemployees`
--

CREATE TABLE `tbemployees` (
  `id` int(11) NOT NULL,
  `idPostions` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tbemployees`
--

INSERT INTO `tbemployees` (`id`, `idPostions`, `name`, `surname`, `mail`, `date_of_birth`, `position`) VALUES
(1, 3, 'Marek', 'Mašát', 'masatmarek@dm.cz', '0000-00-00', 'Obchodní Zástupce'),
(2, 5, 'Arnošt', 'Procházka', 'prochazkaarnost@dm.cz', '2004-01-19', 'Marketing'),
(3, 2, 'Tomáš', 'Khür', 'khurtomas@dm.cz', '2003-05-08', 'Marketing'),
(4, 6, 'Hana', 'Veselá', 'veselahana@dm.cz', '2004-03-23', 'Marketing'),
(5, 4, 'Matěj', 'Vácha', 'vachamatej@dm.cz', '2003-11-02', 'Marketing'),
(6, 1, 'Karel', 'Novák', 'novakkarel@dm.cz', '1979-04-28', 'Uklízeč'),
(7, 1, 'Petr', 'Červ', 'cervpetr@dm.cz', '1996-03-26', 'Uklízeč'),
(8, 1, 'Jan', 'Svoboda', 'svobodajan@dm.cz', '1999-09-01', 'Ředitel'),
(9, 1, 'David', 'Černý', 'cernydavid@dm.cz', '1993-07-21', 'Sekretář'),
(10, 1, 'Jiří', 'Kučera', 'kucerajiri@dm.cz', '1969-09-06', 'Admin'),
(11, 1, 'Pavel', 'Horák', 'horakpavel@dm.cz', '1987-09-02', 'IT - Section'),
(12, 1, 'Stanislav', 'Pokorný', 'pokornystanislav@dm.cz', '1990-12-25', 'Marketing'),
(13, 1, 'Adam', 'Mareček', 'marecekadam@dm.cz', '1978-06-13', 'Marketing');

-- --------------------------------------------------------

--
-- Struktura tabulky `tbpositions`
--

CREATE TABLE `tbpositions` (
  `id` int(11) NOT NULL,
  `position` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tbpositions`
--

INSERT INTO `tbpositions` (`id`, `position`) VALUES
(1, 'prodejce'),
(2, 'obchodní zástupce'),
(3, 'ředitel'),
(4, 'účetní'),
(5, 'zástupce ředitele'),
(6, 'vedoucí grafického oddělení');

-- --------------------------------------------------------

--
-- Struktura tabulky `tbproducts`
--

CREATE TABLE `tbproducts` (
  `id` int(11) NOT NULL,
  `idCategories` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(250) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tbproducts`
--

INSERT INTO `tbproducts` (`id`, `idCategories`, `name`, `description`, `price`, `stock`, `category`) VALUES
(1, 1, 'Kalkulačka Casio FX 350 ES PLUS 2E', 'Školní kalkulačka, která je vybavena černobílým LCD displejem s rozlišením 31 × 96 bodů bude výborným pomocníkem pro středoškoláky v hodinách matematiky. Díky použité technologii S-V.P.A.M. zařízení umožní zadávat přesně vzorce výpočtů. Kalkulačka nabízí 252 funkcí, 9 proměnných pamětí a několik matematických funkcí.\r\nKalkulačka nabízí 252 matematických funkcí. Podporuje počítání se zlomky v přirozeném zobrazení, výsledek proto může být zobrazen ve formě zlomků, a ne jen v desetinných číslech. Mezi další nabízené funkce patří výpočty procent, rozklad na prvočísla, goniometrické funkce, variace a kombinace.', 392, 500, 'Elektronika'),
(2, 1, 'Tiskárna Canon PIXMA G2460', 'Elegantní a kompaktní multifunkční tiskárna vhodná pro tisk v domácím i v pracovním prostředí nebo pro kopírování a skenování. Tiskárna má vysokou výtěžnost a je perfektní pro tisk dokumentů a fotografií ve vynikající kvalitě při velmi nízkých provozních nákladech.\r\nTiskárna Canon PIXMA G2460 má vpředu umístěné zásobníky inkoustu, které lze snadno doplňovat a kontrolovat, takže máte vždy přehled o stavu inkoustu v zásobnících. Doplňování inkoustu je velmi snadné, stačí pouze zásobník nahoře odklopit a dolít do něj originální inkoust.', 4488, 500, 'Elektronika'),
(3, 4, 'Nůžky Maped Start - 17 cm ', 'Ekonomické nůžky, velikost 17 cm.\r\nBroušená nerezová ocel, symetrické rukojeti.', 37, 1250, 'Psací potřeby'),
(4, 4, 'KOH-I-NOOR Pryž měkká', 'Pryž pro retušování (vymazávání) grafitových nebo pastelových stop. Snímání se provádí nalepením stopy na pryž a jejích oddrolením.', 4, 1250, 'Psací potřeby'),
(5, 4, 'Maped Geometric - plastové pravítko - 30 cm', 'Průhledné plastové pravítko. Pro čisté rýsování a podtrhávání. Okraj nezanechávající stopy. Šířka 39 mm, tloušťka 3 mm.\r\n', 23, 1250, 'Psací potřeby'),
(6, 4, 'Trojúhelník s ryskou - 16 cm', 'Trojúhelník s ryskou, 16 cm.', 22, 1250, 'Psací potřeby'),
(7, 4, 'Centropen Úhloměr 180/125', 'Plastový úhloměr 180°/125 s ryskou, čirý.', 7, 1250, 'Psací potřeby'),
(8, 4, 'Kores Lepicí tyčinka 40 g', 'Obsahuje glycerin pro jemné lepení. Čistá a hladká aplikace. Vzduchotěsný uzávěr pro dlouhou životnost. \r\nVhodná pro všechny druhy papíru. Lepí trvale za 60 sekund. Neobsahuje rozpouštědla, kyseliny, netoxická.', 64, 1250, 'Psací potřeby'),
(9, 4, 'Ořezávátko Faber-Castell', 'Kovové ořezávátko se 2 otvory pro klasické, standardní tužky a pastelky.', 30, 1250, 'Psací potřeby'),
(10, 4, 'Sešívačka DELI 0314', 'Kvalitní kovová konstrukce, vhodná pro velké svazky.\r\nMaximální hloubka vložení listů: 85 mm.\r\nPočet spon v zásobníku: 100.\r\nZáruční doba 5 let.\r\n', 109, 1250, 'Elektronika'),
(11, 4, 'Děrovačka E 210', 'Malá děrovačka pro domácnost a domácí kancelář.\r\nPotištěné posuvné pravítko pro snadné formátování.\r\nKovový spodní díl a plastový horní díl.\r\nHmotnost: 145 g.\r\nProdloužená záruka: 5 let.', 109, 1250, 'Elektronika'),
(12, 4, 'Kovové kružítko Koh-i-noor 6541 ', 'Sada kružidel je vhodná pro základní školy. \r\nKružidlo kovové pro základní školy ř. 400 je určeno pro rýsování kružnic o průměru 5-250 mm.Upínací průměr tužce je 3 mm, průměr tuhy 2 mm.\r\nRamena jsou výlisky ze slitiny Zn, povrchová úprava práškový plast, barevný odstín šedá metalíza (imitace Ni), závěška plastová.', 55, 1250, '0'),
(13, 3, 'Centropen 2215 modrá', 'Jednorázové kuličkové pero s výbornými psacími vlastnostmi. Plněné je nízkoviskózním inkoustem, který zaručuje super jemné a hlladké psaní neporovnatelné s inkoustovými i gelovýmim náplněmi. Pero má tenký jehlový hrot a průhledný plášť s možností kontroly náplně a trojúhelníkové ERGO držení.\r\nBarva náplně: modrá.\r\nŠíře stopy: 0,3 mm.', 6, 1000, '0'),
(14, 3, 'Kuličkové pero - modré', 'Kovové kuličkové pero vyniká příjemným dotykem, elastickým kovovým klipem a praktickým otočným mechanismem.', 115, 1000, '0'),
(15, 3, 'PILOT FRIXION gumovací pero 0.7 - modré', 'Roller se speciálním inkoustem, který jde vygumovat a znovu přepsat. Při zahřátí napsaného textu na teplotu 65°C text zmizí, při ochlazení na -15°C se znovu objeví. Roller je velice oblíbený nejen u školáků. Barva inkoustu je stejná, jako barva těla rolleru.', 61, 1000, '0'),
(16, 3, 'CENTROPEN 2846 - Fix lihový - černý', 'Popisovač vhodný především k popisování nejrůznějších plastických hmot, skla, filmů apod.\r\nPermanentní inkoust na alkoholové bázi.\r\nStopa písma odolává vodě, teplotě do 100 °C, otěru a povětrnostním vlivům.\r\nVálcový hrot, šíře stopy cca 1 mm.\r\nInkoust tohoto výroku není vypratelný z textilu, ale zároveň není světlostálý, proto je možné, že stopa písma časem vybledne.', 12, 1000, '0'),
(17, 3, 'Zvýrazňovač Stabilo BOSS Pastel - žlutá', 'Žlutý zvýrazňovač značky Stabilo BOSS ve žluté barvě.', 39, 1000, '0'),
(18, 3, 'Centropen Zmizík 2539/1 ', 'Zmizík na inkoust do plnicích per s trojúhelníkovou úchopovou částí. Vláknový hrot o průměru 2 mm, odolný proti zatlačení. Ventilační chránítko.', 9, 1000, '0'),
(19, 3, 'Mikrotužka Koh-i-noor profi 0.5 mm 5035', 'Profesionální velmi kvalitní mikrotužka značky Koh-i-noor pro každodenní používání.\r\nMechanická mikrotužka kombinace kov-plast, barevný plášť: červená, černá, modrá, gumový úchyt, délka tužky 150 mm, průměr 10 mm, grafitová tuha průměr 0,5 mm, tvrdost tuhy HB.', 110, 999, '0'),
(20, 3, 'KOH-I-NOOR 1770 3B, šestihranná ', 'Klasická grafitová tužka od světoznámé značky KOH-I-NOOR je vhodná pro psaní, kreslení i skicování. Tužka má šestiúhelníkový tvar a nemá gumu.', 29, 1000, '0'),
(21, 2, 'Kancelářský papír A4 80g, 500 listů', 'Bílý kancelářský papír formátu A4, gramáž 80g/m2, balený v balících po 500 listech. Vhodný pro každodenní použití v laserových a inkoustových tiskárnách / kopírkách  / faxech.', 129, 750, '0'),
(22, 2, 'Čtvrtky A4 220g – balení 200ks', ' Klasické silné čtvrtky / kreslící karton o gramáži 220g/m2. Papír je hladký, s velice jemnou strukturou. Vhodný je pro běžnou kresbu tužkou, pastelkami, uhlem ale i různé tvoření, vystřihování, popř. malbu. Vyrábí se bez kyselin, oblíbený je také mezi školami a dětmi. Stálá tloušťka a kvalita papíru.', 214, 750, '0'),
(23, 2, 'Školní sešit EKO 444 - A4, linkovaný, 40 listů', 'Školní sešit z recyklovaného papíru 60 g/m2. Obálka z křídového papíru 150 g/m2.\r\nFormát A4, 40 listů, linkovaný 8 mm.\r\nPředtištěná svislá linka okraje sešitu (3 cm) na vnější straně listu. Vnitřní strana bez okraje.\r\n', 15, 750, '0'),
(24, 2, 'Školní sešit EKO 524 - A5, linkovaný, 20 listů', 'Školní sešit EKO 524 - A5, linkovaný, 20 listů.', 6, 750, '0'),
(25, 2, 'Barevný papír tvrdý 300g/m2 - A4 - 10 listů v 10ti barvách ', 'Barevné papíry z fotokartonu jsou velmi kvalitní. Vyrobeny v Německu.\r\nGramáž: 300g/m2.\r\nBalení: 10 listů v 10ti barvách (žlutá, oranžová, červená, tmavě růžová, světle růžová, modrá, světle zelená, lesní zelená, hnědá, černá).\r\nRozměr: DIN A4.\r\n', 50, 750, '0'),
(26, 2, 'Poznámkový blok Retro A5, čtverečkovaný', 'Proč milujeme čtverečky a vy budete také? Můžete z nich snadno udělat praktický to do list, rámeček nebo jinou grafickou vychytávku. Poslouží jako přehledný nákupní seznam, ale hodí se i jako sešit na matematiku, fyziku nebo chemii.', 65, 750, '0');

-- --------------------------------------------------------

--
-- Struktura tabulky `tbsalesevidence`
--

CREATE TABLE `tbsalesevidence` (
  `id` int(11) NOT NULL,
  `idEmployees` int(11) NOT NULL,
  `idProducts` int(11) NOT NULL,
  `number_of_sales` int(11) NOT NULL,
  `discount` bit(1) DEFAULT NULL,
  `sum_price` int(11) NOT NULL,
  `date_of_sale` datetime NOT NULL,
  `date_of_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tbsalesevidence`
--

INSERT INTO `tbsalesevidence` (`id`, `idEmployees`, `idProducts`, `number_of_sales`, `discount`, `sum_price`, `date_of_sale`, `date_of_change`) VALUES
(1, 9, 2, 20, b'1', 80784, '2022-06-18 00:00:00', '2022-06-11 20:12:23'),
(2, 6, 22, 4, NULL, 856, '2022-06-18 00:00:00', NULL),
(3, 12, 19, 2, NULL, 220, '2022-06-18 00:00:00', NULL),
(4, 13, 10, 6, b'1', 589, '2022-06-18 00:00:00', NULL),
(5, 11, 1, 19, b'1', 6703, '2022-06-18 00:00:00', '2022-06-11 20:12:29'),
(6, 8, 8, 22, NULL, 1408, '2022-06-18 00:00:00', '2022-06-11 20:12:32'),
(7, 9, 16, 30, NULL, 360, '2022-06-19 00:00:00', NULL),
(8, 12, 7, 25, b'1', 158, '2022-06-19 00:00:00', NULL),
(9, 10, 10, 100, b'1', 9810, '2022-06-19 00:00:00', NULL),
(10, 7, 5, 15, NULL, 345, '2022-06-19 00:00:00', NULL),
(11, 9, 9, 125, b'1', 3375, '2022-06-19 00:00:00', NULL),
(12, 8, 21, 45, b'1', 5225, '2022-06-20 00:00:00', NULL),
(13, 6, 16, 15, NULL, 180, '2022-06-20 00:00:00', '2022-06-11 20:12:35'),
(14, 12, 6, 5, b'1', 99, '2022-06-20 00:00:00', NULL),
(15, 8, 4, 57, b'1', 205, '2022-06-20 00:00:00', NULL),
(16, 9, 3, 130, b'1', 4329, '2022-06-20 00:00:00', NULL),
(17, 11, 12, 3, NULL, 165, '2022-06-20 00:00:00', NULL),
(18, 12, 26, 6, NULL, 390, '2022-06-20 00:00:00', NULL),
(19, 12, 17, 7, b'1', 246, '2022-06-20 00:00:00', '2022-06-11 20:12:38'),
(20, 10, 22, 8, b'1', 1541, '2022-06-21 00:00:00', '2022-06-11 20:12:41'),
(21, 6, 14, 3, NULL, 345, '2022-06-21 00:00:00', NULL),
(22, 13, 20, 200, b'1', 5220, '2022-06-21 00:00:00', NULL),
(23, 11, 16, 12, NULL, 144, '2022-06-22 00:00:00', NULL),
(24, 12, 1, 9, NULL, 3528, '2022-06-22 00:00:00', NULL),
(25, 8, 17, 99, b'1', 3475, '2022-06-23 00:00:00', NULL),
(26, 7, 21, 10, NULL, 1290, '2022-06-23 00:00:00', NULL),
(27, 9, 10, 27, b'1', 2649, '2022-06-23 00:00:00', '2022-06-11 20:12:44'),
(28, 11, 24, 65, b'1', 351, '2022-06-23 00:00:00', NULL),
(29, 7, 1, 3, NULL, 1176, '2022-06-23 00:00:00', NULL),
(30, 12, 25, 33, NULL, 1650, '2022-06-23 00:00:00', NULL),
(31, 12, 19, 20, b'1', 1980, '2022-06-23 00:00:00', NULL),
(32, 7, 5, 12, b'1', 248, '2022-06-24 00:00:00', NULL),
(33, 12, 21, 12, b'1', 1393, '2022-06-24 00:00:00', NULL),
(34, 9, 14, 30, NULL, 3450, '2022-06-24 00:00:00', NULL),
(35, 11, 20, 5, b'1', 131, '2022-06-24 00:00:00', NULL),
(36, 6, 10, 23, b'1', 2256, '2022-06-24 00:00:00', '2022-06-11 20:12:48'),
(37, 9, 16, 1, NULL, 12, '2022-06-24 00:00:00', NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `tbcategories`
--
ALTER TABLE `tbcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `tbemployees`
--
ALTER TABLE `tbemployees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_positions` (`idPostions`);

--
-- Indexy pro tabulku `tbpositions`
--
ALTER TABLE `tbpositions`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `tbproducts`
--
ALTER TABLE `tbproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categories` (`idCategories`);

--
-- Indexy pro tabulku `tbsalesevidence`
--
ALTER TABLE `tbsalesevidence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_employees` (`idEmployees`),
  ADD KEY `id_products` (`idProducts`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `tbcategories`
--
ALTER TABLE `tbcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `tbemployees`
--
ALTER TABLE `tbemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `tbpositions`
--
ALTER TABLE `tbpositions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `tbproducts`
--
ALTER TABLE `tbproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pro tabulku `tbsalesevidence`
--
ALTER TABLE `tbsalesevidence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `tbemployees`
--
ALTER TABLE `tbemployees`
  ADD CONSTRAINT `tbemployees_ibfk_1` FOREIGN KEY (`idPostions`) REFERENCES `tbpositions` (`id`);

--
-- Omezení pro tabulku `tbproducts`
--
ALTER TABLE `tbproducts`
  ADD CONSTRAINT `tbproducts_ibfk_1` FOREIGN KEY (`idCategories`) REFERENCES `tbcategories` (`id`);

--
-- Omezení pro tabulku `tbsalesevidence`
--
ALTER TABLE `tbsalesevidence`
  ADD CONSTRAINT `tbsalesevidence_ibfk_1` FOREIGN KEY (`idEmployees`) REFERENCES `tbemployees` (`id`),
  ADD CONSTRAINT `tbsalesevidence_ibfk_2` FOREIGN KEY (`idProducts`) REFERENCES `tbproducts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
