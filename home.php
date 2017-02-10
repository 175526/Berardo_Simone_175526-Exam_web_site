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
	<div class="header">
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
	<h2>Benvenuto!</h2><p> Grazie a questo sito web potrai acquistare on-line, comodamente seduto a casa tua, vario genere
							di materiale informatico. Fai il login per iniziare i tuoi acquisti oppure, se non sei ancora registrato,
							vai alla voce NEW sul men&ugrave e registrati!</p>
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