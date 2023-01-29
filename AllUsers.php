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

    $sql = "SELECT * FROM registration";
    $obj = mysqli_query($con, $sql);

    if (mysqli_num_rows($obj)) {

    ?>
        <table border="2" align="center" cellpadding="5" cellspacing="5">
            <tr>
                <th>User Name</th>
                <th>Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Student Id</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Department</th>
                <th>Age</th>
                <th>Address</th>
                <th>Books Issued</th>
            </tr>

            <?php
            while ($user = mysqli_fetch_assoc($obj)) {
            ?>

                <tr>
                    <td> <?php echo $user['UserName']; ?> </td>
                    <td> <?php echo $user['Password']; ?> </td>
                    <td> <?php echo $user['FName']; ?> </td>
                    <td> <?php echo $user['LName']; ?> </td>
                    <td> <?php echo $user['Id']; ?> </td>
                    <td> <?php echo $user['Email']; ?> </td>
                    <td> <?php echo $user['PNumber']; ?> </td>
                    <td> <?php echo $user['Department']; ?> </td>
                    <td> <?php echo $user['Age']; ?> </td>
                    <td> <?php echo $user['Address']; ?> </td>
                    <td> <?php echo $user['BooksIssued']; ?> </td>
                </tr>

        <?php

            }
        } else
            echo "No user found ";
        ?>



</body>

</html>