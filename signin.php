<!doctype html>
<?php
session_start();
 ?>
<html>
<head>
<title>Signin form</title>
</head>
<body>
  <div>
    <?php


    $root = "god";
    $password = "dieu";

     try{
    $pdo = new PDO("mysql:host=localhost;dbname=my_shop", $root, $password);

     }
    catch (PDOException $e){
      error_log($e,3, "error.log");
    }



if (isset($_POST['username'])&&isset($_POST['password']))
{
      $username =  $_POST['username'];
      $password = $_POST['password'];

      $query = $pdo->prepare("SELECT username, password, admin FROM users WHERE username=:username");
      $query->bindParam("username", $username, PDO::PARAM_STR);
    //  $enc_password = password_verify(PASSWORD_DEFAULT, $password);
    //  $query->bindParam("password", $enc_password, PDO::PARAM_STR);
    $query->execute();


      if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                //var_dump($result->password). PHP_EOL;
                //var_dump($password);

                if (password_verify($password, $result->password))
                {
                      if ($query->rowCount() > 0&&$result->admin==!null) {
                        header ("location: admin.php");
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['password'] = $saltedpw;
                        $cookie_name = 'eshop';
                        $cookie_value = $_POST['username'];
                        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                      }
                      elseif ($query->rowCount() > 0&&$result->admin==null)
                      {

                          header ("location: index.php");
                          $_SESSION['username'] = $_POST['username'];
                          $_SESSION['password'] = $saltedpw;
                          $cookie_name = 'eshop';
                          $cookie_value = $_POST['username'];
                          setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                      }

                }
                else
                {
                  echo "Wrong password!";
                }

        } else {
                echo "Wrong username/password!";
          }




    // $sql = "SELECT username, password FROM users WHERE username=oui AND password=oui";
     //$hashedpw = password_verify($_POST['password'], PASSWORD_DEFAULT);

     //$result = $pdo->exec($sql);
     //if ($query->rowCount() > 0) {
    //             $result = $query->fetch(PDO::FETCH_OBJ);
        //         return $result->user_id;

    /* if ($pdo->rowCount() > 0 )
     {
       echo "trouvé!";
     }
     else {
       echo "nop !!!";
     }*/
  }








     ?>

  </div>

  <form method='post'>
      <label for='username'>username:</label><br>
      <input type='text' id='username' name='username' placeholder="Type Username"><br>
      <label for='password'>password:</label><br>
      <input type='password' id='password' name='password'placeholder="Type your password"><br>


      <input type ="submit">
  </form>






</body>
</html>
