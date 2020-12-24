<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <link href="css/style_update_user.css" rel="stylesheet">
    <title>update_users</title>
  </head>
  <body>
<?php

require "config.php";
$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$msg='';
$id = htmlspecialchars($_GET['id']);
$value = htmlspecialchars($_GET['id']);

    ////////////////// test si admin ///////////////////////
    if (isset($_COOKIE['eshop']))
    {
//      var_dump($_COOKIE['eshop']);
      require "config.php";
        try
        {
        require "config.php";
        $connection = new PDO($dsn, $root, $passdb, $options);
        $sql = "SELECT admin FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->bindParam("username", $_COOKIE['eshop'], PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetchAll();

          foreach ($result as $R)
          {
          //  echo $R["admin"];
          }
          if ($R["admin"]==1)
        {   /* echo ' admin'; */ }
            else
              {
                echo "You don't have permission to acces this page.";
                exit;


            }
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        }
    }
    else
      {

        header("Location: signin.php");
        exit();
    }
  
    //////////////////// fin du test si admin /////////////////////////


    try {
      require "config.php";
        $connection = new PDO($dsn, $root, $passdb, $options);
        $sql = "SELECT * FROM users WHERE id=$value";


      $statement = $connection->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll();
    } 
    catch(PDOException $e) {
      error_log($e,3, "error.log");
      echo $sql . "<br>" . $e->getMessage();
    }

    if ($result && $statement->rowCount() > 0) {
     ?>
        <div>
          <table>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Admin</th>
                </tr>
              </thead>
              <tbody>
                   <?php foreach ($result as $row) {
                      ?>
                       <tr>
                          <td><?php echo escape($row["id"]); ?></td>
                          <td><?php echo escape($row["username"]); ?></td>
                          <td><?php echo escape($row["email"]); ?></td>
                          <td><?php echo escape($row["password"]); ?></td>
                          <td><?php echo escape($row["admin"]); ?></td>
                        </tr>
        </div>
        <div>
              <?php } ?>
              <form method="post">
              
                <h2> Edit user <?php echo "Id " . $_GET['id']?></h2>
                <?php echo $msg ?>
                <label for="user_username">Change username:</label>
                <input type="text" name="user_username" id="user_username" placeholder="Enter new username">
                <input type="submit" name="edit_user_username" value="Update">

                <label for="user_email">Change email of user</label>
                <input type="text" name="user_email" id="user_email" placeholder="Enter new email">
                <input type="submit" name="edit_user_email" value="Update">

                <label for="user_password">Change password of user</label>
                <input type="password" name="user_password" id="user_password" placeholder="Enter new password">
<!--                <input type="submit" name="edit_user_password" value="Update"> -->

                <label for="user_password_confirmation">Password confirmation</label>
                <input type="password" name="user_password_confirmation" id="user_password_confirmation" placeholder="confirm password">
                <input type="submit" name="edit_user_password_confirmation" value="Update">

                <label for="case">check this box and submit to accord administrator rights, or uncheck and submit to disable admins rights. </label>
                <input type="checkbox" name="case" id="case" value="1" action="">
                <input type="submit" name="admin_submit" value="submit" action="">
                </form>
                <div><br><br>
                <form action="admin_users.php" method="post">
                  <button type="submit">GO BACK TO ADMIN USERS PAGE.</button></form>
                </div>
                <br>
                </div>
          
        <?php
////////////////////// Username ////////////////////////////////
        if (isset($_POST['edit_user_username']))
        {
          $name = $_POST["user_username"];
          checkName($name);
          nameExists($name);
          try
          {
            require "config.php";
            $connection = new PDO($dsn, $root, $passdb, $options);
            $sql = "UPDATE users SET username = :username WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':username', $_POST['user_username'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();

            echo "<br>" . "Username updated!";
            header("Refresh:1");
          }
          catch(PDOException $error) {
            error_log($e,3, "error.log");
             echo $sql . "<br>" . $error->getMessage();
          }
        }
///////////////////// Email ////////////////////////
        if (isset($_POST["edit_user_email"]))
        { 
           $email = $_POST["user_email"];
           checkEmail($email);
           emailExists($email);
          try
          {
            require "config.php";
            $connection = new PDO($dsn, $root, $passdb, $options);
            $sql = "UPDATE users SET email = :email WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':email', $_POST['user_email'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();

            echo "<br>" . "email updated!";
            header("Refresh:1");
           } 
            catch(PDOException $error) {
              error_log($e,3, "error.log");
              echo $sql . "<br>" . $error->getMessage();
            }
        }
///////////////////// Password ////////////////////////
        if (isset($_POST['edit_user_password_confirmation']))
        {
          $password = $_POST['user_password'];
          $pwcheck = $_POST['user_password_confirmation'];
          checkPw($password, $pwcheck);
          $saltedpw = password_hash($password,PASSWORD_DEFAULT );
          $_POST['user_password'] = $saltedpw;

          try
          {
            require "config.php";
            $connection = new PDO($dsn, $root, $passdb, $options);
            $sql = "UPDATE users SET password = :password WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':password', $_POST['user_password'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();
              
            echo "<br>" . "password updated!";
            header("Refresh:1");

            } 
            catch(PDOException $error) {
                error_log($e,3, "error.log");
                echo $sql . "<br>" . $error->getMessage();
            }
        }
      ///////////////////// Droits admin (AR) ////////////////////////
        if ((isset($_POST["admin_submit"])) && (isset($_POST['case'])))
        
        {
          try
          {
            require "config.php";
            $connection = new PDO($dsn, $root, $passdb, $options);
            $id = $_GET['id'];
            $sql = "UPDATE users SET admin= :admin WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':admin', $_POST['case'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();
//            var_dump($_POST['case']);
              echo "<br>" . "admin status updated!";
//             header('Location: admin_users.php');
              header("Refresh:1");
            } 
            catch(PDOException $error) {
                error_log($e,3, "error.log");
                echo $sql . "<br>" . $error->getMessage();
            }
        }
        elseif ((isset($_POST["admin_submit"])) && (!isset($_POST['case']))) {
          try
          {
            require "config.php";
            $connection = new PDO($dsn, $root, $passdb, $options);
            $sql = "UPDATE users SET admin='0' WHERE id=$id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':admin', $_POST['case'], PDO::PARAM_STR);
              $statement->bindParam(':id', $id, PDO::PARAM_STR);
              $statement->execute();
//            var_dump($_POST['case']);
              echo "<br>" . "admin status updated!";
              header("Refresh:1");

            } 
            catch(PDOException $error) {
                error_log($e,3, "error.log");
                echo $sql . "<br>" . $error->getMessage();
            }
        }
//        var_dump($_POST['case']);
         ?>
      </tbody>
      </table>
    <?php } ?>
      <?php

