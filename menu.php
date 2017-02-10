
	<ul id="menu">
		<li><a href="./home.php">HOME</a></li>
		<li><a href="./new.php">NEW</a></li>
		<li><a href="./info.php">INFO</a></li>
		<li><a href="./acquista.php">ACQUISTA</a></li>
		<?php
			if(!isset($_SESSION['loggedin']))
				echo"<li><a href=\"login_client.php\">LOGIN</a></li>";
			else
				echo"<li><a class=\"not-active\"\">LOGIN</a></li>";
		?>
		<?php
			if(isset($_SESSION['loggedin']))
				echo"<li><a href=\"logout.php\">LOGOUT</a></li>";
		?>
	</ul>

