<?php 
// Inkludera config.php i varje fil
require_once('../includes/config.php');

// Om man inte är inloggad skickas man tillbaka till logga in framsidan
if(!$user->is_logged_in()){header('location:login.php'); }

// Visa meddelande från skriv-post / redigera-post sidan
if(isset($_GET['deluser'])){

  // Om användarid är 1 så ignorera, man ska inte kunna radera denna
  if($_GET['deluser'] !='1'){

    $stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
    $stmt->execute(array(':memberID' => $_GET['deluser']));

    header('Location: users.php?action=deleted');
    exit;

  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Användare</title>
  <link rel="stylesheet" href="../css/meyerReset.css">
  <link rel="stylesheet" href="../css/style.css">
  <script language="JavaScript" type="text/javascript">
  function deluser(id, title)
  {
    if (confirm("Är du säker på att du vill ta bort '" + title + "'"))
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
  // Visa meddelande från skriv-post och redigera-post
    if(isset($_GET['action'])){ 
    echo '<h3>User '.$_GET['action'].'.</h3>'; 
  } 
  ?>

    <table>
  <tr>
    <th>Användarnamn</th>
    <th>Email</th>
    <th>Action</th>
  </tr>
  <?php
    try {

      $stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
      while($row = $stmt->fetch()){
        
        echo '<tr>';
        echo '<td>'.$row['username'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        ?>

        <td>
          <a href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a> 
          <?php if($row['memberID'] != 1){?>
            | <a href="javascript:deluser('<?php echo $row['memberID'];?>','<?php echo $row['username'];?>')">Delete</a>
          <?php } ?>
        </td>
        
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

