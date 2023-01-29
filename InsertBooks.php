<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="UserNav.css">

</head>

<body>

    <?php
    include "Connection.php";
        include "UserNav.php"; 


    $Isbn = $_POST["Isbn"];
    $BookTitle = $_POST["BookTitle"];
    $author = $_POST["author"];
    $edition = $_POST["edition"];
    $publication = $_POST["publication"];

    $query = "insert into books(BookTitle,Isbn,Author,Edition,Publication) values('$BookTitle','$Isbn','$author','$edition','$publication')";
    $result = mysqli_query($con, $query);
    if ($result) {
        // UPDATING TOTAL BOOKS 
        $sql = "select Total_Books from totalbooks ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $val = $row['Total_Books'];
        $Int = (int)$val;
        $Int++;
        $sql = "UPDATE `totalbooks` SET `Total_Books`=$Int ;";
        mysqli_query($con, $sql);

        echo '<h3> Book information is inserted successfully  </h3>';
    } else
        echo "<h3> Sorry can't add this book may be there exists a book with same isbn number  </h3>";
    ?>


    </center>
</body>

</html>