////////////////////// fonctions ////////////////////////////////

                      ////////// escape //////////
      function escape($html) {
      return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
      }

                      ////////// valid name //////////
      function checkName($name) {

                try{
                  require "config.php";
                  $connection = new PDO($dsn, $root, $passdb, $options);
                  }
                  catch (PDOException $e)
                  {
                    error_log($e,3, "error.log");
                  }
              $query = $connection->prepare("SELECT username FROM users WHERE username=:username");
              $query->bindParam("username", $name, PDO::PARAM_STR);
              $query->execute();

                if (($name==null) || (!is_string($name)))
                {
                  echo "Invalid username ". PHP_EOL;
                  exit;
                }
                elseif (strlen($name)<3 || strlen($name)>10)
                {
                  echo "Invalid username ". PHP_EOL;
                  exit;
                }
                else
                {
                  return true;
          }
      }
          /////////////////// fonction name exist /////////////////////
      function nameExists($name) {

              try{
                require "config.php";
                $connection = new PDO($dsn, $root, $passdb, $options);
              }
                catch (PDOException $e) {
                  error_log($e,3, "error.log");
                }

            $query = $connection->prepare("SELECT username FROM users WHERE username=:username");
            $query->bindParam("username", $name, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0)
            {
              echo "Username already taken ";
              exit;
            }
            else {
              return true;
            }
      }
                      ////////// valid email  //////////
      function checkEmail($email)
      {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg =  "'$email' is OK.";
        } else {
          $msg =  "'$email' is not a valid email.";
          echo $msg;
            exit;
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
        exit;
      }
      else {
        return true;
      }
}

////////////////////// check password ////////////////////
        function checkPw($password, $pwcheck) {
  
            if ($password==$pwcheck && (strlen($password)>=3)&&(strlen($password)<=10))
            {
            return true;
            }
            else
            {
              echo "Invalid password or password confirmation. ";
              exit;
            }
        }
      ?>
  </body>
  </html>