<?php

include('class.password.php');




//Här kan användaren logga in och logga ut, verifiera password och krypterar även passwordet.

// Funktionen _construct anropas så snart en klass körs, metoden skickar en koppling till databasen som tillhör en
//variabel inom klassen. Detta lilla trix gör att alla metoder får tillgång till databasen.

class User extends Password{
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



//För att skapa ett krypterat lösenord när vi lägger till nya admins till bloggen har vi metoden create_hash
//Det finns inbyggd kryptering i funktionen.

  public function create_hash($value) {
    return $hash = crypt($value, '$2a$12$'.substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22));
    }


//För att verifiera krypteringen används denna metod:

  private function verify_hash($password,$hash){
    return $hash == crypt($password, $hash);
    }



//För att verifiera att lösen matchar måste vi hämta det krypterade lösenordet från DB.
//Vi skickar in användarnamnet till DB och det krypterade lösenordet returneras.

  private function get_user_hash($username){

    try {

      $stmt = $this->db->prepare('SELECT password FROM blog_members WHERE username = :username');
      $stmt->execute(array('username' => $username));
      $row = $stmt->fetch();
      return $row['password'];

    } catch(PDOException $e) {
    echo '<p class="error">'.$e->getMessage().'</p>';
  }
}

//Därefter login


public function login($username,$password){

    $hashed = $this->get_user_hash($username);

    if($this->password_verify($password,$hashed) == 1){

        $_SESSION['loggedin'] = true;
        return true;
    }
  }
 //åsså logut

  public function logout(){
    session_destroy();
  }

}











