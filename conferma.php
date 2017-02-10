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
	<?php 
		function checkInputQty(){
			
			$con=mysqli_connect("localhost","uPower","WZ86aaybTcNzundP","informatica"); 
			if (mysqli_connect_errno()) 
				printf("<p>Errore!! Impossibile collegarsi al DB, non &egrave possibile mostrare a video le info sui prodotti: %s<p>\n", mysqli_connect_error());
			else{
				$i=0;
				$totale = 0;
				$flag = true;
				$qty_flag = true;
				$query = "SELECT * FROM prodotti"; 
				$result = mysqli_query ($con, $query);
				$nrow = mysqli_num_rows($result);
				echo "<table class=\"tabella\">";
				echo "<thead>";
				echo "<tr><th colspan=\"3\">RIASSUNTO ACQUISTI</th></tr>";
				echo "<tr><th>Nome</th><th>Pezzi ordinati</th><th>Prezzo</th></tr>";
				echo "</thead>";
				echo "<tbody>";
				while($row = mysqli_fetch_assoc($result)){ 
					$pid = $row["pid"];
					if(isset($_REQUEST["nome".$pid]) && preg_match('/^\d+$/', $_REQUEST["nome".$pid])){
							$qty = trim($_REQUEST["nome".$pid]);
							if($qty == 0)
								$i++;
							if($qty>$row["qty"])
								$qty_flag = false;
							if($qty>0 && $qty<=$row["qty"]){
								$totale = $totale + ($qty*$row["prezzo"]);
								$new_qty = $row["qty"]-$qty;
								$query2 = "UPDATE prodotti SET qty = '$new_qty' WHERE qty = '".$row["qty"]."' ";
								$result2 = mysqli_query ($con, $query2);
								if($result){
									costruisci_contenuto($row["nome"],$qty,$row["prezzo"]/100);
								}	
								else
									echo "<p>Errore, query non eseguita! <a href='acquista.php'>RIPROVA</a></p>";
							}
					}else 
						$flag = false;		
				}
				echo "</tbody>";
				echo "<tfoot>";
				echo "<tr><th >Totale</th><th colspan=\"2\">".($totale/100)." &#8364</th></tr>";
				echo "</tfoot>";
				echo "</table>";
				mysqli_free_result($result);
				
				
				
			}
		mysqli_close($con);	
		if($flag == false)
			header('location: errore_input_acquisti.php');
		else{
			if($i == $nrow)
					header('location: riprova_acquisti.php');
				else{
					if($qty_flag == false)
						header('location: errore_qty_acquisti.php');
					else{
						echo "<input type=\"button\" onclick=\"location.href='finale.php'\" value=\"OK\" class=\"button_sub\">";
						echo "<noscript><a href=\"finale.php\"><br>Il tuo browser non &egrave abilitato a leggere file Javascript clicca questo link per confermare gli acquisti</a></noscript>";				
					}
					
				}
		}
				
		}
	?>
	
	<?php
	 function costruisci_contenuto($nome,$ordinati,$prezzo){
		echo "<tr><th>$nome</th><th>$ordinati</th><th>$prezzo &#8364</th></tr>";
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
	<div id="testo_body">
	
	
	<?php
	 checkInputQty();
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