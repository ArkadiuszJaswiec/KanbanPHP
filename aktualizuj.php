<?php
// Uruchomienie sesji
session_start();

//Połączenie z bazą
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if ($polaczenie->connect_errno!=0){
  echo "Error: ".$polaczenie->connect_errno;
}
else{
  //Przy poprawnym połączeniu przypisanie pobranych wartości do zmiennych
  $item = $_POST["item"];
  $parent = $_POST["parent"];
  
  //Sprawdzenie jaki jest nowy status
  if($parent == "task_id1"){
    $state = "do zrobienia";
  }
  if($parent == "task_id2"){
    $state = "w trakcie";
  }
  if($parent == "task_id3"){
    $state = "do sprawdzenia";
  }
  if($parent == "task_id4"){
    $state = "zrobione";
  }
  
  //zapytanie aktualizujące statu
  $sql ="UPDATE zadania SET state='$state' WHERE id=$item;";
  
  //Wykonanie polecenia jeśli jest poprawawne
  if ($polaczenie->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $connection->error;
  }
  
  //Zamknięcie połączenia.
  $polaczenie->close();
}
?>