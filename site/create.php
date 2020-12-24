<!DOCTYPE HTML>
<html>
<head>
<style>
label {
  display: block;
  margin: 5px 0;
}
</style>
</head>
<body>
  <?php include "templates/header.php"; ?><h2>Add a user</h2>

    <form method="post">
      <h2> Create New Product </h2>

    	<label for="product_name">Product name</label>
    	<input type="text" name="product_name" id="product_name">
    	<label for="product_price">Product price "€"</label>
    	<input type="int" name="product_price" id="product_price">
    	<label for="product_cat_id">Category ID</label>
    	<input type="int" name="product_cat_id" id="product_cat_id">


    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

  <?php
    if (isset($_POST['submit'])) {
      require "../config.php";



      try {

              $connection = new PDO($dsn, $username, $password, $options);
              $new_product = array(
                  "id" => 0,
                  "name" => $_POST['product_name'],
                  "price"  => $_POST['product_price'],
                  "category_id"     => $_POST['product_cat_id'],


          );

            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "products",
                implode(", ", array_keys($new_product)),
                ":" . implode(", :", array_keys($new_product))
                        );

            $statement = $connection->prepare($sql);
            $statement->execute($new_product);
             echo "User created";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }



  ?>


</body>
</html>
