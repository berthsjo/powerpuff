<?php
// Inkluderar config-filen
require_once('../includes/config.php');

// I princip byggd som skriv post sidan.
// Använder UPDATE statement istället för INSERT INTO för att matcha rätt kolumner och placeholders(rutor).
// Om man inte är inloggad skickas man till login.php
if(!$user->is_logged_in()){ header('Location: loggain.php'); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Redigera inlägg</title>
  <link rel="stylesheet" href="../css/meyerReset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
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

				// Inkluderar i databasen
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				// Omdirigerar till indexsidan
				header('Location: index.php?action=');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>
	<?php

		function hashtag($string) {
		//variabel kopplad till #
		$htag = "#";
		// använder explode-funktionen för att konvertera strängen //till en array
		//mellanrummet signalerar ny item i arrayen

		$arr = explode(" ", $string);
		$arrc = count($arr);
		$i = 0;

		// whileloop söker igenom arryen efter en hashtag
		while($i< $arr){

		  if (substr($arr[$i], 0, 1) === $htag) {
		  // så att #-markerade ord blir länkar
		  echo $arr[$i] = "<a href='#'>".$arr[$i]."</a>";

		  }

		  $i++;
		}
		//gör arrayen tillbaka till en sträng
		$string = implode(" ", $arr);
		return $string;
		}

		?>
	<?php
	// Kollar efter fel och hämtar felmeddelande
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
	<div class="tiny">
		<form action='' method='post'>
			<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

			<p><label>Titel</label><br />
			<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

			<p><label>Beskrivning</label><br />
			<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

			<p><label>Innehåll</label><br />
			<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

			<div class="tinybutton"><input type='submit' name='submit' value='Uppdatera'></div>

		</form>
	</div>
</div>

</body>
</html>