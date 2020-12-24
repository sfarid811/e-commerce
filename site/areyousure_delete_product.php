<!doctype>
<html>

<head></head>
<body>
<form method="post">
<H1>to delete the product</H1>
<label for="answer">Type "yes" to delete</label>
<input type="text" name="answer" id="answer">
<input type="submit" name="submit" >
</form>

<?php

///////////////////// test si admin ////////////////////////
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
    //    echo $R["admin"];
      }
      if ($R["admin"]==1)
    {  /*  echo ' admin'; */ }
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
//////////////////// fin du test si admin /////////////////
$value = htmlspecialchars($_GET['value']);

if (isset($_POST['submit']))
{

  if ($_POST['answer']=="yes")
     {
//         var_dump($_POST['answer']);
//         var_dump($value);
       try
       {
         require "config.php";
         $connection = new PDO($dsn, $root, $passdb, $options);

          $sql = "DELETE FROM products WHERE id=$value";
           $statement = $connection->prepare($sql);


           $statement->execute();

         echo "Product deleted!".  PHP_EOL;
          header('Location: admin_edit_products.php');
       } catch (\Exception $e) {
         echo $sql . "<br>" . $e->getMessage();
       }
     }
       else
       {
        // echo "ABORT!";
        header('Location: admin_edit_products.php');
        exit();
       }

     }
 ?>
</body>
