<?php
session_start();
require "config.php";

///////////////// test si admin /////////////////////

if (isset($_COOKIE['eshop']))
{
//  var_dump($_COOKIE['eshop']);
  
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
    {    /*echo ' admin'; */ }
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

////////////////////// fin du test si admin /////////////////////
?>

<!doctype html>
<html lang="en">
<head>
<link href="css/style.css" rel="stylesheet">
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Admin users main page</title>
</head>

<body>
<!-- <p>Admin only...</p> -->

  <div>
    <form action="index.php">
          <button type="submit">ESHOP</button>
    </form>
  </div>

  <div>
    <form action="logout.php">
          <button type="submit">Logout</button>
    </form>
  </div>

<?php

        try{
          $connection = new PDO($dsn, $root, $passdb, $options);
//          echo "connexion OK";

          $sql = "SELECT * FROM users";
          $statement = $connection->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
     }
    catch (PDOException $e){
      error_log($e,3, "error.log");
    }
?>
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

  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row["id"]); ?></td>
      <td><?php echo htmlspecialchars($row["username"]); ?></td>
      <td><?php echo htmlspecialchars($row["email"]); ?></td>
      <td><?php echo htmlspecialchars($row["password"]); ?></td>
      <td><?php echo htmlspecialchars($row["admin"]); ?></td>
      <td><form action="admin_update_user.php?id=<?php echo htmlspecialchars($row["id"]); ?>" method="post">
          <button type="submit">Edit</button></form></td>
      <td><form action="areyousure_delete_user.php?id=<?php echo htmlspecialchars($row["id"]); ?>" method="post">
          <button type="submit">Delete</button></form></td>        
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
    <div>
    <div><br></div>
        <form action="admin_add_user.php">
        <button type="submit">Add a new user </button>
    </form> 
    </div>
    <div>
    <div><br></div> 
        <form action="admin.php">
        <button type="submit">Back to admin page</button><br><br>
        </form>
    </div> 
</body>
</html>
