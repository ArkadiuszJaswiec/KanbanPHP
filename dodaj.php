<?php
	//uruchomienie sesji
	session_start();
	//połączenie z bazą danych
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		//Zapisanie danych pobranych z formularza do zmiennych 
		$user_id= $_SESSION['id'];
		$task= $_POST['task'];
		$description= $_POST['description'];
		$difficulty= $_POST['difficulty'];
		$state= $_POST['state'];
		
		//Zapytanie dodające nowe zadanie do tabeli zadania
 $sql = "INSERT INTO zadania (id, id_usr, state, task, description, difficulty)
		VALUES (NULL, $user_id, '$state', '$task', '$description', $difficulty)";	

			if($polaczenie -> query($sql)=== TRUE)
			{
				// Po wykonaniu powrót do kanban.php
				header ('Location: kanban.php');
			}
			echo "Error: ".$sql. "<br>". $polaczenie->error;
	}
	//zakończenie połączenia
	$polaczenie->close();
	?>