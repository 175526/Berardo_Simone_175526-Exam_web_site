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
<body>

<!--intestazione e login-->
<div class="container">
	<div id='header'>
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
		
			$con=mysqli_connect("localhost","uNormal","W4bynDrD8dVnpafP","informatica"); //connessione al DB 
			if (mysqli_connect_errno()) //coontrollo eventuale errori di connessione
			  printf("<p>Errore!! Impossibile collegarsi al DB, non &egrave possibile mostrare a video le info sui prodotti: %s<p>\n", mysqli_connect_error());
			else{
				$query = "SELECT * FROM prodotti"; //preparo la query
				$result = mysqli_query ($con, $query);
				
				if(!isset($_SESSION['loggedin'])){
					echo"<p>Ecco l'elenco dei prodotti acquistabili nel nostro negozio, per maggiori informazioni fai <a href=\"login_client.php\">LOGIN</a></p>";
					echo"<table>";
					echo "<thead>";
					echo"<tr><th>ID Prodotto</th><th>Nome Prodotto</th></tr>";
					echo "</thead>";
					echo "<tbody>";
					 while ($row = mysqli_fetch_assoc($result)){
						echo"<tr><th>".$row['pid']."</th><th>".$row['nome']."</th></tr>";
					 }
					echo "</tbody>";
					echo"</table>";
				}else{
					echo"<p><h2>Benvenuto/a ".$_SESSION['loggedin'].",</h2>Ecco l'elenco dei prodotti acquistabili nel nostro negozio, relativi prezzi e disponibilit&agrave in magazzino</p>";
					echo"<table class=\"tabella\">";
					echo "<thead>";
					echo"<tr><th>ID Prodotto</th><th>Nome Prodotto</th><th>Prezzo</th><th>Quantit&agrave</th></tr>";
					echo "</thead>";
					echo "<tbody>";
					 while ($row = mysqli_fetch_assoc($result)){
						$prezzo = ($row['prezzo'])/100;
						echo"<tr><th>".$row['pid']."</th><th>".$row['nome']."</th><th>".number_format($prezzo,2,',', '')." &#8364</th><th>".$row['qty']."</th></tr>";
					 }
					echo "</tbody>";
					echo"</table>";
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
</div>
</body>
</html>