<?php
	//Rozpoczecie sesji
	session_start();
	//Sprawdzenie czy użytkownik nie jest zalogowany, jeśli nie jest to przeniesienie do index.php
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	//Połączenie z bazą danych
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		//Zapisanie danych z formularza do zmiennych
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		//Konwertowanie zmiennych jako zmienne stringowe
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		//Sprawdzenie czy zapytanie jest poprawne
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE login='%s' AND password='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			//Sprawdzenie czy jest taki użytkownik
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
				//Zapisanie danych z dazy w zmiennych sesyjnych
				$wiersz = $rezultat->fetch_assoc();
				 $_SESSION['id'] = $wiersz['id'];
				$_SESSION['user'] = $wiersz['login'];
				
				
				//Niszczenie zmiennej sesyjnej
				unset($_SESSION['blad']);
				//Czyszczenie rezultatu
				$rezultat->free_result();
				//Przejscie do pliku kanban.php
				header('Location: kanban.php');
				
			} else {
				//Komunikat o niepoprawnych danych wyświetlony na stronie index.php
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		//Zamkniecie połączenia
		$polaczenie->close();
	}
	
?>