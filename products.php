<?php

      try
      {
        require "config.php";
      $connection = new PDO($dsn, $username, $password, $options);

         //$sql = "SELECT *
         //FROM products";
         $sql = "SELECT products.id AS prod_id, products.name AS prod_name, products.price, products.category_id, categories.id,
         categories.name AS cat_name FROM products
         INNER JOIN categories ON products.category_id = categories.id";
        // $sql = "SELECT * FROM 'products' LEFT JOIN 'categories' ON 'products'.'category_id' =
         //'categories'.'id'
        // WHERE 'id'.'category_id' = ?";


         $statement = $connection->prepare($sql);

         $statement->execute();

         $result = $statement->fetchAll();
       } catch(PDOException $error) {
         echo $sql . "<br>" . $error->getMessage();
          }


          if ($result && $statement->rowCount() > 0)
          {
            ?>
              <h2>List of Products</h2>

                <table>
                    <thead>
                    <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Price</th>
                     <th>Category_id</th>
                     <th>Belongs in</th>
                     <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($result as $row) { ?>
                             <tr>
                        <td><?php echo escape($row["prod_id"]); ?></td>
                        <td><?php echo escape($row["prod_name"]); ?></td>
                        <td><?php echo escape($row["price"]); ?></td>
                        <td><?php echo escape($row["category_id"]); ?></td>
                        <td><?php echo escape($row["cat_name"]); ?></td>
                        <td><?php echo '<a href="produit.php?value='. escape($row["prod_id"]).'">See/Edit this product </a>'; ?></td>



                            </tr>
                          <?php } ?>
                  </tbody>
              </table>
              <?php }
              function escape($html) {
                return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
              }
              ?>
