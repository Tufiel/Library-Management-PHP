<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Books</title>
    <link rel="stylesheet" href="Navbar.css">
</head>

<body bgcolor="87ceeb">

    <?php include "Navbar.php";



    ?>
    <div class="navseperator">


        <br>

        <?php
        include("Connection.php");

        $query = "select * from books ";
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
                    <th>Presently issued To</th>
                </tr>

                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["Presently_Issued_To"];
                    $FName = $LName = null;
                    if ($id) {
                        $query = "SELECT FName,LName from registration WHERE id=$id ";
                        $obj = mysqli_query($con, $query);
                        $arr = mysqli_fetch_array($obj);
                        $FName = $arr["FName"];
                        $LName = $arr["LName"];
                    }
                ?>

                    <tr>
                        <td><?php echo $row["BookTitle"]; ?> </td>
                        <td><?php echo $row["Isbn"]; ?> </td>
                        <td><?php echo $row["Author"]; ?> </td>
                        <td><?php echo $row["Edition"]; ?> </td>
                        <td><?php echo $row["Publication"]; ?> </td>
                        <?php if ($id) { ?>
                            <td><?php echo "<b>Id:</b>" . $id . " <b>Name:</b>" . $FName . " " . $LName ?>

                                <form action="UserBookDetails.php" method="post">
                                    <input hidden type="text" name="Id" value="<?php echo $id; ?>">
                                    <input hidden type="text" name="BName" value="<?php echo $row['BookTitle']; ?>">

                                    <input type="submit" value="More Info">
                                </form>

                            </td>
                        <?php } else { ?>
                            <td>No One</td>
                        <?php } ?>
                    </tr>

            <?php
                }
            }
            ?>
            </table>

    </div>

</body>

</html>