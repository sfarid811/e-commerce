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


    <form method="post">
      <h2> Create New Product </h2>

    	<label for="product_name">Product name</label>
    	<input type="text" name="product_name" id="product_name">
    	<label for="product_price">Product price "€"</label>
    	<input type="int" name="product_price" id="product_price">
      <label for="parent_cat" name="parent_cat" id="parent_cat">Choose a PARENT category</label>
        <select name="idparents" >
            <?php

            require "../config.php";




                  try {
                        $connection = new PDO($dsn, $username, $password, $options);
                        $sql = "SELECT id, name, parent_id FROM categories ORDER BY parent_id ASC";
                        $statement = $connection->prepare($sql);
                        $statement->execute();
                        $result=$statement->fetchAll();
                            foreach ($result as $r )
                            {
                              echo '<option value='.$r['id'].'>'.$r['name'].'</option>';
                            }

                      }
            catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
            }

            ?>


    	<input type="submit" name="submit" value="submit">
    </form>

    <!--<a href="index.php">Back to home</a>-->

  <?php
    if (isset($_POST['submit'])) {
      require "../config.php";




            try {

                    $connection = new PDO($dsn, $username, $password, $options);
                    $new_product = array(
                        "id" => 0,
                        "name" => $_POST['product_name'],
                        "price"  => $_POST['product_price'],
                        "category_id"     => $_POST['idparents'],
                        );
                  $product_name =  $_POST['product_name'];
                  $product_price =  $_POST['product_price'];
                  $product_cat_id =  $_POST['idparents'];


                  $query = $connection->prepare("SELECT name FROM products WHERE name=:name");
                  $query->bindParam("name", $product_name, PDO::PARAM_STR);
                  $query->execute();
            if ($query->rowCount() > 0)
              {
                echo "Product already exists ";

              }
            else
            {

                  $sql = sprintf(
                      "INSERT INTO %s (%s) values (%s)",
                      "products",
                      implode(", ", array_keys($new_product)),
                      ":" . implode(", :", array_keys($new_product))
                              );

                  $statement = $connection->prepare($sql);
                  $statement->execute($new_product);
                   echo "product created";


            }
          } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
          }
    }




  ?>


</body>
</html>
