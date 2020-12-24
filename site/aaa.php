
<!doctype HTML>
<html>
<head>
</head>
<body>


<?php

  try
  {
    require "config.php";
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM products
    ORDER BY id DESC LIMIT 1";




$statement = $connection->prepare($sql);

$statement->execute();

$result = $statement->fetchAll();
} catch(PDOException $error) {
echo $sql . $error->getMessage();
}


if ($result && $statement->rowCount() > 0)
    { ?>
      <h2>Product specs</h2>

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
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["category_id"]; ?></td>


            </tr>
            <?php }
}?>
</tbody>
</table>
</body>
</html>