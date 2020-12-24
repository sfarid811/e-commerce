<!doctype html>
<?php
session_start();
 ?>
<html>
<head>
<title>Sign up form</title>
</head>
<body>
  <div>
    <?php



    $servername = "localhost";
    $root = "god";
    $passdb = "dieu";

     try{
    $pdo = new PDO("mysql:host=localhost;dbname=my_shop", $root, $passdb);

     }
    catch (PDOException $e){
      error_log($e,3, "error.log");
    }

if(isset($_POST['submit']))
{

          if (isset($_POST['username']))
          {
          checkName($_POST['username']);
          }
          elseif (isset($_POST['email']))
          {
          checkEmail($_POST['email']);
          }
          elseif (isset($_POST['password'])&&isset($_POST['password_confirmation']))
          {
          checkPw($_POST['password'],$_POST['password_confirmation']);

          }



          if (nameExists($_POST['username'])==true&&checkEmail($_POST['email'])==true&&checkPw($_POST['password'],$_POST['password_confirmation'])==true)
              {


               $saltedpw =  password_hash($_POST['password'],PASSWORD_DEFAULT );
               $sql = "INSERT INTO users (id, username, password, email, admin) VALUES (0,'".$_POST['username']."','".$saltedpw."','". $_POST['email']."', null)";

               $pdo->exec($sql);
               echo "User created";
               $_SESSION['username'] = $_POST['username'];
               $_SESSION['password'] = $saltedpw;
               $cookie_name = 'eshop';
               $cookie_value = $_POST['username'];
               setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
              }
}







     ?>

  </div>

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
      <input type ="submit" name="submit">
  </form>

  <?php

  function checkName($name)
  {

    $root = "god";
    $passdb = "dieu";
          try{
            $pdo = new PDO("mysql:host=localhost;dbname=my_shop", $root, $passdb);

            }
            catch (PDOException $e)
            {
              error_log($e,3, "error.log");
            }

        $query = $pdo->prepare("SELECT username FROM users WHERE username=:username");
        $query->bindParam("username", $name, PDO::PARAM_STR);
        $query->execute();

          if (($name==null)&&(!is_string($name)))
          {
            echo "Invalid username ". PHP_EOL;
          }

          elseif (strlen($name)<3 || strlen($name)>10)
          {
            echo "Invalid username ". PHP_EOL;

          }
          else
          {
            return true;

      }

  }

  function nameExists($name)
  {

    $root = "god";
    $passdb = "dieu";
          try{
            $pdo = new PDO("mysql:host=localhost;dbname=my_shop", $root, $passdb);

            }
            catch (PDOException $e)
            {
              error_log($e,3, "error.log");
            }

        $query = $pdo->prepare("SELECT username FROM users WHERE username=:username");
        $query->bindParam("username", $name, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0)
        {
          echo "Username already taken ";

        }
        else {
          return true;
        }

  }



  function checkEmail($email)
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      echo "Invalid email ".PHP_EOL;
    }
    else {
    return true ;
    }
  }

  function checkPw($password, $pwcheck)
  {


    if ($password==$pwcheck && (strlen($password)>=3)&&(strlen($password)<=10))
    {
    return true;
    }
    else
    {
      echo "Invalid password ";
    }
  }




  ?>

<a href="signin.php">I have an account already</a>


</body>
</html>
