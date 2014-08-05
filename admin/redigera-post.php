<?php
// Inkluderar config-filen 
require_once('../includes/config.php');

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
  	// Konverterar alla textområden till tinymce-editorn
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
	<p><a href="./">Blog Admin Index</a></p>

	<h2>Redigera inlägg</h2>


	<?php

	// Om formuläret har skickats bearbetas den:
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		// Samlar formulärsinformationen (datan)
		extract($_POST);

		// Validerar

	if($postID ==''){
			$error[] = 'Detta inlägget saknar ett giltigt id!.';
		}

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

				// Inkludera i databasen
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				// Omdirigera till indexsidan
				header('Location: index.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>

	<?php
	// Kollar efter fel
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	