<!doctype html>
<html>
<head>
  <title>Search bar</title>
  <link rel="stylesheet" href="CSS/search_bar.css">
  <link rel="stylesheet" href="CSS/tab.css">
</head>

<body>

  <div class="container h-100">
  <form method="post">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="search" placeholder="What are you looking for ?">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>

  <!--  <h2 class="transformation">Filter by</h2> -->

<div class="products-order">
<select name="products-order" class="products-order">
  <option value="ORDER BY name ASC;" name="1">Alphabetically</option>
  <option value="ORDER BY name DESC; " name="2">reverse Alphabetically</option>
  <option value="ORDER BY price ASC;" name="3">increasing Price</option>
  <option value="ORDER BY price DESC;"name ="4">decreasing price</option>
</select>
  <input type="submit" name="submit" class="transformation1"value="Search">
</form>
</div>
</div>

</body>
</html>


<?php

      function checkClosestvalue($searched)
      {
        if (empty($searched))
        { die; }
        require "config.php";
        try {

          $connection = new PDO($dsn, $root, $passdb, $options);
              if (ctype_digit($searched))
              {

                  $sql = "SELECT products.price FROM products";

              }

              elseif (is_string($searched))
              {

                    $sql = "SELECT products.name, categories.name FROM products
                    INNER JOIN categories";
              }

              $statement = $connection->prepare($sql);
              $statement->execute();

              $db=$statement->fetchAll();

            }catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            }
          $shortest =-1;
          $db2 = array_flatten($db);

        foreach ($db2 as $value)
        {
          $lev = levenshtein($searched, $value);
          if ($lev== 1)
          {
            $closest = $value;
            $shortest = 0;
            break;
          }
          if ($lev <= $shortest || $shortest < 0)
          {
            $closest = $value;
            $shortest = $lev;
          }
        }
                //  echo "You have searched for: $searched. <br>";
                    if ($shortest == 0)
                     {
                      //  echo "Exact match found: $searched ";
                        return $searched;
                      }
                    else
                      {
                      //  echo "Did you mean: $closest ?";
                        return $closest;
                      }
      }

if (isset($_POST['submit'])&&!empty($_POST['submit']))
{

  $str  = checkClosestvalue($_POST["search"]);


$order = $_POST['products-order'];

    require "config.php";
    try {
          $connection = new PDO($dsn, $root, $passdb, $options);
        if(ctype_digit($str))
        {

          $sql = "SELECT * FROM products where price LIKE'$str%' $order";

            $statement = $connection->prepare($sql);
            $statement->execute();

            $result=$statement->fetchAll();
        }
        else
        {
          $sql = "SELECT * FROM products where name LIKE'$str%' $order";
          $statement = $connection->prepare($sql);
          $statement->execute();

            $result=$statement->fetchAll();

        }
          isCat($str);

        }
    catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
    }
 }


 if ($result && $statement->rowCount() > 0)
 {

   ?>
     <h3 class="cat">Search Result (products)</h3>

     <table class="content-table">
         <thead>
         <tr>
          <th>Name</th>

          <?php if ($result && $statement->rowCount() > 0) echo '<th>Price</th>';?>
          <th>Image</th>

         </tr>
         </thead>
         <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>

                       <td> <a href="ficheproduit.php?value=<?php echo escape($row["id"]);?>"><?php echo escape($row["name"]); ?></a></td>
                       <td><?php echo escape($row["price"]); ?></td>
                       <td> <a href="ficheproduit.php?value=<?php echo escape($row["id"]);?>"><img src="IMG/<?php echo $row['name'];?>.png"/></a></td>
                   </tr>

               <?php } ?>
       </tbody>
   </table>
<?php }

function escape($html)
        {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
        }

function array_flatten($array)
    {
    if (!is_array($array)) {
      return FALSE;
          }
          $result = array();
        foreach ($array as $key => $value) {
          if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
          }
          else {
            $result[$key] = $value;
          }
        }
        return $result;
      }

  function isCat($th1s)
      {
        $str2 = checkClosestvalue($th1s);
        $order = $_POST['products-order'];
        require "config.php";
        try {

          $connection = new PDO($dsn, $root, $passdb, $options);

              if (($order=="ORDER BY name ASC;" )||($order=="ORDER BY name DESC; "))
              {
              $sql55 = "SELECT name FROM categories where name = '$str2' $order";
              }
              elseif(($order=="ORDER BY price ASC;" )||($order=="ORDER BY price DESC;"))
              {

                $sql55 = "SELECT products.name AS name, products.id AS productid, products.category_id, products.price AS price,
                categories.name AS CATNAME, categories.id  FROM products
                INNER JOIN categories ON products.category_id = categories.id WHERE categories.name LIKE '$str2%' $order";
              }

                $statement55 = $connection->prepare($sql55);
                $statement55->execute();



                $result55=$statement55->fetchAll();

                if ($result55 && $statement55->rowCount() > 0)
                {

                  try {
                              if (($order=="ORDER BY name ASC;" )||($order=="ORDER BY name DESC; "))
                              {
                                $connection = new PDO($dsn, $root, $passdb, $options);
                                $sql56 = "SELECT products.name AS name, products.id AS productid, products.category_id, products.price AS price,
                                categories.name AS CATNAME, categories.id  FROM products
                                INNER JOIN categories ON products.category_id = categories.id WHERE categories.name LIKE '$str2%' $order";
                              }
                              elseif (($order=="ORDER BY price ASC;" )||($order=="ORDER BY price DESC;"))
                              {
                                $connection = new PDO($dsn, $root, $passdb, $options);
                                $sql56 = "SELECT products.name AS name, products.id AS productid, products.category_id, products.price AS price,
                                categories.name AS CATNAME, categories.id  FROM products
                                INNER JOIN categories ON products.category_id = categories.id WHERE categories.name LIKE '$str2%' $order";
                              }



                          $statement56 = $connection->prepare($sql56);
                          $statement56->execute();


                          $result56=$statement56->fetchAll();
                          if ($result56 && $statement56->rowCount() > 0)
                          {
                            ?>
                              <h3>Search Result (categories)</h3>



                                <table class="content-table">
                                    <thead>
                                    <tr>
                                     <th>Category </th>
                                     <th>Product</th>
                                     <th>Price</th>
                                     <th>Image</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                         <?php foreach ($result56 as $row56) { ?>
                                             <tr>
                                        <td><?php echo escape($row56["CATNAME"]); ?></td>
                                        <td> <a href="ficheproduit.php?value=<?php echo escape($row56["productid"]);?>"><?php echo escape($row56["name"]); ?></a></td>
                                        <td><?php echo escape($row56["price"]); ?></td>
                                          <td> <a href="ficheproduit.php?value=<?php echo escape($row56["productid"]);?>"><img src="IMG/<?php echo $row56['name'];?>.png"/></a></td>
                                            </tr>
                                          <?php } ?>
                                  </tbody>
                              </table>
                      <?php }
                    }catch(PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();
                    }



        }
      }catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }



      ?>
