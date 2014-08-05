<?php

// Funktionen _construct anropas så snart en klass körs, metoden skickar en koppling till databasen som tillhör en
//variabel inom klassen. Detta lilla trix gör att alla metoder får tillgång till databasen.

class User extends Password {

    private $db;

  function __construct($db){
    parent::__construct();

    $this->_db = $db;
  }

//För att verifiera om användaren är inloggad använder vi metoden is_logged_in()
//Den söker efter sessionen "loggedin" och är den true så är det en användare inloggad annars
//så returnerar den inget.


  public function is_logged_in(){
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      return true;
    }
  }


//Hämtar krypterade lösen kopplat till användarnamnet

  private function get_user_hash($username){

    try {

      $stmt = $this->_db->prepare('SELECT password FROM blog_members WHERE username = :username');
      $stmt->execute(array('username' => $username));

      $row = $stmt->fetch();
      return $row['password'];

    } catch(PDOException $e) {
        echo '<p class="error">'.$e->getMessage().'</p>';
    }
  }

//logga in
  public function login($username,$password){

    $hashed = $this->get_user_hash($username);

    if($this->password_verify($password,$hashed) == 1){

        $_SESSION['loggedin'] = true;
        return true;
    }
  }

 //logga ut
  public function logout(){
    session_destroy();
  }

}


?>




