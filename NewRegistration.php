<?php
// check for form request method
if (isset($_POST['register'])) {

    include "Connection.php";
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Email = $_POST['Email'];
    $PNumber = $_POST['PNumber'];
    $Department = $_POST['Department'];
    $Age = $_POST['Age'];
    $Address = $_POST['Address'];

    $query = "INSERT INTO `registration`(`UserName`, `Password`, `FName`, `LName`, `Id`, `Email`, `PNumber`, `Department`, `Age`, `Address`) VALUES ('$UserName', '$Password', '$FName', '$LName', '$Id', '$Email', '$PNumber','$Department', '$Age', '$Address') ";

    mysqli_query($con, $query);
    mysqli_close($con);
}


?>
<center>
    <form class="navseperator" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input required="" oninvalid="this.setCustomValidity('Please Enter User Name')" oninput="this.setCustomValidity('')" type="text" name="UserName" placeholder="User name"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please enter password')" oninput="this.setCustomValidity('')" type="password" name="Password" placeholder="Password" id="myPassword">
        <input required="" oninvalid="this.setCustomValidity('Please Enter First Name')" oninput="this.setCustomValidity('')" type="text" name="FName" placeholder="First Name"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please Enter Last Name')" oninput="this.setCustomValidity('')" type="text" name="LName" placeholder="Last Name"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please Enter ID')" oninput="this.setCustomValidity('')" type="number" name="Id" placeholder="Id number"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please Enter Email')" oninput="this.setCustomValidity('')" type="email" name="Email" placeholder="Email"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please Enter Phone Number')" oninput="this.setCustomValidity('')" type="tel" name="PNumber" placeholder="Phone Number"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please Enter Department')" oninput="this.setCustomValidity('')" type="text" name="Department" placeholder="Department"><br><br>
        <input required="" oninvalid="this.setCustomValidity('Please Enter Age')" oninput="this.setCustomValidity('')" type="number" name="Age" placeholder="Age"><br><br>
        <textarea rows="10" cols="20" placeholder="Full Address" name="Address"></textarea><br><br>

        <button type="submit" name="register">Register</button>


    </form>
</center>
<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://www.solodev.com/assets/password/strength.js"></script>
<script src="Password.js"></script>

?>