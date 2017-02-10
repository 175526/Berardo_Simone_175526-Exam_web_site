<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
    <Title>Home</Title>
    <meta name="author" content="Simone Berardo">
    <meta name="keywords" content="Online_shop_Informatica">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="./stampa.css" media="print">
	<link href="https://fonts.googleapis.com/css?family=Kumar+One" rel="stylesheet">
    
</head>
<!--Parte del Body-->
<body>
<!--intestazione e login-->
<div class="container">
	<div class='header'>
	<?php
	require("header.php");
	?>
	</div>
	
	<!--menù-->
	<div class="navigation">
	<?php
	require("menu.php");
	?>
	</div>
	
<!--contenuto della home-->
	<div class="content">
	
	<div id="testo_body"><div id="immagineHome"></div>
	<?php
	if(!isset($_REQUEST["user"]) || !isset($_REQUEST["pass"])){
		echo"<p>Bisogna prima effettuare il <a href='login_client.php'>Login</a></p>";
	}
	else if(empty($_REQUEST["user"]) || empty($_REQUEST["pass"])){
		echo"<p>Attenzione! Uno o pi&ugrave campi non sono stati compilati! <a href='login_client.php'>Torna al Login</a></p>";
	}
	else{
	
		$user=trim($_REQUEST["user"]); //pulisco le variabili dagli evetuali spazi
		$pass=trim($_REQUEST["pass"]);
		$con=mysqli_connect("localhost","uNormal","W4bynDrD8dVnpafP","informatica"); //connessione al DB 
		
		if (mysqli_connect_errno()) //coontrollo eventuale errori di connessione
		  printf("<p>Errore!! Impossibile collegarsi al DB: %s<p>\n", mysqli_connect_error());
		else{  
			
			$user=mysqli_real_escape_string($con,$user); /*Ripulisco da apici le variabili, per evitare il sql injection */
			$pass=mysqli_real_escape_string($con,$pass);
			
			$query = "SELECT * FROM utenti WHERE nick='$user' AND pass='$pass'"; //preparo la query
			$result = mysqli_query ($con, $query);
			if (!$result){
			  printf ("<p>Errore – query fallita: %s<p>\n", mysqli_error($con));
			}
			else if (mysqli_num_rows($result)==0){ //se ==0 significa che non ha trovato nulla di corrispondente alla query
			  printf("Nome utente e/o password non corretti. <a href='login_client.php'>Riprova</a>");
			}
			else{
			  /*comincio una nuova sessione*/
			  session_start();
			  $row = mysqli_fetch_assoc($result);
			  $_SESSION['loggedin'] = $row['nick'];                     
			  $_SESSION['pass'] = $row['pass'];
			  $scadenza=time() + 60*60*24*7;          
			  setcookie("nomeutente", $row['nick'], $scadenza);
			  header('location: info.php');    
			}
		}
	}
	?>
	</div></div>
	
	<!--footer-->
	<div class="footer_fixed">
	<?php
	require("footer.php");
	?>
	</div>
</div>
</body>
</html>