-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 01:36 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `runda1`
--

CREATE TABLE `runda1` (
  `ID_betu` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Team_1` text NOT NULL,
  `Team_2` text NOT NULL,
  `Wynik` text NOT NULL,
  `Wynik_faktyczny_Team1` int(11) NOT NULL,
  `Wynik_faktyczny_Team2` int(11) NOT NULL,
  `Wynik_Typowany` text NOT NULL,
  `Wynik_Typowany_Team1` int(11) NOT NULL,
  `Wynik_Typowany_Team2` int(11) NOT NULL,
  `Drużyna_Typowana` text NOT NULL,
  `Wytypowany_Mistrz` text NOT NULL,
  `Punkty_Dodane` text NOT NULL,
  `Punkty` int(11) NOT NULL,
  `Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `runda2`
--

CREATE TABLE `runda2` (
  `ID_betu` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Team_1` text NOT NULL,
  `Team_2` text NOT NULL,
  `Wynik` text NOT NULL,
  `Wynik_faktyczny_Team1` int(11) NOT NULL,
  `Wynik_faktyczny_Team2` int(11) NOT NULL,
  `Wynik_Typowany` text NOT NULL,
  `Wynik_Typowany_Team1` int(11) NOT NULL,
  `Wynik_Typowany_Team2` int(11) NOT NULL,
  `Drużyna_Typowana` text NOT NULL,
  `Wytypowany_Mistrz` text NOT NULL,
  `Punkty_Dodane` text NOT NULL,
  `Punkty` int(11) NOT NULL,
  `Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `runda3`
--

CREATE TABLE `runda3` (
  `ID_betu` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Team_1` text NOT NULL,
  `Team_2` text NOT NULL,
  `Wynik` text NOT NULL,
  `Wynik_faktyczny_Team1` int(11) NOT NULL,
  `Wynik_faktyczny_Team2` int(11) NOT NULL,
  `Wynik_Typowany` text NOT NULL,
  `Wynik_Typowany_Team1` int(11) NOT NULL,
  `Wynik_Typowany_Team2` int(11) NOT NULL,
  `Drużyna_Typowana` text NOT NULL,
  `Wytypowany_Mistrz` text NOT NULL,
  `Punkty_Dodane` text NOT NULL,
  `Punkty` int(11) NOT NULL,
  `Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `runda4`
--

CREATE TABLE `runda4` (
  `ID_betu` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Team_1` text NOT NULL,
  `Team_2` text NOT NULL,
  `Wynik` text NOT NULL,
  `Wynik_faktyczny_Team1` int(11) NOT NULL,
  `Wynik_faktyczny_Team2` int(11) NOT NULL,
  `Wynik_Typowany` text NOT NULL,
  `Wynik_Typowany_Team1` int(11) NOT NULL,
  `Wynik_Typowany_Team2` int(11) NOT NULL,
  `Drużyna_Typowana` text NOT NULL,
  `Wytypowany_Mistrz` text NOT NULL,
  `Punkty_Dodane` text NOT NULL,
  `Punkty` int(11) NOT NULL,
  `Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `runda5`
--

CREATE TABLE `runda5` (
  `ID_betu` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Team_1` text NOT NULL,
  `Team_2` text NOT NULL,
  `Wynik` text NOT NULL,
  `Wynik_faktyczny_Team1` int(11) NOT NULL,
  `Wynik_faktyczny_Team2` int(11) NOT NULL,
  `Wynik_Typowany` text NOT NULL,
  `Wynik_Typowany_Team1` int(11) NOT NULL,
  `Wynik_Typowany_Team2` int(11) NOT NULL,
  `Drużyna_Typowana` text NOT NULL,
  `Wytypowany_Mistrz` text NOT NULL,
  `Punkty_Dodane` text NOT NULL,
  `Punkty` int(11) NOT NULL,
  `Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `Imie` text NOT NULL,
  `Nazwisko` text NOT NULL,
  `e-mail` text NOT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyniki`
--

CREATE TABLE `wyniki` (
  `ID` int(11) NOT NULL,
  `Imie` text NOT NULL,
  `Nazwisko` text NOT NULL,
  `Runda_1` int(11) NOT NULL,
  `Runda_2` int(11) NOT NULL,
  `Runda_3` int(11) NOT NULL,
  `Runda_4` int(11) NOT NULL,
  `Runda_5` int(11) NOT NULL,
  `Mistrz` text NOT NULL,
  `Punkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `runda1`
--
ALTER TABLE `runda1`
  ADD KEY `bet` (`ID`);

--
-- Indeksy dla tabeli `runda2`
--
ALTER TABLE `runda2`
  ADD KEY `runda2` (`ID`);

--
-- Indeksy dla tabeli `runda3`
--
ALTER TABLE `runda3`
  ADD KEY `runda3` (`ID`);

--
-- Indeksy dla tabeli `runda4`
--
ALTER TABLE `runda4`
  ADD KEY `runda4` (`ID`);

--
-- Indeksy dla tabeli `runda5`
--
ALTER TABLE `runda5`
  ADD KEY `runda5` (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `runda1`
--
ALTER TABLE `runda1`
  ADD CONSTRAINT `bet` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `runda2`
--
ALTER TABLE `runda2`
  ADD CONSTRAINT `runda2` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `runda3`
--
ALTER TABLE `runda3`
  ADD CONSTRAINT `runda3` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `runda4`
--
ALTER TABLE `runda4`
  ADD CONSTRAINT `runda4` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `runda5`
--
ALTER TABLE `runda5`
  ADD CONSTRAINT `runda5` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `wyniki`
--
ALTER TABLE `wyniki`
  ADD CONSTRAINT `wyniki` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
