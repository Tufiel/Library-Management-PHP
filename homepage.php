<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="">
    <title>Library management System</title>
    <link rel="stylesheet" href="CSS/usercss/footer.css">
    <link rel="stylesheet" href="CSS/usercss/HomePage.css">
    <link rel="stylesheet" href="CSS/usercss/UserNav.css">
</head>

<body>
 <?php
     include "userphp/UserNav.php";

    if (isset($_REQUEST['ContactUsMsg'])) {
        include "generic/Connection.php";
        $email = $_POST['email'];
        $message = $_POST['message'];
        $sql = "INSERT INTO `contactus`(`Email`, `Message`) VALUES ('$email','$message')";
        mysqli_query($con, $sql);
    }

 ?>

    
    <div class="middle">
        <h1><b>Library</b></h1>
        <div class="middle2">
            Mangement
        </div>
        <div class="middle3">
            System
        </div>

    </div>


    <?php include "userphp/footer.php" ?>
</body>

</html>