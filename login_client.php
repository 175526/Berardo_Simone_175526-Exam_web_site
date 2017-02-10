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
    
	<script type="text/javascript" src="jscript_controllo.js"></script>
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
	<p><?php
			if(isset($_COOKIE['nomeutente'])){
				$nomeutente=$_COOKIE['nomeutente'];
			}else{
					$nomeutente="";
				}
			if(isset($_SESSION['loggedin'])){
				echo"<p>Sei gi&agrave; stato autenticato. Se intendi disconnetterti clicca su: <a href=\"logout.php\">Logout</a></p>";
			}else{
				echo"<p>BENVENUTO!<br>Se sei registrato, inserisci un nickname ed una password validi!</p>";
				echo"<form name=\"login\" action=\"login_server.php\" method=\"POST\" onsubmit=\"return validateLoginInput(user.value, pass.value);\">";
				echo"<p><label for=\"user\">Nome utente: </label><input type= \"text\" class=\"text\" id=\"user\" name=\"user\" value=\"$nomeutente\">";
				echo"<p><label for=\"pass\">Password: </label><input type=\"password\" id=\"pass\" class=\"text\" name=\"pass\">";
				echo"<p><input type=\"submit\" value=\"OK\" class=\"button_sub\"><input type=\"button\" onclick=\"clearLoginText();\" value=\"PULISCI\" class=\"button_reset\"></p>";
				echo"</form>";
			}
		?></p>
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