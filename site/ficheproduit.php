<!DOCTYPE html>
<html lang="en">

  <head>
    <link rel="stylesheet" href="CSS/ficheproduit.css">
    <link rel="stylesheet" href="CSS/ficheproduit.css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
      <link rel="stylesheet" href="style.css">

    <title>eCommerce Product Detail</title>
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


    </div>
<?php
$value = htmlspecialchars($_GET['value']);
 try
  {
    require "config.php";
	$connection = new PDO($dsn, $root, $passdb, $options);


     $sql = "SELECT * from products WHERE id=$value";

     $statement = $connection->prepare($sql);

     $statement->execute();

     $result = $statement->fetchAll();
   } catch(PDOException $error) {
     echo $sql . "<br>" . $error->getMessage();
      }
      foreach ($result as $row)

       ?>
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">

						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="IMG/<?php echo $row['name'];?>.png"/></div>
						</div>

					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo $row["name"]; ?></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 avis</span>
						</div>
						<p class="product-description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
						<h4 class="price"><?php echo $row["price"]; ?> €</h4>
                        <p class="vote"><strong>91%</strong> "Lorecidat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." <strong>(87 votes)</strong></p>
                        <!--
						<h5 class="sizes">sizes:
							<span class="size" data-toggle="tooltip" title="small">s</span>
							<span class="size" data-toggle="tooltip" title="medium">m</span>
							<span class="size" data-toggle="tooltip" title="large">l</span>
							<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                        </h5>
                    -->
						<h5 class="colors">Couleur disponible:
							<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green"></span>
							<span class="color blue"></span>
						</h5>
						<div class="action">
							<button class="add-to-cart btn btn-default" type="button">Ajouter au panier</button>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html
