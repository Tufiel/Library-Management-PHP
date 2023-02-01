<?php
session_start();
include "Connection.php";
include "SendMail.php";


$sql = "SELECT * FROM registration WHERE Id = '{$_SESSION["MyStdId"]}'";
$obj = mysqli_query($con, $sql);

if (mysqli_num_rows($obj) > 0)
{
   $arr = mysqli_fetch_array($obj);
   $pass = $arr['Password'];
   $FName = $arr['FName'];
   $LName = $arr['LName'];
   $EMAILTO = $arr['Email'];
   $username =$arr['UserName'];

    $subject = "Your Password for Library Management System Account";
    $message = "Hello " . $FName . " " . $LName . " Following are your account details <br><br>User Name : <b style='color:red;'>". $username.
    "</b><br>Password : <b style='color:red;'>" . $pass . "</b> <br> Email : <b style='color:red;'>". $EMAILTO."<br><br><h3 style='color:blue;'>Online library Management System";
    sendMail($EMAILTO, $subject, $message);
}
else
echo "<marquee>Sorry can't send your password rigth now!</marquee>";


?>