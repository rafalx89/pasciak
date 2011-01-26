-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 26 Sty 2011, 14:33
-- Wersja serwera: 5.1.54
-- Wersja PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `pilka_reczna`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `druzyna`
--

CREATE TABLE IF NOT EXISTS `druzyna` (
  `ID_druzyny` int(5) NOT NULL AUTO_INCREMENT,
  `Nazwa` varchar(25) NOT NULL,
  `Kapitan` varchar(45) NOT NULL,
  `Trener` varchar(45) NOT NULL,
  `Nazwa_ligi` varchar(30) NOT NULL,
  `Nazwa_klubu` varchar(45) NOT NULL,
  `sciezka` varchar(256) DEFAULT '/herb/brak.jpg',
  PRIMARY KEY (`ID_druzyny`),
  KEY `fk_druzyna_nazwaligi` (`Nazwa_ligi`),
  KEY `fk_druzyna_nazwaklubu` (`Nazwa_klubu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `druzyna`
--

INSERT INTO `druzyna` (`ID_druzyny`, `Nazwa`, `Kapitan`, `Trener`, `Nazwa_ligi`, `Nazwa_klubu`, `sciezka`) VALUES
(1, 'KS VIVE Targi Kielce', 'Rafal Glinski', 'Bogdan Wenta', 'Ekstraklasa', 'VIVE Kielce', '/herb/vivetargilogo.jpg'),
(2, 'Wisla Plock S.A.', 'Tomasz Paluch', 'Sivertsson Thomas', 'Ekstraklasa', 'Wisla Plock', '/herb/brak.jpg'),
(3, 'MMTS Kwidzyn', 'Dzmitry Marhun', 'Zbigniew Markuszewski', 'Ekstraklasa', 'MMTS Kwidzyn', '/herb/brak.jpg'),
(4, 'HSV Handball Hamburg ', 'Marcin Lijewski', 'Martin Schwalb', 'Bundesliga', 'Handball Sport Verein Hamburg', '/herb/brak.jpg'),
(5, 'MKS Zaglebie Lubin', 'Adam Babicz', 'Jerzy Szafraniec', 'Ekstraklasa', 'Zaglebie Lubin', '/herb/brak.jpg'),
(8, 'OKPR Traveland Spolem Ols', 'Michal Bartczak', 'Aleksander Malinowski', 'Ekstraklasa', 'Traveland Olsztyn', '/herb/brak.jpg'),
(9, 'MKS Nielba Wagrowiec', 'Dawid Przysiek', 'Edward Kozinski', 'Ekstraklasa', 'Nielba Wagrowiec', '/herb/brak.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `klub`
--

CREATE TABLE IF NOT EXISTS `klub` (
  `Nazwa` varchar(45) NOT NULL,
  `Prezes` varchar(45) NOT NULL,
  `Miasto` varchar(15) NOT NULL,
  `Ulica` varchar(15) NOT NULL,
  `Numer` int(5) NOT NULL,
  `Budzet` float(8,2) NOT NULL,
  PRIMARY KEY (`Nazwa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `klub`
--

INSERT INTO `klub` (`Nazwa`, `Prezes`, `Miasto`, `Ulica`, `Numer`, `Budzet`) VALUES
('Handball Sport Verein Hamburg', 'Andreas Rudolph', 'Hamburg', 'Hellgrundweg', 50, 1000000.00),
('MMTS Kwidzyn', 'Zygmunt Mancewicz', 'Kwidzyn', 'Mickiewicza ', 56, 700000.00),
('Nielba Wagrowiec', 'Jerzy Kasprzak', 'Wagrowiec', 'Kosciuszki', 59, 700000.00),
('Traveland Olsztyn', 'Andrzej Dowgiallo', 'Olsztyn', 'Pilsudskiego', 44, 700000.00),
('VIVE Kielce', 'Bertus Servaas', 'Kielce', 'Krakowska ', 72, 999000.00),
('Wisla Plock', 'Jerzy Ozog', 'Plock', 'Lukasiewicza ', 34, 800000.00),
('Zaglebie Lubin', 'Witold Kulesza', 'Lubin', 'Sklodowskiej-C.', 98, 1000000.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `kolejka`
--

CREATE TABLE IF NOT EXISTS `kolejka` (
  `Nr_kolejki` int(5) NOT NULL,
  `Id_sezonu` int(5) NOT NULL,
  `Data_rozegrania` date NOT NULL,
  PRIMARY KEY (`Nr_kolejki`,`Id_sezonu`),
  KEY `fk_kolejka_idsezonu` (`Id_sezonu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `kolejka`
--

INSERT INTO `kolejka` (`Nr_kolejki`, `Id_sezonu`, `Data_rozegrania`) VALUES
(1, 1, '2010-01-14'),
(1, 2, '2010-01-13'),
(2, 1, '2010-02-09'),
(2, 2, '2010-02-08'),
(3, 1, '2010-02-25'),
(4, 1, '2009-09-26'),
(5, 1, '2009-10-03'),
(6, 1, '2009-10-10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
  `ID_kontraktu` int(5) NOT NULL AUTO_INCREMENT,
  `Data_rozpoczecia` date NOT NULL,
  `Data_zakonczenia` date NOT NULL,
  `Placa` float(7,2) NOT NULL,
  `ID_zawodnika` int(5) NOT NULL,
  PRIMARY KEY (`ID_kontraktu`),
  KEY `fk_kontrakt_idzawodnika` (`ID_zawodnika`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `kontrakt`
--

INSERT INTO `kontrakt` (`ID_kontraktu`, `Data_rozpoczecia`, `Data_zakonczenia`, `Placa`, `ID_zawodnika`) VALUES
(1, '2005-06-14', '2010-05-31', 99999.99, 4),
(2, '2006-05-24', '2012-10-30', 99000.00, 2),
(3, '2007-07-11', '2011-04-10', 99999.99, 1),
(4, '2006-09-19', '2011-02-28', 99900.00, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `liga`
--

CREATE TABLE IF NOT EXISTS `liga` (
  `Nazwa` varchar(30) NOT NULL,
  `Kraj` varchar(20) NOT NULL,
  `Ilosc_druzyn` int(5) NOT NULL,
  PRIMARY KEY (`Nazwa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `liga`
--

INSERT INTO `liga` (`Nazwa`, `Kraj`, `Ilosc_druzyn`) VALUES
('Bundesliga', 'Niemcy', 18),
('Ekstraklasa', 'Polska', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `mecze`
--

CREATE TABLE IF NOT EXISTS `mecze` (
  `Data_rozegrania` date NOT NULL,
  `ID_druzyny1` int(5) NOT NULL,
  `ID_druzyny2` int(5) NOT NULL,
  `Nr_kolejki` int(5) NOT NULL,
  `Wynik_druzyny_domowej` int(2) NOT NULL,
  `Wynik_druzyny_przyjezdnej` int(2) NOT NULL,
  PRIMARY KEY (`Data_rozegrania`,`ID_druzyny1`,`ID_druzyny2`),
  KEY `fk_mecze_nrkolejki` (`Nr_kolejki`),
  KEY `fk_mecze_iddruzyny1` (`ID_druzyny1`),
  KEY `fk_mecze_iddruzyny2` (`ID_druzyny2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `mecze`
--

INSERT INTO `mecze` (`Data_rozegrania`, `ID_druzyny1`, `ID_druzyny2`, `Nr_kolejki`, `Wynik_druzyny_domowej`, `Wynik_druzyny_przyjezdnej`) VALUES
('0000-00-00', 5, 9, 6, 31, 23),
('2009-10-29', 1, 8, 2, 34, 24),
('2009-11-11', 1, 3, 3, 23, 34),
('2010-01-06', 9, 5, 2, 21, 35),
('2010-01-14', 1, 2, 1, 32, 24),
('2010-01-19', 4, 3, 1, 25, 29),
('2010-05-02', 2, 3, 2, 31, 34),
('2010-05-04', 1, 2, 2, 12, 23),
('2010-05-06', 5, 9, 6, 31, 23),
('2010-05-10', 1, 3, 3, 23, 41),
('2010-05-12', 1, 2, 3, 54, 21),
('2010-05-20', 1, 2, 3, 11, 23),
('2010-05-20', 2, 1, 2, 34, 34);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `sezon`
--

CREATE TABLE IF NOT EXISTS `sezon` (
  `ID_sezonu` int(5) NOT NULL AUTO_INCREMENT,
  `Rok_rozpoczecia_rozgrywek` year(4) NOT NULL,
  `Data_rozpoczecia` date NOT NULL,
  `Data_zakonczenia` date NOT NULL,
  `Nazwa_ligi` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_sezonu`),
  KEY `fk_sezon_nazwaligi` (`Nazwa_ligi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `sezon`
--

INSERT INTO `sezon` (`ID_sezonu`, `Rok_rozpoczecia_rozgrywek`, `Data_rozpoczecia`, `Data_zakonczenia`, `Nazwa_ligi`) VALUES
(1, 2010, '2009-09-05', '2010-05-26', 'Ekstraklasa'),
(2, 2010, '2010-01-11', '2011-01-01', 'Bundesliga');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `strzelcy`
--

CREATE TABLE IF NOT EXISTS `strzelcy` (
  `Minuta_strzelenia_gola` datetime NOT NULL,
  `ID_strzelca` int(5) NOT NULL,
  `ID_druzyny1` int(5) NOT NULL,
  `ID_druzyny2` int(5) NOT NULL,
  `Data_rozegrania` date NOT NULL,
  PRIMARY KEY (`Minuta_strzelenia_gola`,`ID_strzelca`,`ID_druzyny1`,`ID_druzyny2`,`Data_rozegrania`),
  KEY `fk_strzelcy_idstrzelca` (`ID_strzelca`),
  KEY `fk_strzelcy_iddruzyny1` (`ID_druzyny1`),
  KEY `fk_strzelcy_iddruzyny2` (`ID_druzyny2`),
  KEY `fk_strzelcy_datarozegrania` (`Data_rozegrania`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `strzelcy`
--

INSERT INTO `strzelcy` (`Minuta_strzelenia_gola`, `ID_strzelca`, `ID_druzyny1`, `ID_druzyny2`, `Data_rozegrania`) VALUES
('2010-01-14 20:30:24', 2, 1, 2, '2010-01-14'),
('2010-01-19 18:30:25', 3, 2, 3, '2010-01-19'),
('2010-01-19 22:24:40', 3, 1, 2, '2010-01-19');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tabela_ligowa`
--

CREATE TABLE IF NOT EXISTS `tabela_ligowa` (
  `ID_druzyny` int(5) NOT NULL,
  `ID_sezonu` int(5) NOT NULL,
  `Pozycja` int(2) NOT NULL,
  `Bramki_strzelone` int(3) NOT NULL,
  `Bramki_stracone` int(3) NOT NULL,
  `Mecze_wygrane` int(3) NOT NULL,
  `Mecze_zremisowane` int(3) NOT NULL,
  `Mecze_przegrane` int(3) NOT NULL,
  `Punkty` int(4) NOT NULL,
  PRIMARY KEY (`ID_druzyny`,`ID_sezonu`),
  KEY `fk_tabelaligowa_idsezonu` (`ID_sezonu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tabela_ligowa`
--

INSERT INTO `tabela_ligowa` (`ID_druzyny`, `ID_sezonu`, `Pozycja`, `Bramki_strzelone`, `Bramki_stracone`, `Mecze_wygrane`, `Mecze_zremisowane`, `Mecze_przegrane`, `Punkty`) VALUES
(1, 1, 1, 779, 552, 22, 0, 1, 44),
(2, 1, 6, 54, 46, 1, 0, 1, 0),
(3, 1, 4, 34, 31, 1, 0, 0, 3),
(4, 2, 1, 963, 782, 26, 1, 2, 53),
(5, 1, 3, 97, 67, 3, 0, 0, 9),
(9, 1, 5, 67, 97, 0, 0, 3, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `zawodnik`
--

CREATE TABLE IF NOT EXISTS `zawodnik` (
  `ID_zawodnik` int(5) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(20) NOT NULL,
  `Nazwisko` varchar(40) NOT NULL,
  `Kraj` varchar(20) NOT NULL,
  `Data_urodzenia` date NOT NULL,
  `Wzrost` float(5,2) NOT NULL,
  `Pozycja` varchar(15) NOT NULL,
  `Nr_koszulki` int(2) DEFAULT NULL,
  `Kontrakt` tinyint(1) DEFAULT NULL,
  `ID_druzyny` int(5) DEFAULT NULL,
  PRIMARY KEY (`ID_zawodnik`),
  KEY `fk_zawodnik_iddruzyny` (`ID_druzyny`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `zawodnik`
--

INSERT INTO `zawodnik` (`ID_zawodnik`, `Imie`, `Nazwisko`, `Kraj`, `Data_urodzenia`, `Wzrost`, `Pozycja`, `Nr_koszulki`, `Kontrakt`, `ID_druzyny`) VALUES
(1, 'Robert', 'Orzechowski', 'Polska', '1989-11-20', 190.00, 'Rozgrywajacy', 3, 1, 3),
(2, 'Patryk ', 'Kuchczynski', 'Polska', '1983-03-03', 187.00, 'Rozgrywajacy', 10, 1, 1),
(3, 'Marcin', 'Wichary', 'Polska', '1980-02-17', 192.00, 'Bramkarz', 12, 1, 2),
(4, 'Krzysztof', 'Lijewski', 'Polska', '1983-07-07', 199.00, 'Rozgrywajacy', 19, 1, 4),
(5, 'Marek', 'Boneczko', 'Polska', '1974-05-11', 182.00, 'kolowy', 88, 1, 8),
(6, 'Bartosz', 'Wuszter', 'Polska', '1977-08-06', 190.00, 'kolowy', 14, 1, 2),
(7, 'Rastko', 'Stojkovic', 'Jugoslawia', '1981-08-12', 191.00, 'obrotowy', 18, 1, 1),
(8, 'Mariusz ', 'Jurasik', 'Polska', '1976-05-04', 190.00, 'prawoskrzydlowy', 13, 1, 1),
(9, 'Mateusz', 'Zaremba', 'Polska', '1984-10-27', 198.00, 'rozgrywajacy', 7, 1, 1),
(10, 'Piotr', 'Grabarczyk', 'Polska', '1982-10-31', 200.00, 'obrotowy', 2, 1, 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  ADD CONSTRAINT `fk_druzyna_nazwaklubu` FOREIGN KEY (`Nazwa_klubu`) REFERENCES `klub` (`Nazwa`),
  ADD CONSTRAINT `fk_druzyna_nazwaligi` FOREIGN KEY (`Nazwa_ligi`) REFERENCES `liga` (`Nazwa`);

--
-- Ograniczenia dla tabeli `kolejka`
--
ALTER TABLE `kolejka`
  ADD CONSTRAINT `fk_kolejka_idsezonu` FOREIGN KEY (`Id_sezonu`) REFERENCES `sezon` (`ID_sezonu`);

--
-- Ograniczenia dla tabeli `kontrakt`
--
ALTER TABLE `kontrakt`
  ADD CONSTRAINT `fk_kontrakt_idzawodnika` FOREIGN KEY (`ID_zawodnika`) REFERENCES `zawodnik` (`ID_zawodnik`);

--
-- Ograniczenia dla tabeli `mecze`
--
ALTER TABLE `mecze`
  ADD CONSTRAINT `fk_mecze_iddruzyny1` FOREIGN KEY (`ID_druzyny1`) REFERENCES `druzyna` (`ID_druzyny`),
  ADD CONSTRAINT `fk_mecze_iddruzyny2` FOREIGN KEY (`ID_druzyny2`) REFERENCES `druzyna` (`ID_druzyny`),
  ADD CONSTRAINT `fk_mecze_nrkolejki` FOREIGN KEY (`Nr_kolejki`) REFERENCES `kolejka` (`Nr_kolejki`);

--
-- Ograniczenia dla tabeli `sezon`
--
ALTER TABLE `sezon`
  ADD CONSTRAINT `fk_sezon_nazwaligi` FOREIGN KEY (`Nazwa_ligi`) REFERENCES `liga` (`Nazwa`);

--
-- Ograniczenia dla tabeli `strzelcy`
--
ALTER TABLE `strzelcy`
  ADD CONSTRAINT `fk_strzelcy_datarozegrania` FOREIGN KEY (`Data_rozegrania`) REFERENCES `mecze` (`Data_rozegrania`),
  ADD CONSTRAINT `fk_strzelcy_iddruzyny1` FOREIGN KEY (`ID_druzyny1`) REFERENCES `druzyna` (`ID_druzyny`),
  ADD CONSTRAINT `fk_strzelcy_iddruzyny2` FOREIGN KEY (`ID_druzyny2`) REFERENCES `druzyna` (`ID_druzyny`),
  ADD CONSTRAINT `fk_strzelcy_idstrzelca` FOREIGN KEY (`ID_strzelca`) REFERENCES `zawodnik` (`ID_zawodnik`);

--
-- Ograniczenia dla tabeli `tabela_ligowa`
--
ALTER TABLE `tabela_ligowa`
  ADD CONSTRAINT `fk_tabelaligowa_iddruzyny` FOREIGN KEY (`ID_druzyny`) REFERENCES `druzyna` (`ID_druzyny`),
  ADD CONSTRAINT `fk_tabelaligowa_idsezonu` FOREIGN KEY (`ID_sezonu`) REFERENCES `sezon` (`ID_sezonu`);

--
-- Ograniczenia dla tabeli `zawodnik`
--
ALTER TABLE `zawodnik`
  ADD CONSTRAINT `fk_zawodnik_iddruzyny` FOREIGN KEY (`ID_druzyny`) REFERENCES `druzyna` (`ID_druzyny`);
