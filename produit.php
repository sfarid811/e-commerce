<!doctype html>
<html>
<head>
  <style>
  label {
    display: block;

  }
  </style>
</head>
<body>

<?php
$value = htmlspecialchars($_GET['value']);


try
{
  require "config.php";
$connection = new PDO($dsn, $username, $password, $options);

   $sql = "SELECT *
   FROM products WHERE id=$value";




   $statement = $connection->prepare($sql);

   $statement->execute();

   $result = $statement->fetchAll();
 } catch(PDOException $error) {
   echo $sql . "<br>" . $error->getMessage();
    }


    if ($result && $statement->rowCount() > 0)
    { ?>


          <table>
              <thead>
              <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Price</th>
               <th>Category_id</th>

              </tr>
              </thead>
              <tbody>
                   <?php foreach ($result as $row) { ?>
                       <tr>
                  <td><?php echo escape($row["id"]); ?></td>
                  <td><?php echo escape($row["name"]); ?></td>
                  <td><?php echo escape($row["price"]); ?></td>
                  <td><?php echo escape($row["category_id"]); ?></td>

                </tr>
              <?php } ?>




              <form method="post">
                <h2> Edit this product </h2>

                <label for="product_name">Change name of product</label>
                <input type="text" name="product_name" id="product_name">
                <input type="submit" name="edit_name" >
                <label for="product_price">Change price of product</label>
                <input type="int" name="product_price" id="product_price">
                <input type="submit" name="edit_price" >
                <label for="idparents" name="idparents" id="idparents">Choose a PARENT category</label>
                  <select name="idparents" >
                      <?php

                      require "config.php";




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
                <input type="submit" name="submitID">



              </form>

        <?php
        // query sql to update db
        var_dump($_POST["idparents"]);
        if (isset($_POST['edit_name'])&&($_POST['product_name']==!null))
        {

          try
          {
            require "config.php";
          $connection = new PDO($dsn, $username, $password, $options);

             $sql = "UPDATE products SET name = :name WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':name', $_POST['product_name'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();

            echo "Name updated!".  PHP_EOL;
            header("Refresh:1");
           } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
              }
        }
        elseif($_POST['product_name']==null)
        {
          echo PHP_EOL ."type a correct name";
        }


        if (isset($_POST['edit_price']))
        {
          try
          {
            require "config.php";
          $connection = new PDO($dsn, $username, $password, $options);

             $sql = "UPDATE products SET price = :price WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':price', $_POST['product_price'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();

            echo "Price updated!".  PHP_EOL;
            header("Refresh:1");
           } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
              }
        }
        if (isset($_POST['idparents']))
        {
          try
          {
            require "config.php";
          $connection = new PDO($dsn, $username, $password, $options);

             $sql = "UPDATE products SET category_id = :category_id WHERE id=:id";
              $statement = $connection->prepare($sql);
              $statement->bindParam(':category_id', $_POST['idparents'], PDO::PARAM_STR);
              $statement->bindParam(':id', $value, PDO::PARAM_STR);
              $statement->execute();

            echo "Category_id updated!".  PHP_EOL;
            header("Refresh:1");
           } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
              }
        }
        ?>
        <br>
        <br>
      <?php echo '<a href="areyousure.php?value='. $value .'">DELETE THIS PRODUCT </a>'; ?>


      </tbody>
      </table>
    <?php } ?>
      <?php
      function escape($html) {
      return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
      }
      ?>
  </body>
  </html>
