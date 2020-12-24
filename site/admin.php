<!doctype html>
<?php
session_start();
//////////////////// test si admin ///////////////////////

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
   //     echo $R["admin"];
      }
      if ($R["admin"]==1)
    {  /*  echo ' admin';*/  }
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

//////////////////// fin du test si admin ///////////////////
  ?>

<head>
<title>Administrator page</title>
</head>

<body>
<p>Administrator page, admin only</p>

  <div>
    <form action="admin_users.php">
          <button type="submit">LIST & EDIT USERS.</button>
    </form>
  </div>

  <div>
    <form action="admin_add_user.php">
          <button type="submit">ADD A NEW USER.</button></form>
  </div>
  <div>
    <form action="admin_edit_products.php">
          <button type="submit">LIST & EDIT PRODUCTS.</button></form>
  </div>
  <div>
    <form action="admin_new-cat.php">
          <button type="submit">ADD A NEW CATEGORY.</button></form>
  </div>  
  <div>
    <form action="admin_add_product.php">
          <button type="submit">ADD A NEW PRODUCT.</button></form><br>
  </div>
  <div>   
    <form action="index.php">
            <button type="submit">Go home</button><br><br></form>
  </div>
  <div> 
  <form action="logout.php">
          <button type="submit">Logout.</button><br><br></form>
  </div>  

</body>
</html>
