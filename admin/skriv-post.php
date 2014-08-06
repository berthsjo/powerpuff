<?php
// Inkluderar config-filen 
require_once('../includes/config.php');

// Sidan består av formulär som är uppbyggd med textområden och inputs.
// Varje del blir en variabel i PHP när formuläret skickas. 
// Vi använder också ett litet färdigt verktyg som heter tinyMCE för att redigera/lägga till inlägg (http://www.tinymce.com).

// Om man inte är inloggad skickas man till login.php
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Skriv inlägg</title>
  <link rel="stylesheet" href="../css/meyerReset.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>

  <script>
  	// Konverterar alla textområden till tinyMCE-editorn
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('meny.php');?>
	<p><a href="./">Admin Index</a></p>

	<h2>Skriv inlägg</h2>

	<?php

	// Om formuläret har skickats bearbetas den:
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		// Samlar formulärsinformationen (datan)
		extract($_POST);

		// Validerar
		if($postTitle ==''){
			$error[] = 'Lägg till titel.';
		}

		if($postDesc ==''){
			$error[] = 'Lägg till beskrivning.';
		}

		if($postCont ==''){
			$error[] = 'Lägg till innehåll.';
		}

		if(!isset($error)){

			try {

				// Inkluderar i databasen
				$stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s')
				));

				// Omdirigerar till indexsidan
				header('Location: index.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}