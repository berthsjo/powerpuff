<?php
// Inkluderar config-filen 
require_once('../includes/config.php');

// Det här är en ganska simpel inloggningssida, först kollar den om man redan är inloggad
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Logga in Admin</title>
  <link rel="stylesheet" href="../css/meyerReset.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div id="loggain">


	<?php

	// Bearbetar formuläret ifall man har fyllt i fälten
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if($user->loggain($username,$password)){ 

			// Efter att man loggat in, skickas man till indexsidan
			header('Location: index.php');
			exit;
		

		} else {
			$message = '<p class="fel">Fel användarnamn och/eller lösenord</p>';
		}
	}

	// Skapar ett formulär för att hantera användarnamn och lösenord
	if(isset($message)){ echo $message; }
	?>

	<form action="" method="post">
	<p><label>Användare</label><input type="text" name="username" value=""  /></p>
	<p><label>Lösenord</label><input type="password" name="password" value=""  /></p>
	<p><label></label><input type="submit" name="submit" value="Login"  /></p>
	</form>

</div>
</body>
</html>
