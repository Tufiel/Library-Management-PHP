<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Books Info</title>
    <link rel="stylesheet" href="navbar.css">

</head>

<body>

    <?php
    include "Connection.php";
    include "Navbar.php";

    if (isset($_POST['Change'])) {

      $TotalBooks = $_POST['TotalBooks'];
      $IssuedBooks = $_POST['IssuedBooks'];
      $BooksNotReturned = $_POST['BooksNotReturned'];

      if($TotalBooks)
      {
        $sql = "UPDATE `totalbooks` SET `Total_Books`='$TotalBooks'";
        mysqli_query($con,$sql);
        echo '<h3 style="color:blue">Total Books Set to <span style="color:green;font-size:900;">'.$TotalBooks.'</span></h3>';
      }
     if ($IssuedBooks) {
        $sql = "UPDATE `issuedbooks` SET `Issued_Books`='$IssuedBooks'";
        mysqli_query($con, $sql);
        echo '<h3 style="color:blue">Total Books Issued Set to <span style="color:green;font-size:900;">' . (int)$IssuedBooks . '</span></h3>';
      }
        
    if ($BooksNotReturned) {
       $sql = "UPDATE `booksnotreturned` SET `Books_Not_Returned`='$BooksNotReturned'";
       mysqli_query($con, $sql);
     echo '<h3 style="color:blue">Total Books not returned yet Set to <span style="color:green;font-size:900;">' . $BooksNotReturned . '</span></h3>';
    }


    }

    ?>

    <center>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="number" name="TotalBooks" placeholder="Number of Books"><br><br>

            <input type="number" name="IssuedBooks" placeholder="Total Issued Books"><br><br>

            <input type="number" name="BooksNotReturned" placeholder="Books Not Returned"><br><br>

             <input type="submit" name="Change" value="Change">
        </form>



    </center>


</body>

</html>