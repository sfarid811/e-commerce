<?php
if (isset($_COOKIE['eshop']))
{
  var_dump($_COOKIE['eshop']);
  require "config.php";
    try
    {
    $connection = new PDO($dsn, $dbuser, $password, $options);
    $sql = "SELECT admin FROM users WHERE username=:username";
    $statement = $connection->prepare($sql);
    $statement->bindParam("username", $_COOKIE['eshop'], PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetchAll();

      foreach ($result as $R)
      {
        echo $R["admin"];
      }
      if ($R["admin"]==1)
        {    echo ' admin';  }
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
  ?>