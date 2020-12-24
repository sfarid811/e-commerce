<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="IMG/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/search_bar.css">
    <title>Redstore homepage</title>
</head>
<body>
   <div class="container">
   <div class="navbar">
       <div class="logo col-sm-12 col-lg-6">
          <a href="index.php"><img src="/IMG/logo.png" width="200px" alt="logo de RedStore"></a>
       </div>
       <nav class="col-sm-12 col-lg-6">
                <ul >
                    <?php
                    if (isset($_COOKIE['eshop']))
                    {
                    ?>
                    <li><a class="connexion" href = "logout.php" title="Logout">Logout</a></li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li><a class="connexion" href ="signin.php" title="Login">Sign in</a></li>
                    <li><a class="connexion" href="signup.php" title="Signin">Sign up</a></li>
                    <?php
                    }
                    ?>
                </ul>
       </nav>
   </div>
   <div class="row">
       <div class="banniere col-sm-3 col-lg-3">
           <h4>Welcome to <span class="dog"> RED</span>STORE</h4>
       </div>
       <div class="col-2">
        <img src="/IMG/image1_red.png" alt="">
       </div>
   </div>

   </div>
   <!-- Produits-->

   <div class="container_2">
            <?php include('search_bar.php'); ?>
       </div>
       </body>
</html>
