<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
   <head>
    <Title>NEW</Title>
    <meta name="author" content="Simone Berardo">
    <meta name="keywords" content="Online_shop_Informatica">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="./stampa.css" media="print">
	<link href="https://fonts.googleapis.com/css?family=Kumar+One" rel="stylesheet">
    
	<script type="text/javascript" src="jscript_controllo.js"></script>
	<?php
		function checkInput_server_side(){
			if(isset($_REQUEST["user"]) && isset($_REQUEST["pass"]) && isset($_REQUEST["repeat"])){
				$user=trim($_REQUEST["user"]); //pulisco le variabili dagli evetuali spazi
				$pass=trim($_REQUEST["pass"]);
				$repeat=trim($_REQUEST["repeat"]);
				if($user==""){
					echo"<p>Attenzione! Nickname non inserito <a href='new.php'>Riprova</a></p>";
				}
				else if($pass==""){
				  echo"<p>Attenzione! Password non inserita <a href='new.php'>Riprova</a></p>"; 
				}
				else if($repeat!= $pass){
				  echo"<p>Attenzione! Le Password devono essere uguali <a href='new.php'>Riprova</a></p>";
				}
				else if(checkUsername($user)!=true){
					echo"<p>Attenzione! Nickname non conforme <a href='new.php'>Riprova</a></p>";
				}else if(!preg_match('/^[0-9]{4,}$/',$pass)){
					echo"<p>Attenzione! Password non conforme <a href='new.php'>Riprova</a></p>";
				}else
					insert_utente();
			}
		}
		
		function checkUsername($user){
		
		$flag = false;
		if(preg_match('/^[a-zA-Z\$]{1,1}[a-zA-Z0-9\$]{2,9}$/',$user)){
			if(preg_match('/[0-9]+/',$user)){
				if(preg_match('/[A-z\$]+/',$user))
					$flag=true;
			}
		}
			return $flag;
		}
	?>
	<?php 
	 function insert_utente(){
		$con=mysqli_connect("localhost","uPower","WZ86aaybTcNzundP","informatica"); 
			if (mysqli_connect_errno()) 
			  printf("<p>Errore!! Impossibile collegarsi al DB: %s<p>\n", mysqli_connect_error());
			else{
				$query1 = "SELECT nick,pass FROM utenti"; //preparo la query
				$result1 = mysqli_query ($con, $query1);
				$flag = true;
				if(isset($_REQUEST["user"]) && isset($_REQUEST["pass"])){
					while ($row = mysqli_fetch_assoc($result1)){
						if(($_REQUEST["user"]==$row["nick"]) && ($_REQUEST["pass"]==$row["pass"])){
							echo "<p>Utente gi&agrave registrato!</p>";  
							$flag = false;
						}else if($_REQUEST["user"]==$row["nick"]){
							echo "<p>Il nickname &egrave gi&agrave presente nel DataBase, scegline un altro! <a href='new.php'>Riprova</a></p>";
							$flag = false;
						} 	
						if($flag == false)
							return;
					}
					
				mysqli_free_result($result1); //rilascio la memoria occupata dalla prima query, per non intasarla
				
					if($flag){
						$user = trim($_REQUEST["user"]);
						$pass = trim($_REQUEST["pass"]);
						$user=mysqli_real_escape_string($con,$user); /*Ripulisco da apici le variabili, per evitare il sql injection */
						$pass=mysqli_real_escape_string($con,$pass);
						$query2 = "INSERT INTO utenti (nick, pass) VALUE ('$user', '$pass')";
						$result2 = mysqli_query($con, $query2);
						if(!$result2)
							echo "<p>Inserimento dati nel databsase NON RIUSCITA</p>";
						else{
							session_start();
							$_SESSION['loggedin'] = $user ;                     
							$_SESSION['pass'] = $pass;
							$scadenza=time() + 60*60*24*7;          
							setcookie("nomeutente", $user, $scadenza);
							header('location: info.php');    
						}
					mysqli_free_result($result2);
					}else
						echo "<p>Inserimento dati nel databsase NON RIUSCITA</p>";
				}
				
			}
			
		mysqli_close($con);		
	}
	?>
</head>
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
	<div id="immagineHome"></div><div id="testo_body">
	<?php 
	if(!isset($_SESSION['loggedin'])){
		echo "<div class=\"form-group\">";
		echo "<p>In questa pagina puoi effettuare la tua registrazione al sito. Inserisci un nickname ed una password validi!</p>";
		echo "<form name=\"new\" action=\"\" method=\"POST\" onsubmit=\"return validateNewInput(user.value, pass.value, repeat.value);\">";
		echo "<p><label for=\"user\">Nome utente: </label><input type= \"text\" class=\"text\" id=\"user\" name=\"user\"><input type=\"button\" class=\"info\" onclick=\"info_user()\" value=\"Info\" class=\"button\"></p>";
		echo "<p><label for=\"pass\">Password: </label><input type=\"password\" id=\"pass\" class=\"text\" name=\"pass\"><input type=\"button\" class=\"info\" onclick=\"info_pass()\" value=\"Info\" class=\"button\"></p>";
		echo "<p><label for=\"repeat\">Ripeti Password: <label><input type=\"password\" id=\"repeat\" class=\"text\" name=\"repeat\"></p>";
		echo "<p><input type=\"submit\" value=\"CREA\" class=\"button_sub\"><input type=\"button\" onclick=\"clearText();\" value=\"CANCELLA\" class=\"button_reset\"></p>";
		echo "</form></p>";
		echo "</div>";
		checkInput_server_side();	
	}else
		echo "Sei gi&agrave loggato al sito, vai su <a href='acquista.php'>ACQUISTA</a> se vuoi iniziare i tuoi acquisti,<br>
					su <a href='info.php'>INFO</a> se vuoi saperne di pi&ugrave sui nostri prodotti oppure fai <a href='logout.php'>LOGOUT</a> per uscire e inserire un nuovo utente";
	?>
	</div>
	</div>
	
<!--footer-->
	<div class="footer_fixed">
	<?php
	require("footer.php");
	?>
	</div>
</div>
</body>
</html>