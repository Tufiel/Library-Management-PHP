<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <?php

    include "Navbar.php";
    include "Connection.php";

    $sql = "SELECT * FROM admin";
    $obj = mysqli_query($con, $sql);

    if (mysqli_num_rows($obj)) {

    ?>
        <table border="2" align="center" cellpadding="5" cellspacing="5">
            <tr>
                <th>Email</th>
                <th>Password</th>
            
            </tr>

            <?php
            while ($user = mysqli_fetch_assoc($obj)) {
            ?>

                <tr>
                    <td> <?php echo $user['email']; ?> </td>
                    <td> <?php echo $user['password']; ?> </td>
                </tr>

        <?php

            }
        } else
            echo "No admin found ";
        ?>



</body>

</html>