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
    
	<script type="text/javascript" src="jscript_controllo_qty_acquista.js"></script>
	
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
	<div id="testo_body_dinamic">
	<?php
	if(!isset($_SESSION['loggedin'])){
		header('location: errore_login_acquisti.php');
	}else{
		$con=mysqli_connect("localhost","uPower","WZ86aaybTcNzundP","informatica"); 
			if (mysqli_connect_errno()) 
			  printf("<p>Errore!! Impossibile collegarsi al DB, non &egrave possibile mostrare a video le info sui prodotti: %s<p>\n", mysqli_connect_error());
			else{
				$query = "SELECT * FROM prodotti"; 
				$result = mysqli_query ($con, $query);
				$nrow = mysqli_num_rows($result);
			echo"<p>".$_SESSION['loggedin']."!<br>Inserisci la quanti&agrave del prodotto desiderato per selezionarlo</p>";
			echo "<form name=\"acquista\" action=\"conferma.php\" method=\"POST\" onsubmit=\"return checkInputQty();\">";
			echo"<table>";
			echo "<thead>";
			echo"<tr><th>Nome Prodotto</th><th>Prezzo</th><th>Disponibilit&agrave</th><th>Quantit&agrave</th></tr>";
			echo"</thead>";
			echo "<tbody>";
				 while ($row = mysqli_fetch_assoc($result)){
					$pid = $row["pid"];
					$nome = $row["nome"];
					$qty = $row["qty"];
					$prezzo = ($row['prezzo'])/100;
					echo"<tr><th>$nome</th><th>".number_format($prezzo,2,',', '')." &#8364</th><th>$qty</th><th><input type=\"text\" id=\"$pid\" name=\"nome".$pid."\" value = \"0\"></th></tr>";
				}
			echo "</tbody>";
			echo"</table>";
			echo "<input type=\"submit\" value=\"ACQUISTA\" class=\"button_sub\" ><input type=\"button\" onclick=\"clearText()\" value=\"CANCELLA\" class=\"button_reset\">";	
			echo "</form>";
				mysqli_free_result($result);
				mysqli_close($con);
			}		
	}	
	?>
	</div>
	</div>
	
<!--footer-->
	<div class="footer_fixed">
	<?php
	require("footer.php");
	?>
	</div>
</body>
</html>