<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Book Details </title>
    <link rel="stylesheet" href="Navbar.css">
</head>

<body>

    <?php
    include "Navbar.php";
    include "Connection.php";
    include "UpdateFine.php";

    $Id = $_POST['Id'];
    $Name = $_POST['BName'];
    $sql = "SELECT * FROM issuedbookdetails where Name LIKE '$Name' AND id=$Id ";
    $obj = mysqli_query($con, $sql);
    if ( mysqli_num_rows($obj) > 0) {
    ?>

        <table border="2" align="center" cellpadding="5" cellspacing="5">
            <row>
                <th>Book Name</th>
                <th>Isbn</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Due Days</th>
                <th>Fine</th>
            </row>

            <?php
            while ($arr = mysqli_fetch_array($obj)) {
            ?>
                <tr>
                    <td> <?php echo $arr["Name"]; ?> </td>
                    <td> <?php echo $arr["isbn"]; ?> </td>
                    <td> <?php echo $arr["IssueDate"]; ?> </td>
                    <td> <?php echo $arr["ReturnDate"]; ?> </td>
                    <td> <?php echo $arr["DueDays"]; ?> </td>
                    <td> <?php echo $arr["Fine"]; ?> </td>
                </tr>

        <?php
            }
        }
        ?>

        </table>


</body>

</html>