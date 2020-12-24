<!doctype html>
<html>
<head>
  <title>Search bar</title>
</head>

<body>
  <form method="post">
    <label>Search</label>
    <input type="text" name="search" placeholder="What are you looking for?">


  <label for="order">Filter by</label>

<select name="products-order" id="products-order">
  <option value="ORDER BY name ASC;" name="1">Alphabetically</option>
  <option value="ORDER BY name DESC; " name="2">reverse Alphabetically</option>
  <option value="ORDER BY price ASC;" name="3">increasing Price</option>
  <option value="ORDER BY price DESC;"name ="4">decreasing price</option>
</select>
  <input type="submit" name="submit">
</form>


</body>
</html>


<?php

      function checkClosestvalue($searched)
      {
        if (empty($searched))
        { die; }
        require "config.php";
        try {

              $connection = new PDO($dsn, $username, $password, $options);
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



          $connection = new PDO($dsn, $username, $password, $options);
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
     <h2>Search Result (products)</h2>

     <table>
         <thead>
         <tr>
          <th>Name</th>
          <?php if ($result && $statement->rowCount() > 0) echo '<th>Price</th>';?>

         </tr>
         </thead>
         <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>

                       <td> <a href="produit.php?value=<?php echo escape($row["id"]);?>"><?php echo escape($row["name"]); ?></a></td>
                       <td><?php echo escape($row["price"]); ?></td>

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



        $connection = new PDO($dsn, $username, $password, $options);

        if (($order=="ORDER BY name ASC;" )||($order=="ORDER BY name DESC; "))
        {
        $sql55 = "SELECT name FROM categories where name = '$str2' $order";

          $statement55 = $connection->prepare($sql55);
          $statement55->execute();

          $result55=$statement55->fetchAll();
        }
        else echo" cannot filter categories by prices";
          if ($result55 && $statement55->rowCount() > 0)
          {

            try {
                if (($order=="ORDER BY name ASC;" )||($order=="ORDER BY name DESC; "))
                {
                  $connection = new PDO($dsn, $username, $password, $options);
                  $sql56 = "SELECT products.name AS productname, products.id AS productid, products.category_id, products.price AS productprice,
                  categories.name AS name, categories.id  FROM products

                  INNER JOIN categories ON products.category_id = categories.id WHERE categories.name LIKE '$str2%' $order";

                    $statement56 = $connection->prepare($sql56);
                    $statement56->execute();

                    $result56=$statement56->fetchAll();
                    if ($result56 && $statement56->rowCount() > 0)
                    {
                      ?>
                        <h2>Search Result (categories)</h2>

                          <table>
                              <thead>
                              <tr>
                               <th>Category </th>
                               <th>Product</th>
                               <th>Price</th>

                              </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($result56 as $row56) { ?>
                                       <tr>
                                  <td><?php echo escape($row56["name"]); ?></td>
                                  <td> <a href="produit.php?value=<?php echo escape($row56["productid"]);?>"><?php echo escape($row56["productname"]); ?></a></td>
                                  <td><?php echo escape($row56["productprice"]); ?></td>




                                      </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        <?php }
                  }
                  else
                  {
                    echo 'cannot filter categories by prices';
                  }
          }catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
          }



        }
      }catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
      }
  }
?>
