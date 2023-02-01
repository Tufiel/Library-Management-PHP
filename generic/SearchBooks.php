<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <link rel="stylesheet" href="UserNav.css">
</head>

<body>
    <?php include "UserNav.php"; ?>

    <center>

        <form id="SearchForm" class="navseperator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input style="text-align: center;" required oninvalid="this.setCustomValidity('Please Enter Book Title')" oninput="this.setCustomValidity('')" placeholder="Title of the book" type="text" name="BookName" size="48">
            <br></br>
            <input type="submit" name="SearchBook" value="submit">
            <input type="reset" value="Reset">

            <br>
        </form>
        <br><br>
        <a href="AddBook.php"> Add Book </a><br>

        <?php
        if (isset($_POST['SearchBook'])) {

            include "Connection.php";
            $BookName = $_REQUEST["BookName"] ?? null;


            // $Isbn = $_REQUEST["Isbn"];//if search by isbn
            $query = "select BookTitle,Isbn,Author,Edition,Publication from books where books.BookTitle like '%$BookName%' "; //search with a book name in the table books

            //OR books.Isbn ='$Isbn'

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
        ?>

                <table class="navseperator" border="2" align="center" cellpadding="5" cellspacing="5">
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
                    echo "<center><br><br><br>No book found in the library by the name <b>$BookName</b> </center>";
            }
            ?>
                </table>


    </center>
</body>

</html>