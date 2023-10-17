<?php
	//Uruchomienie sesji
	session_start();
	//Połączenie z bazą
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else //Jeśli połączenie jest udane to przypisanie $_POST["task_id"] do zmiennej
	{
		$task_id = $_POST["task_id"];
		$found=0;
		//Zapytanie sprawdzające czy istnieje w bazie zadanie o pobranym id
		$sql_sel = "SELECT * FROM zadania WHERE id= '$task_id';";
		$found=$polaczenie->query($sql_sel);
			
			//Jeśli istnieje to je usuwamy
			if($found->num_rows>0)
			{
				$sql= "DELETE FROM zadania WHERE id= '$task_id';";
				
				
				//Wykonanie polecenia, przechwycenie ewentualnych błędów
				if($polaczenie->query($sql)===TRUE)
				{
					echo "Usunięt zadanie ";
				}
				else {
					echo "Error: ". $polaczenie->error;
				}
			}
				else
				{
					echo "Nie ma takiego zadania ";
				
				}
			//Zamknięcie połączenia
			$polaczenie->close();
			}
			?>