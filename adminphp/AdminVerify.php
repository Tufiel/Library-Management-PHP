<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    
  <?php
    include "Connection.php";
    $email = $_REQUEST["email"];
    $pass = $_REQUEST["pass"];
    $query = "select *from admin where BINARY email = '$email' and binary password = '$pass'";  
        $result = mysqli_query($con, $query);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

    
    if( $count == 1)
    header("Location: http://localhost:8080/FTK/Project/AdminPanel.php");
    else
    echo "<h1>Wrong email or password</h1>";

?>


</body>
</html>