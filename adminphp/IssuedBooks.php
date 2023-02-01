<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
    <link rel="stylesheet" href="Navbar.css">

</head>

<body bgcolor="87ceeb">



    
    

    <?php
    include("Connection.php");
    include "Navbar.php";
    include "UpdateFine.php";

    $query = "select * from IssuedBookDetails ";

    //OR books.Isbn ='$Isbn'

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>

        <table border="2" align="center" cellpadding="5" cellspacing="5">
            <tr>
                <th> id </th>
                <th> Isbn </th>
                <th> Issue Date </th>
                <th> Return Date </th>
                <th> Due Days </th>
                <th>Fine</th>
            </tr>

            <?php

            while ($row = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                    <td><?php echo $row["id"]; ?> </td>
                    <td><?php echo $row["isbn"]; ?> </td>
                    <td><?php echo $row["IssueDate"]; ?> </td>
                    <td><?php echo $row["ReturnDate"]; ?> </td>
                    <td><?php echo $row["DueDays"]; ?> </td>
                    <td><?php echo $row['Fine']; ?></td>
                </tr>

        <?php
            }
        } else
            echo "<center>No History for Issued Books </center>";
        ?>
        </table>

</body>

</html>