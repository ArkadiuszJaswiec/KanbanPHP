<?php
//Rozpoczęcie sesji
	session_start();
	//Sprawdzenie czy uzytkownik jest zalogowany, jeśli tak to przejscie do kanban.php
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
<link rel="stylesheet" href="style.css">
<title> Kanban - rejestracja </title>
</head>
<body>
<div class="all">
	<h2>KANBAN - NOWY UŻYTKOWNIK</h2>
	<!-- Formularz dodawania nowego użytkownika po kliknieciu przycisku Zarejestruj odpalenie daodanie_usr.php -->
	<form action="dodanie_usr.php" method="post">
		<label>Login: <br /> <input type="text" name="nlogin" /></label>
		<label>Hasło: <br /> <input type="password" name="nhaslo" /> </label>
		<label>Email: <br /> <input type="text" name="nemail" /></label>
		<input type="submit" value="Zarejestruj się" />
		<input type="button" value="Powrót do strony logowania" onClick="location.href='index.php';" />
		<?php
			//Wyświetlenie informacji w przypadku błędnych danych
			if(isset($_SESSION['uzywana']))	echo $_SESSION['uzywana'];
		?>
	</form>



</div>
<footer>
	Autor: <address>Arkadiusz Jaświec 6MIIOS (arkadiusz.jaswiec@edu.wsti.pl) </address>

</footer>
</body>

</html>