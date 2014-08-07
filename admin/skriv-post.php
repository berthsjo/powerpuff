<?php
// Inkluderar config-filen
require_once('../includes/config.php');

// Sidan består av formulär som är uppbyggd med textområden.
// Varje del blir en variabel i PHP när formuläret skickas.
// Vi använder också ett litet färdigt verktyg som heter tinyMCE för att redigera/lägga till inlägg (http://www.tinymce.com).
// Om man inte är inloggad skickas man till login.php
if(!$user->is_logged_in()){ header('Location: loggain.php'); }
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

	// Kollar efter fel
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>
	<div class="tiny">
		<form action='' method='post'>

			<p><label>Titel</label><br />
			<input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

			<p><label>Beskrivning</label><br />
			<textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

			<p><label>Innehåll</label><br />
			<textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

			<div class="tinybutton"><input type='submit' name='submit' value='Skicka'></div>

		</form>
	</div>
</div>