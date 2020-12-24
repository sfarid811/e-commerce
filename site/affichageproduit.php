<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sports Therapy, You need, we provide.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
    crossorigin="anonymous"
  />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type= 'text/css' href="int.css">
  <link rel="stylesheet" type= 'text/css' href="stylev2.css">
</head>
<body>

  <div>
    <!-- le header -->
    <header>
      <!-- Gauche -->
      <nav class="main-nav">
        <span class="header_left">
          <img class = "logomenu" alt="Menu" title="Menu" src="img/logo1.png" width="600" height="400"/>
          <a class="d-none d-sm-block" href="index.php">HOME</a>
          <a class="d-none d-sm-block" href="categories.php">CATEGORIES</a>
          <a class="d-none d-sm-block" href="affichageproduit.php">PRODUCTS</a>
        </span>

        <!-- Droite -->

        <div class="header_right">

          <a class="d-none d-sm-block" href="signin.php">LOGIN</a>
         <div class="btn-group dropleft d-block d-sm-none">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              &#9776;
            </button>
            <div class="dropdown-menu">
              <!-- Dropdown menu links -->
              <a class="dropdown-item" href="index.php">HOME</a>
              <a class="dropdown-item" href="categories.php">CATEGORIES</a>
              <a class="dropdown-item" href="">PRODUCTS</a>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <!-- Search bar, Best Match -->
    <div class="d-none d-sm-block"> <!-- search + best-->


      <div class="search_bar">
          <div class="input-group mb-3">
            <?php include "search-barTEST.php"; ?>
          </div>

        </div>

          <!-- formulaire déroulant-->

        </div>
      </div>
</div>
<!-- CODE -->
<?php
try
{
  require "config.php";
$connection = new PDO($dsn, $username, $password, $options);


   $sql = "SELECT * from products ORDER BY name ASC LIMIT 16";

   $statement = $connection->prepare($sql);

   $statement->execute();

   $result = $statement->fetchAll();
 } catch(PDOException $error) {
   echo $sql . "<br>" . $error->getMessage();
    }
?>
<?php foreach ($result as $row) { ?>
  <div class="responsive">
    <div class="gallery">
      <a target="_blank" href="">
        <img src="img/<?php echo $row['name'];?>.jpeg" class="imggal" alt="palceholder" width="600" height="400">
      </a>
      <div class="desc">
            <div class="row1">
              <p class="item"><?php echo $row["name"]; ?></p>
              <p class="price"><?php echo $row["price"]; ?> €</p>

            </div>

      </div>
    </div>

  </div>
<?php } ?>



<!-- PAGINATION -->

<div id="pagination">
  <p class="active">1</p>
  <p>2</p>
  <p>3</p>
  <p>4</p>
  <p class="d-none d-sm-block">5</p>
  <p class="d-none d-sm-block">6</p>
  <p class="d-none d-sm-block">7</p>
  <p class="d-none d-sm-block">8</p>
  <p class="d-none d-sm-block">9</p>
  <p class="d-none d-sm-block">10</p>
  <p>></p>
</div>



<div class="clearfix"></div>
<footer></footer>
</body>
</html>
