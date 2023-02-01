<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Removed</title>
</head>

<body>
    <?php
    include("Connection.php");


    $isbn = $_REQUEST["isbn"];


    $query = "select * from books where isbn = $isbn ";



    $result = mysqli_query($con, $query);
     if($isbn !=0){
    if (mysqli_num_rows($result) > 0) {
    ?>
        <center>
            <h1 style="color: red;">Book Removed</h1>
        </center>
        <table border="2" align="center" cellpadding="5" cellspacing="5">
            <tr>
                <th> Book Title </th>
                <th> Isbn </th>
                <th> Author </th>
                <th> Edition </th>
                <th> Publication </th>
            </tr>

            <?php

            while ($row = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                    <td><?php echo $row["BookTitle"]; ?> </td>
                    <td><?php echo $row["Isbn"]; ?> </td>
                    <td><?php echo $row["Author"]; ?> </td>
                    <td><?php echo $row["Edition"]; ?> </td>
                    <td><?php echo $row["Publication"]; ?> </td>
                </tr>
             
        <?php
        //  DELETING BOOK FROM DB
         $sql = "DELETE FROM books WHERE isbn=$isbn";
                mysqli_query($con, $sql);
        // GETTING TOTAL BOOKS AND SUBTRACTING ONE 
            $sql = "select Total_Books from totalbooks ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $val = $row['Total_Books'];
            $Int = (int)$val;
            $Int--;
        //UPDATING TOTAL BOOKS
            $sql = "UPDATE `totalbooks` SET `Total_Books`=$Int ;";
            mysqli_query($con, $sql);
            }
        } else
            echo "<center>No books found in the library by the isbn <b>$isbn</b> </center>";
    
    }else
            echo "<center>No books found in the library by the isbn <b>$isbn</b> </center>";
        ?>
        </table>


</body>

</html>