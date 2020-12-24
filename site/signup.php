<!doctype html>
<?php
session_start();
 ?>
<html>
<head>
<link rel="stylesheet" href="style1.css">
<title>Sign up form</title>
</head>
<body>
  <div>
<?php

     try{
      require "config.php";
      $connection = new PDO($dsn, $root, $passdb, $options);

     }
    catch (PDOException $e){
      error_log($e,3, "error.log");
    }




?>
  </div>
  <div class="wrap">

      <form method='post'>

          <label for='username'>username:</label><br>
          <input type='text' id='username' name='username' placeholder="Type Username"><br>
          <label for='email'>email:</label><br>
          <input type='text' id='email' name='email' placeholder="Type Email"><br>
          <label for='password'>password:</label><br>
          <input type='password' id='password' name='password'placeholder="Type your password"><br>
          <label for='password confirmation'>password confirmation:</label><br>
          <input type='password' id='password_confirmation' name='password_confirmation' placeholder="Confirm your password"><br>
          <br>
          <input type ="submit" name="submit" value="Submit">

          <a href="signin.php">I have already an account</a><br>
          <a href="index.php">Home</a>
          </form>

<?php
          /////////////////////// Check le format du name /////////////////////////////

    function checkName($name)
    {
      require "config.php";
            try{
              $connection = new PDO($dsn, $root, $passdb, $options);
            }
              catch (PDOException $e) {
                error_log($e,3, "error.log");
              }

          $query = $connection->prepare("SELECT username FROM users WHERE username=:username");
          $query->bindParam("username", $name, PDO::PARAM_STR);
          $query->execute();

            if (empty($name)||(!is_string($name))) {

               return false;


            }

            elseif (strlen($name)<3 || strlen($name)>25) {

              return false;



            }
            else {
              return true;
            }
    } ?>
  </div>
<?php


    /////////////////////// Check si name exist /////////////////////////////

        function nameExists($name) {
              require "config.php";
                try{
                  $connection = new PDO($dsn, $root, $passdb, $options);
                  }
                  catch (PDOException $e)
                  {
                    error_log($e,3, "error.log");
                  }

              $query = $connection->prepare("SELECT username FROM users WHERE username=:username");
              $query->bindParam("username", $name, PDO::PARAM_STR);
              $query->execute();

              if ($query->rowCount() > 0)
              {
                echo "Username already taken...";
                return false;
              }
              else {
                return true;
              }
        }

    /////////////////////// is mail valid /////////////////////////////

        function checkEmail($email) {
          if (!filter_var($email, FILTER_VALIDATE_EMAIL))
          {
            echo "Invalid email...".PHP_EOL;
            return false;
          }
          else {
          return true ;
          }
        }

        function checkPw($password, $pwcheck) {
            if ($password==$pwcheck && (strlen($password)>=3)&&(strlen($password)<=10))
            {
            return true;
            }
            else
            {
              echo "Invalid password or password confirmation.";
              return false;
            }
        }

//////////////////////// email exist /////////////////////

        function emailExists($email) {

          try{
            require "config.php";
            $connection = new PDO($dsn, $root, $passdb, $options);
          }
            catch (PDOException $e) {
              error_log($e,3, "error.log");
            }

        $query = $connection->prepare("SELECT email FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();

          if ($query->rowCount() > 0)
          {
            echo "Email already taken. ";
            die;
          }
          else {
            return true;
          }
        }



/////////////////////// test si formulaire soumis /////////////////////////////

if(isset($_POST['submit']))
{
          if (isset($_POST['username']))
           {
              checkName($_POST['username']);
              if (checkName($_POST['username']) == false)
              {
                echo  "Invalid username...". PHP_EOL;
                exit;
              }

          }
          elseif (isset($_POST['email'])) {
              checkEmail($_POST['email']);
              emailExists($_POST['email']);
          }
          elseif (isset($_POST['password'])&&isset($_POST['password_confirmation'])) {
              checkPw($_POST['password'],$_POST['password_confirmation']);
          }

/////////////////////// test si le name exist /////////////////////////////

          if (nameExists($_POST['username'])==true&&checkEmail($_POST['email'])==true&&emailExists($_POST['email'])==true &&checkPw($_POST['password'],$_POST['password_confirmation'])==true)
              {
               $saltedpw =  password_hash($_POST['password'],PASSWORD_DEFAULT );
               $sql = "INSERT INTO users (id, username, password, email, admin) VALUES (0,'".$_POST['username']."','".$saltedpw."','". $_POST['email']."', 0)";

               $connection->exec($sql);
               echo "User created";



               $_SESSION['username'] = $_POST['username'];
               $_SESSION['password'] = $saltedpw;
               $cookie_name = 'eshop';
               $cookie_value = $_POST['username'];
               setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
               header('Refresh: 1; URL = index.php');

              }
}
?>

</body>
</html>
