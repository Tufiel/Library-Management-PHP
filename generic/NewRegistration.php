<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../CSS/usercss/Register.css">
  <link rel="stylesheet" href="../CSS/usercss/UserNav.css">
</head>

<body>

  <?php

  include 'Connection.php';

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
    $Id = $_POST['Id'];

    $query = "INSERT INTO `registration`(`UserName`, `Password`, `FName`, `LName`, `Id`, `Email`, `PNumber`, `Department`, `Age`, `Address`) VALUES ('$UserName', '$Password', '$FName', '$LName', '$Id', '$Email', '$PNumber','$Department', '$Age', '$Address') ";
    mysqli_query($con, $query);


    $sql = "SELECT * FROM totalusers";
    $obj = mysqli_query($con, $sql);
    $var;
    if (mysqli_num_rows($obj) > 0) {
      $arr = mysqli_fetch_array($obj);
      $var = (int)$arr['Total_Users'];
      $var++;
    }

    $sql = "UPDATE totalusers SET Total_Users=$var";
    mysqli_query($con, $sql);

    header("Location: http://localhost:8080/FTK/Project/UserLogin.php");

    mysqli_close($con);
  }


  ?>
  <center>
    <form class="navseperator" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <div class="form_wrapper">
        <div class="form_container">
          <div class="title_container">
            <h2> Registration Form</h2>
          </div>
          <div class="row clearfix">
            <div class="">
              <form>

                <div class="input_field">
                  <span><img class="regimg" src="https://img.icons8.com/ios-filled/50/null/user.png" /></span>
                  <input required="" oninvalid="this.setCustomValidity('Please Enter USer Name')" oninput="this.setCustomValidity('')" type="text" name="UserName" placeholder="User Name ">
                </div>

                <div class="input_field"> <span><img class="regimg" src="https://img.icons8.com/ios-glyphs/30/null/password1.png" /></span>
                  <input required="" oninvalid="this.setCustomValidity('Please Enter Password')" oninput="this.setCustomValidity('')" type="password" name="password" placeholder="Password" required />
                </div>

                <div class="row clearfix">
                  <div class="col_half">
                    <div class="input_field">
                      <input required="" oninvalid="this.setCustomValidity('Please Enter First Name')" oninput="this.setCustomValidity('')" type="text" name="FName" placeholder="First Name" />
                    </div>
                  </div>
                  <div class="col_half">
                    <div class="input_field">
                      <input type="text" name="LName" placeholder="Last Name" required />
                    </div>
                  </div>
                </div>

                <div class="input_field">
                  <span><img class="regimg" src="https://img.icons8.com/ios-filled/50/null/identification-documents.png" /> </span>
                  <input required="" oninvalid="this.setCustomValidity('Please Enter Id number')" oninput="this.setCustomValidity('')" type="text" name="Id" placeholder="Id Number ">
                </div>

                <div class="input_field">
                  <span> <img class="regimg" src="https://img.icons8.com/glyph-neue/64/null/gmail.png" /> </span>
                  <input required="" oninvalid="this.setCustomValidity('Please Enter Email Address')" oninput="this.setCustomValidity('')" type="email" name="Email" placeholder="Email" required />
                </div>

                <div class="input_field">
                  <span><img class="regimg" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/null/external-phone-networking-tanah-basah-glyph-tanah-basah.png" /></span>
                  <input type="text" name="PNumber" placeholder="Phone Number ">
                </div>

                <div class="input_field">
                  <span> <img class="regimg" src="https://img.icons8.com/ios-filled/50/null/department.png" /></span>
                  <input type="text" name="Department" placeholder="Department" required />
                </div>

                <div class="input_field">
                  <span><img class="regimg" src="https://img.icons8.com/metro/26/null/age.png" /></span>
                  <input type="text" name="Age" placeholder="Age ">
                </div>

                <textarea style="text-align: center;" name="Address" cols="20" rows="10" placeholder="Full Address"></textarea>


                <input class="button" type="submit" value="Register" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </form>
  </center>
  <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://www.solodev.com/assets/password/strength.js"></script>
  <script src="Password.js"></script>



</body>

</html>