<!doctype html>
<?php
 ?>
<html>
<head>
<title>add_user</title>
</head>
<body>
  <div>
    <?php
/////////////////////// Test si admin /////////////////////////////////////

require "config.php";
    if (isset($_COOKIE['eshop'])) {
//      var_dump($_COOKIE['eshop']);
      require "config.php";
        try
        {
          $connection = new PDO($dsn, $root, $passdb, $options);
          $sql = "SELECT admin FROM users WHERE username=:username";
          $statement = $connection->prepare($sql);
          $statement->bindParam("username", $_COOKIE['eshop'], PDO::PARAM_STR);

          $statement->execute();
          $result = $statement->fetchAll();

          foreach ($result as $R)
          {
//            echo $R["admin"];
          }
          if ($R["admin"]==1) {
//            echo ' admin';
          }
            else {
            echo "You don't have permission to acces this page.";
            exit;
          }
        }
        catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    else {
        header("Location: signin.php");
        exit();
    }
//////////////////////////// fin du test si admin /////////////////////////////////////




if(isset($_POST['submit']))
{

          if (isset($_POST['username']))
          {
          checkName($_POST['username']);
              if (checkName($_POST['username']) == false)
              {
                echo  "Invalid username...". PHP_EOL;

              }
            }

          elseif (isset($_POST['email']))
          {
          checkEmail($_POST['email']);
          }
          elseif (isset($_POST['password'])&&isset($_POST['password_confirmation']))
          {
          checkPw($_POST['password'],$_POST['password_confirmation']);

          }

          if (nameExists($_POST['username'])==true && checkName($_POST['username'])==true && emailExists($_POST['email'])==true && checkEmail($_POST['email'])==true  && checkPw($_POST['password'],$_POST['password_confirmation'])==true)
          {
            try{
           $pdo = new PDO("mysql:host=localhost;dbname=my_shop", $root, $passdb);

           $saltedpw =  password_hash($_POST['password'],PASSWORD_DEFAULT );
           if (isset($_POST["case"]))
           {
            $sql = "INSERT INTO users (id, username, password, email, admin) VALUES (0,'".$_POST['username']."','".$saltedpw."','". $_POST['email']."', 1)";
            }
            elseif(!isset($_POST["case"]))
           {
              $sql = "INSERT INTO users (id, username, password, email, admin) VALUES (0,'".$_POST['username']."','".$saltedpw."','". $_POST['email']."', 0)";
            }
            $connection->exec($sql);
            echo "User created";
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $saltedpw;
            $cookie_name = 'eshop';
            $cookie_value = $_POST['username'];
         }
         catch (PDOException $e){
           error_log($e,3, "error.log");}

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
      <input type="checkbox" name="case" id="case" value="1" action="">
          <label for="case">check this box to accord administrator rights</label>
          <br><br>
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

          if (empty($name))
          {
           return false;
          }

          elseif (strlen($name)<3 || strlen($name)>25)
          {
           return false;

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
          return false;

        }
        else {
          return true;
        }

  }

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

      if ($query->rowCount() > 0) {

        echo "Email already taken. ";
        return false;


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
      return false;
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
      return false;
    }
  }




  ?>
<br>
    <form action="admin.php">
        <button type="submit">BACK TO MAIN ADMIN PAGE</button>
    </form>

</body>
</html>
