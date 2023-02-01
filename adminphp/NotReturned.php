<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Not Returned Yet</title>
    <link rel="stylesheet" href="navbar.css">

</head>

<body>
    <?php
    include "Connection.php";
    include "navbar.php";

    $sql = "SELECT * FROM books WHERE Presently_Issued_To != 0";

    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
    ?>

        <table  border="2" align="center" cellpadding="5" cellspacing="5">
            <tr>
                <th> Book Title </th>
                <th> Isbn </th>
                <th> Author </th>
                <th> Edition </th>
                <th> Publication </th>
                <th> Presently Issued TO</th>
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
                    <td><?php echo $row["Presently_Issued_To"]; ?> </td>

                </tr>

        <?php
            }
        } else
            echo "<center>All books have been returned</center>";
        ?>
        </table>

        </div>



</body>

</html>