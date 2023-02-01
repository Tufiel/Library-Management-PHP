<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new Book</title>
    <link rel="stylesheet" href="navbar.css">
    <style>
        input {
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <?php
        include "Connection.php";
        include "navbar.php";

        if (isset($_POST['submit'])) {

            $Isbn = $_POST["Isbn"];
            $BookTitle = $_POST["BookTitle"];
            $author = $_POST["author"];
            $edition = $_POST["edition"];
            $publication = $_POST["publication"];




            $sql = "SELECT BookTitle,Isbn FROM books where isbn=$Isbn";
            $obj = mysqli_query($con, $sql);

            if (mysqli_num_rows($obj) == 0) {



                $query = "insert into books(BookTitle,Isbn,Author,Edition,Publication) values('$BookTitle','$Isbn','$author','$edition','$publication') ";
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

                    echo '<h3 style="color:green;" >' . $BookTitle . ' successfully added to DataBase  </h3>';
                }
            } else {

                if ($obj) {
                    $arr = mysqli_fetch_array($obj);
                    echo "<h3> Sorry can't add this book there exists a book <span style='color:red;'>" . $arr['BookTitle'] . "</span> with same isbn number <span style='color:red;'>" . $arr['Isbn'] . "</span></h3>";
                }
            }
        }
        ?>


        <h1>Enter Book details below</h1><br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <td> <input type="text" required="" oninvalid="this.setCustomValidity('Please Enter ISBN')" oninput="this.setCustomValidity('')" placeholder= "Isbn" name="Isbn" size="48"></td>
            <br><br>

            <input type="text" required="" oninvalid="this.setCustomValidity('Please Enter Book Title')" oninput="setCustomValidity('')" placeholder=" Title" name="BookTitle" size="48">
            <br><br>

            <input type="text" required="" oninvalid="this.setCustomValidity('Please Enter Author Name')" oninput="setCustomValidity('')" placeholder=" Author" name="author" size="48">
            <br><br>

            <input type="text" required="" oninvalid="this.setCustomValidity('Please Enter Book Publication')" oninput="setCustomValidity('')" placeholder=" Publication" name="publication" size="48">
            <br><br>
            <td> <input required="" oninvalid="this.setCustomValidity('Please Enter Book Edition')" oninput="setCustomValidity('')" placeholder="Edition" type="text" name="edition" size="48">
                <br><br>
                <input type="submit" name="submit" value="submit"><br><br>
                <input type="reset" value="Reset">


        </form><br><br><br>
        <a href="SearchBooks.php"> Search Books </a><br>
    </center>
</body>

</html>