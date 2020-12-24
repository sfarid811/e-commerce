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
<?php
///////////////////// test si admin ////////////////

if (isset($_COOKIE['eshop']))
{
//  var_dump($_COOKIE['eshop']);
  require "config.php";
    try
    {
      $connection = new PDO($dsn, $root, $passdb, $options);
    $sql = "SELECT admin FROM users WHERE username=:username";
    $statement = $connection->prepare($sql);
    $statement->bindParam("username", $_COOKIE['eshop'], PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetchAll();

      foreach ($result as $R)
      {
       /* echo $R["admin"];*/
      }
      if ($R["admin"]==1)
    {/*    echo ' admin';*/  }
        else
          {
            echo "You don't have permission to acces this page.";
            exit;


        }
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
     }
}
else
  {

    header("Location: signin.php");
    exit();
}

//////////////////// fin test si admin /////////////
?>
<div>
    <form method="post">
      <h2> Create New Category</h2>

    	<label for="cat_name">Name of category</label>
    	<input type="text" name="cat_name" id="cat_name">
    	<label for="parent_cat" name="parent_cat" id="parent_cat">Choose a PARENT category</label>
        <select name="idparents" >
            <?php

            require "config.php";




                  try {
                        $connection = new PDO($dsn, $root, $passdb, $options);
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


  </div>


<div>

<?php

    if (isset($_POST['submit'])&&!empty($_POST['cat_name']))
    {
      require "config.php";




            try {

                    $connection = new PDO($dsn, $root, $passdb, $options);
                    $new_category = array(
                        "id" => 0,
                        "name" => $_POST['cat_name'],
                        "parent_id"  => $_POST['idparents'],

                        );
                  $cat_name =  $_POST['cat_name'];
                  $parent_cat =  $_POST['idparents'];



                  $query = $connection->prepare("SELECT name FROM categories WHERE name=:name");
                  $query->bindParam("name", $cat_name, PDO::PARAM_STR);
                  $query->execute();
                  var_dump($_POST['cat_name']);
            if ($query->rowCount() > 0)
              {
                echo "Category already exists ";

              }
            elseif (empty($_POST['cat_name']))
            {
              echo "Category name cannot be empty";
            }

            else
            {

                  $sql = sprintf(
                      "INSERT INTO %s (%s) values (%s)",
                      "categories",
                      implode(", ", array_keys($new_category)),
                      ":" . implode(", :", array_keys($new_category))
                              );

                  $statement = $connection->prepare($sql);
                  $statement->execute($new_category);
                   echo "category created";
                   header ("Refresh:1");


            }
          } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
          }
    }
?>
  </div>
  <br><br><br>
  <div>

    <p>Tree of category (Parent, -child, --grandchild etc..) </p>
    <?php


    try {
      require "config.php";
      $connection = new PDO($dsn, $root, $passdb, $options);
      $sql = "SELECT * FROM categories ORDER BY parent_id DESC";
       $statement = $connection->prepare($sql);
        $statement->execute();

    $result=$statement->fetchAll();

            }
    catch  (exception $e)
      {echo $e;}


    function TreeofCategories($result, $parent = 0, $depth = 0)
    {
        $ni=count($result);
        if($ni === 0 || $depth > 1000) return '';
        $tree = '';
        for($i=0; $i < $ni; $i++)
        {
            if($result[$i]['parent_id'] == $parent)
            {

                $tree .= str_repeat('-', $depth);
                $tree .= $result[$i]['name'] . '<br/>';
                $tree .= TreeofCategories($result, $result[$i]['id'], $depth+1);
            }
        }
        return $tree;
    }
    echo (TreeofCategories($result));


  ?>
</div>
<div>
    <form action="admin.php">
          <button type="submit">GO BACK TO ADMIN PAGE.</button></form>
  </div>

</body>
</html>
