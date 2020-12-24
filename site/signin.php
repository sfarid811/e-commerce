<!doctype html>
<?php
session_start();
 ?>
<html>
<head>
<link rel="stylesheet" href="style1.css">
<title>Signin form</title>
</head>
<body>
  <div>
    <?php
require "config.php";

     try{
      $connection = new PDO($dsn, $root, $passdb, $options);

     }
      catch (PDOException $e) {
        error_log($e,3, "error.log");
      }



    if (isset($_POST['username'])&&isset($_POST['password'])) {
    
          $username =  $_POST['username'];
          $password = $_POST['password'];

          $query = $connection->prepare("SELECT username, password, admin FROM users WHERE username=:username");
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
                          if ($query->rowCount() > 0&&$result->admin==!0) {
                            header ("location: admin.php");
                            $_SESSION['username'] = $_POST['username'];
                            $_SESSION['password'] = $saltedpw;
                            $cookie_name = 'eshop';
                            $cookie_value = $_POST['username'];
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                          }
                          elseif ($query->rowCount() > 0&&$result->admin==0)
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
                    $msg = "Wrong password!";
                    }
                    }
                    else {
                    $msg = "Wrong username/password!";
                    }
    }

?>

  </div>
  <div class="wrap">
      <h2>Sign in</h2>
          <form method='post'>
              <div><?php echo $msg ?></div>
              <label for='username'>username:</label><br>
              <input type='text' id='username' name='username' placeholder="Type your username"><br>
              <label for='password'>password:</label><br>
              <input type='password' id='password' name='password'placeholder="Enter your password"><br>

              <input type ="submit">
          </form>

  <div> 
  <br>
  <a href="signup.php">Create an account</a><br>
  <a href="index.php">Home</a>
    </div> 
</body>
</html>
