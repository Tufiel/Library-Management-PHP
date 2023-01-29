<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Books</title>
    <link rel="stylesheet" href="UserNav.css">
</head>

<body bgcolor="87ceeb">

    <?php include "UserNav.php"; ?>
    <div class="navseperator">

        <br>

        <?php
        include("Connection.php");


        $BookName = $_REQUEST["BookName"] ?? null;


        // $Isbn = $_REQUEST["Isbn"];//if search by isbn
        $query = "select BookTitle,Isbn,Author,Edition,Publication from books where books.BookTitle like '%$BookName%' "; //search with a book name in the table books

        //OR books.Isbn ='$Isbn'

        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
        ?>

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
                }
            } else
                echo "<center>No books found in the library by the name <b>$BookName</b> </center>";
            ?>
            </table>

    </div>

</body>

</html>