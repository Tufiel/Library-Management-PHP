<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove User</title>
    <link rel="stylesheet" href="Navbar.css">
</head>

<body>

    <?php
    include "Connection.php";
    include "Navbar.php";

    if (isset($_POST['Remove']))
    {
        $id = $_POST['id'];
                        $sql = "SELECT * FROM registration where id=$id";
                        $obj = mysqli_query($con, $sql);
                        if (mysqli_num_rows($obj) > 0) {
                            $arr = mysqli_fetch_array($obj);
                            $fname = $arr['FName'];
                            $lname = $arr['LName'];
            echo "<b style='color:red;font-size:900;'>" . $fname . " " . $lname . "</b> with id <b style='color:red;font-size:900;'>".$id. "</b> removed";
                        }
      $sql = "DELETE FROM `registration` WHERE Id=$id;";
      mysqli_query($con,$sql);

      $sql = "SELECT * FROM totalusers";
      $obj = mysqli_query($con, $sql);
      $var;
      if (mysqli_num_rows($obj) > 0) {
        $arr = mysqli_fetch_array($obj);
        $var = (int)$arr['Total_Users'];
        $var--;
      }

      $sql = "UPDATE totalusers SET Total_Users=$var";
      mysqli_query($con, $sql);
      
    }

      if(isset($_POST['confirm']))
      {
        $id = $_POST['id'];
        $sql = "SELECT * FROM registration where id=$id";
        $obj = mysqli_query($con,$sql);
        if(mysqli_num_rows($obj)>0)
        {
            $arr = mysqli_fetch_array($obj);
            $fname = $arr['FName'];
            $lname = $arr['LName'];
            echo "Are you sure you want to Remove <b style='color:red;font-size:900;'>".$fname." ". $lname. "</b> with id <b style='color:red;font-size:900;'>". $id."</b><br>";
         ?>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <input hidden  type="text" name="id" value="<?php echo $id ?>">
          <input type="submit" name="Remove" value="Yes">
        </form>
         <a href="http://localhost:8080/FTK/Project/RemoveUser.php"> <input type="button" value="No"> </a>

         <?php
        }
        else
        echo "No user found with id <b style='color:red;font-size:900;'>".$id."</b>";

        mysqli_close($con);
      }


    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

     <input type="text" placeholder="Id" name="id">
     <input type="submit" name="confirm" value="Remove">
</form>


</body>

</html>