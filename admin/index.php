<?php
// Inkluderar config-filen 
require_once('../includes/config.php');

// Kollar om användaren är inloggad, annars skickas man till loggain.php
if(!$user -> is_logged_in()) { header('Location: loggain.php'); }

if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="../css/meyerReset.css">
  <link rel="stylesheet" href="../css/style.css">
  <script language="JavaScript" type="text/javascript">

  // Funktion som raderar inlägg och redirectar
  function delpost(id, title)
  {
  	if (confirm("Är du säker på att du vill radera '" + title + "'"))
	  {
	  	window.location.href = 'index.php?delpost=' + id;
	  }
  }
  </script>
</head>
<body>

	<div id="wrapper">
	
	<?php 
	// Lägger till menyn
	include('meny.php');?>

	<?php 
	// Hämtar meddelande från skriv-post/redigera-post
	if(isset($_GET['action'])){ 
		echo '<h3>Post '.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table>
	<tr>
		<th>Titel</th>
		<th>Datum</th>
		<th>Action</th>
	</tr>

	<?php
		// Skapar en tabell för att hantera posterna (loopar) och visar de i ordning (med hjälp av query) 
		// Varje inlägg har en redigera/radera länk som kallar på funktionen "delpost"
		// Delpost baseras på postID. När man klickar på länken körs en confirm som frågar ifall man vill radera ett inlägg
		try {

			$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>

				<td>
					<a href="redigera-post.php?id=<?php echo $row['postID'];?>">Redigera</a> | 
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Radera</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='skriv-post.php'>Lägg till</a></p>

</div>

</body>
</html>