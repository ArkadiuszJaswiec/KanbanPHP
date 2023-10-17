-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Maj 2021, 15:49
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zaliczenie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `login` text COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text COLLATE utf8mb4_polish_ci NOT NULL,
  `email` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'arek', 'arek', 'arkadiusz.jaswiec@gmail.com'),
(2, 'admin', 'admin', 'admin@gmail.com'),
(3, 'test', 'qwerty', 'test@gmail,com'),
(7, 'zaliczenia', 'zaliczenie', 'zaliczenie@gmiail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id` int(5) NOT NULL,
  `state` text COLLATE utf8mb4_polish_ci NOT NULL,
  `task` text COLLATE utf8mb4_polish_ci NOT NULL,
  `description` text COLLATE utf8mb4_polish_ci NOT NULL,
  `difficulty` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zadania`
--

INSERT INTO `zadania` (`id`, `state`, `task`, `description`, `difficulty`, `id_usr`) VALUES
(2, 'do zrobienia', 'Projekt Analiza danych', 'Wykonać projekt przy pomocy metody Bayesa', 4, 1),
(3, 'zrobione', 'Kampania reklamowa', 'Wykonać kampanie reklamową produktu', 3, 1),
(4, 'do zrobienia', 'Zadanie Modelowanie Systemów informatycznych', 'Wykonać diagram przypadków użycia', 2, 1),
(5, 'do zrobienia', 'Umyć samochód', 'Mycie samochodu gry będzie pogoda', 1, 2),
(8, 'do sprawdzenia', 'Prezentacja marketing', 'Wykonać prezentacje na zajęcia marketingu', 4, 1),
(22, 'zrobione', 'trudnosc1', 'aaaa', 1, 2),
(23, 'zrobione', 'trudnosc2', 'aaaa', 2, 2),
(24, 'zrobione', 'trudnosc3', 'aaaa', 3, 2),
(25, 'zrobione', 'trudnosc4', 'aaaa', 4, 2),
(26, 'zrobione', 'trudnosc5', 'aaa', 5, 2),
(40, 'w trakcie', 'test', 'tesdsafds', 1, 3),
(41, 'do zrobienia', 'asdasd', 'asdasd', 2, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zadaniaUsr` (`id_usr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `fk_zadaniaUsr` FOREIGN KEY (`id_usr`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
