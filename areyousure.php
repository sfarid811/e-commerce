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
$value = htmlspecialchars($_GET['value']);

if (isset($_POST['submit']))
{

  if ($_POST['answer']=="yes")
     {
         var_dump($_POST['answer']);
         var_dump($value);
       try
       {
         require "config.php";
       $connection = new PDO($dsn, $username, $password, $options);

          $sql = "DELETE FROM products WHERE id=$value";
           $statement = $connection->prepare($sql);


           $statement->execute();

         echo "Product deleted!".  PHP_EOL;
          header('Location: products.php');
       } catch (\Exception $e) {
         echo $sql . "<br>" . $e->getMessage();
       }
     }
       else
       {
        // echo "ABORT!";
        header('Location: products.php');
        exit();
       }

     }



 ?>
</body>
