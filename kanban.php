<?php
//dołączenie pliku dane
require_once "dane.php";

// Sprawdzenie czy użytkownik nie jest zalogowany, jeśli nie jest przeniesienie do index.php
if (!isset($_SESSION['zalogowany'])){
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl">
  <head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
    <title>Kanban</title>
  </head>
  <body>
    <div class="all"> 
		<div id="logout"> 
			<?php
				//Wylogowanie z konta
				echo "<p>Zalogowany jako: <b>".$_SESSION['user'].' !</b>  <a href="logout.php" id="wyloguj">Wyloguj się !</a> </p>';
			?>
		</div>
      <div class="con_results  ">
        <h2>KANBAN</h2>
      </div>
      <div class="container task_con">
		
			<div class="box">
			  <h2>Do zrobienia</h2>
			  <!--  Pozwala upuszczać bloki  -->
			  <div id="task_id1" class="items " ondrop="drop(event)" ondragover="allowDrop(event)">
				<?php
				  //Wyświetlenie zadań "Do zrobienia"
				  foreach($found as $item){
					foreach($task_id1 as $ver){
					  if($item['id'] == $ver){
						  //Ustawienie, że bloki zadań można przenosić, ustawienie klasy dla każdego poziomu trudności
						 //Ustawienie Id każdemu zadaniu, wyświetlenie task i description, przycisk do usuwania
						echo '<div class="item color_'.$item['difficulty'].'" id="task_'.$ver.' drag'.$ver.'" draggable="true" ondragstart="drag(event)">';
						echo '<h3>'.$item['task'].'</h3>';
						echo '<p>'.$item['description'].'</p>';
						echo '<button class="kosz" header="Usuń zadanie "></button>';
						echo '</div>';
					  }
					}
				  };
				?>
			  </div>
			</div>
			<div class="box">
			  <h2>W trakcie</h2>
			  <div id="task_id2" class="items" ondrop="drop(event)" ondragover="allowDrop(event)">
				<?php 
				 //Wyświetlenie zadań "W trakcie"
				foreach($found as $item){
				  foreach($task_id2 as $ver){
					if($item['id'] == $ver){
					  echo '<div class="item color_'.$item['difficulty'].'" id="task_'.$ver.' drag'.$ver.'" draggable="true" ondragstart="drag(event)">';
					  echo '<h3>'.$item['task'].'</h3>';
					  echo '<p>'.$item['description'].'</p>';
					  echo '<button class="kosz" header="Usuń zadanie"></button>';
					  echo '</div>';
					}
				  }
				};
				?>
			  </div>
			</div>
			<div class="box">
			  <h2>Do sprawdzenia</h2>
			  <div id="task_id3" class="items" ondrop="drop(event)" ondragover="allowDrop(event)">
				<?php 
				 //Wyświetlenie zadań "Do sprawdzenia"
				foreach($found as $item){
				  foreach($task_id3 as $ver){
					if($item['id'] == $ver){
					  echo '<div class="item color_'.$item['difficulty'].'" id="task_'.$ver.' drag'.$ver.'" draggable="true" ondragstart="drag(event)">';
					  echo '<h3>'.$item['task'].'</h3>';
					  echo '<p>'.$item['description'].'</p>';
					  echo '<button class="kosz" header="Usuń zadanie"></button>';
					  echo '</div>';
					}
				  }
				};
				?>
			  </div>
			</div>
			<div class="box">
			  <h2>Zrobione</h2>
			  <div id="task_id4" class="items" ondrop="drop(event)" ondragover="allowDrop(event)">
				<?php 
				 //Wyświetlenie zadań "Zrobione"
				foreach($found as $item){
				  foreach($task_id4 as $ver){
					if($item['id'] == $ver){
					  echo '<div class="item color_'.$item['difficulty'].'" id="task_'.$ver.' drag'.$ver.'" draggable="true" ondragstart="drag(event)">';
					  echo '<h3>'.$item['task'].'</h3>';
					  echo '<p>'.$item['description'].'</p>';
					  echo '<button class="kosz" header="Usuń zadanie"></button>';
					  echo '</div>';
					}
				  }
				};
				?>
			 
			</div>
      </div>
	  </div>
      <script>
        //Obsługa kosza
        $('.kosz').click(function() {
          //Wyciągnięcie id usuwanego zadania
          $parent = $(this).parent();
          $task_id = $parent.attr('id').substring(5);
          
          //Wysłanie potrzebnych danych do pliku usun.php.
          $.ajax({
            type: "POST",
            url: "usun.php",
            data: { task_id: $task_id }
          })
			//"schowanie" usuniętego zadania
		   $parent.slideUp(1);
        });
      </script>
      <br><br>
	  <!-- Formularz dodający nowe zadanie po kliknięciu Dodaj zadanie wykonanie skryptu dodaj.php -->
      <h3>Dodaj nowe zadanie</h3>
      <form action="dodaj.php" method="post">
        <label>Nazwa zadania:<input type="text" name="task" required></label>
        <label>Opis:<input type="text" name="description" required></label>
        <label>Poziom trudności (1-5):<input type="number" min="1" max="5" name="difficulty" required></label>
        <label>Status:
          <select name="state" id="state">
            <option value="do zrobienia">Do zrobienia</option>
            <option value="w trakcie">W trakcie</option>
            <option value="do sprawdzenia">Do sprawdzenia</option>
            <option value="zrobione">Zrobione</option>
          </select></label>
        <input type="submit" value="Dodaj zadanie">
      </form>
      <script>
        var currentbox; 
        var currentparent;
        
        //Ustawienie gdzie można upuszczać przegmiot
        function allowDrop(ev){
          ev.preventDefault();
          ev.returnValue = false;
        }
        
        //Ustawienie które przedmioty mozna przenosić
        function drag(ev) {
          ev.dataTransfer.setData("text", ev.target.id);
          currentbox = ev.target.id.substring(5, 7);
        }
        
        //Po upuszczeniu przedmiotu 
        function drop(ev) {
          ev.preventDefault();
          var data = ev.dataTransfer.getData("text");
          ev.target.appendChild(document.getElementById(data));
          currentparent = $(document.getElementById(data)).parent().attr('id');
          
          //Wysłanie danych currentbox- obecny element  i currentparent- nowy state do aktualizuj.php
          $.ajax({
            type: "POST",
            url: "aktualizuj.php",
            data: { item: currentbox, parent: currentparent}
          })
        }
        
        //Blokada wkładania zadań do zadań.
        $(document).ready(function(){
          $('.item').on('drop', function() {
            return false;
          });
        });
      </script>
   

    </div>
	
  </body>
</html>