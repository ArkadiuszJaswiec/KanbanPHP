<?php
//Uruchomienie sesji
	session_start();
//Sprawdzanie czy użytkownik jest zalogowany, jeśli jest przejście do pliku kanban.php	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: kanban.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="style.css">
<title> Kanban </title>
</head>
<body>
<div class="all">
	<h2>KANBAN</h2>
	<!-- Formularz logowania po wpisanu kliknięciu przycisku Zaloguj wykonanie  zaloguj.php -->
	<form action="zaloguj.php" method="post">
		<label>Login: <input type="text" name="login" /> </label>
		<label>Hasło: <input type="password" name="haslo" /> </label>
		<input type="submit" value="Zaloguj się" />
		<!-- Zakładanie nowego konta, przeniesienie na strone rejestracja.php -->
		<label>	Nie masz konta ? <input type="button" value="Rejestracja" onclick="location.href='rejestracja.php'" /></label>
	
	<?php
	//Wyświetlenie informacji w przypadku błędnych danych logowania
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
	?>
	
	</form>
	
</div>
<footer>
	Autor: <address>Arkadiusz Jaświec 6MIIOS (arkadiusz.jaswiec@edu.wsti.pl) </address>
</footer>
</body>

</html>