<?php
	//Rozpoczęcie sejsi
	session_start();
	//Połączenie z bazą
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		//Przypisanie id użytkownika do zmiennej 
		 $user_id = $_SESSION['id'];
		 // Tworzenie zapytania wyświetlającego dane z połączonych tabel z bazy danych
		 $sql = "SELECT users.login, zadania.id, zadania.state, zadania.task, zadania.description, zadania.difficulty FROM zadania 
		 INNER JOIN users ON zadania.id_usr= users.id WHERE users.id= '$user_id'";
		 
		 //Uruchomienie zapytania
		 $found = $polaczenie->query($sql);
		 //deklaracja tablic do których wpiszemy konkretne taski
		 $task_id1 = [];
		 $task_id2 = [];
		 $task_id3 = [];
		 $task_id4 = [];
		 foreach ($found as $item)
		 {
			 if($item['state']== "do zrobienia")
			 {
				 array_push($task_id1, $item['id']);
			 }
			  if($item['state']== "w trakcie")
			 {
				 array_push($task_id2, $item['id']);
			 }
			 if($item['state']== "do sprawdzenia")
			 {
				 array_push($task_id3, $item['id']);
			 }
			 if($item['state']== "zrobione")
			 {
				 array_push($task_id4, $item['id']);
			 }
		 };
		//zamknięcie połączenia
		$polaczenie->close();
		
	}
?>