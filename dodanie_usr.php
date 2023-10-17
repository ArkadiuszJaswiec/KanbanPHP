<?php
		//Uruchomienie sesji
		session_start();
		//Połączenie z bazą
	require_once "connect.php";
		$polaczenie =@new mysqli($host, $db_user, $db_password, $db_name);
		
		if($polaczenie->connect_errno!=0)
		{
			echo "Error: ".$polaczenie ->connect_errno;
		}
		else
		{
				//przypisanie pobranych danych z formularza rejestracyjnego do zmiennych
				$login = $_POST['nlogin'];
				$haslo = $_POST['nhaslo'];
				$email= $_POST['nemail'];
				//Sprawdzenie czy mail posiada znak @
		if (strpos($email, "@")!=true)
			{
				$_SESSION['uzywana'] = '<span style="color:red"><b>Wpisano niepoprawny adres email !</b></span>';
				mysqli_close($polaczenie);
					header('Location: rejestracja.php');
			}
			//Sprawdzenie czy login i hasło nie są puste
			else if($login=="" OR $haslo=="")
			{
				$_SESSION['uzywana'] = '<span style="color:red"><b>Login lub hasło nie może być puste !</b></span>';
				mysqli_close($polaczenie);
					header('Location: rejestracja.php');
			}
			//Jeśli dane są poprawne wykonanie zapytania sprawdzającego czy w bazie znajduje się
			//użytkownik o podanym loginie lub emailu.
			else if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM users WHERE login='$login' OR email='$email'")))
		{
			//jeśli zapytanie zwraca jakiś wynik to login lub email są już w użyciu 
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				//wyświetlenie komunikatu o zajętym loginie lub haśle
					$_SESSION['uzywana'] = '<span style="color:red"><b>Podany login lub email jest już w użyciu !</b></span>';
					header('Location: rejestracja.php');
					//zamknięcie połączenia
					mysqli_close($polaczenie);
			}
				//jeśli dane nie są w użyciu dodanie nowego użytkownika do tabeli users
			else 
			{
				
				$sql = "INSERT INTO users (login, password, email) VALUES ('$login', '$haslo','$email')";

						if (mysqli_query($polaczenie, $sql)) 
						{
							//Przeniesienie do strony logowania, wyswietlenie komunikatu
							$_SESSION['blad'] = '<span style="color:green"><b>Dodano nowe konto !</b></span>';
							header('Location: index.php');
						} 
						else 
						{
							echo "Error: " . $sql . "<br>" . mysqli_error($polaczenie);
						}
						//zamkniecie połączenia
						mysqli_close($polaczenie);
				
			}
		}
		}
		
?>
