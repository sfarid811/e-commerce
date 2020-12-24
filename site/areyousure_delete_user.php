
<!doctype>
<html>

<head></head>
<body>
<form method="post">
<H1>to delete the user</H1>
<label for="answer">Type "yes" to delete</label>
<input type="text" name="answer" id="answer">
<input type="submit" name="submit" >
</form>
<?php

require "config.php";

////////////////////// test si admin ////////////////////////

if (isset($_COOKIE['eshop']))
{
//  var_dump($_COOKIE['eshop']);
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
  //      echo $R["admin"];
      }
      if ($R["admin"]==1)
    { /*   echo ' admin'; */ }
        else
          {
            echo "You don't have permission to acces this page.";


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



///////////////////// fin du test si admin //////////////////

if (isset($_POST['submit']))
{
  $id = $_GET["id"];
  if ($_POST['answer']=="yes")
     {
//         var_dump($_POST['answer']);
//         var_dump($id);
       try
       {
         require "config.php";
         
         $connection = new PDO($dsn, $root, $passdb, $options);

          $sql = "DELETE FROM users WHERE id=$id";
           $statement = $connection->prepare($sql);
           $statement->execute();

         echo "User deleted!".  PHP_EOL;
         $delai=2; 
         $url='admin_users.php';
         header("Refresh: $delai;url=$url");


       } catch (\Exception $e) {
         echo $sql . "<br>" . $e->getMessage();
       }
     }
       else
       {
        echo "ABORT!";
        $delai=2; 
        $url='admin_users.php';
        header("Refresh: $delai;url=$url");
        exit();
       }

     }



 ?>
</body>
