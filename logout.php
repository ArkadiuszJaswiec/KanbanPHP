<?php
	session_start();
	//wylogowanie z sesji
	session_unset();
	
	header('Location: index.php');

?>