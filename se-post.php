<?php require('includes/config.php');

//viewpost.php används för att visa inlägg som användaren klickat på.

//Queryn använder något som heter prepared statement. Infon som visas väljer man genom en $_GET[id] request som
//skickar ett id.
//Prepared statement funkar bättre än en vanlig query eftersom den förbereder databasen för att
//köra queryn. När vi sedan kör $stmt->execute kommer datan i arryen skickas till databasens server.
//Dessa två connectar aldrig vilket minimerar risken att någon fular i databasen.

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//Om det efterfrågade postID't inte existerar i databasen, skicka användaren tillbaka till index-sidan


if($row['postID'] == ''){
  header('Location: ./');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

    <div id="wrapper">

        <h1>Blog</h1>
        <hr />
        <p><a href="./">Blog Index</a></p>
//Visa hela den valda posten.

    <?php
        echo '<div>';
            echo '<h1>'.$row['postTitle'].'</h1>';
            echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
            echo '<p>'.$row['postCont'].'</p>';
        echo '</div>';
    ?>

    </div>

</body>
</html>