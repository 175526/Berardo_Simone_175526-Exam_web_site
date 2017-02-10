<?php
session_start();
if(isset($_SESSION['loggedin'])){
  $loggedin=$_SESSION['loggedin'];
}
else{
  $loggedin="ANONIMO";
}
?>
<div class='title'><h1>Shopping Online Informatica</h1></div>
	<div class='nick'><?php echo "$loggedin";?></div>
	
