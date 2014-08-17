<?php
// Inkluderar config-filen
require_once('../includes/config.php');

// Kollar om användaren är inloggad, annars skickas man till loggain.php
if(!$user->is_logged_in()){header('location:loggain.php'); }

// Visar meddelande från skriv-post / redigera-post sidan
if(isset($_GET['deluser'])){

  // Garanterar minst en användare vars ID inte kan raderas övriga kan raderas.
  //OBS! Vi har endast en anv. men vill ev. kunna lägga till fler
  if($_GET['deluser'] !='1'){

    $stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
    $stmt->execute(array(':memberID' => $_GET['deluser']));

    header('Location: users.php?action=deleted');
    exit;

  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Användare</title>
  <link rel="stylesheet" href="../css/meyerReset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
  <script language="JavaScript" type="text/javascript">
  function deluser(id, title)
  {
    if (confirm("Är du säker på att du vill radera '" + title + "'"))
    {
      window.location.href = 'users.php?deluser=' + id;
    }
  }
  </script>
</head>
<body>

  <div id="wrapper">

  <?php include('meny.php');?>

  <?php
  // Visar meddelande från skriv-post och redigera-post
    if(isset($_GET['action'])){
    echo '<h3>User '.$_GET['action'].'.</h3>';
  }
  ?>

    <table>
  <tr>
    <th>Användarnamn</th>
    <th>Email</th>
  </tr>
  <?php
    try {

      $stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
      while($row = $stmt->fetch()){

        echo '<tr>';
        echo '<td>'.$row['username'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        ?>


        <?php
        echo '</tr>';

      }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  ?>
  </table>


</div>

</body>
</html>

