<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="UserLogin.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="UserNav.css">
    <style>
        .Menubar {
            position: absolute;
            top: 8vh;
            right: 10px;
        }

       

       
    </style>

</head>

<body>
    <?php include 'UserNav.php'; ?>
    <img src="addbook1.jpg" alt="" srcset="">
    <center>
        <!-- <img src="book1.jpg" alt="" srcset=""> -->
       
            <div class="login-box">
                <h1 style="color:white;">User Login</h1>
                
                <form autocomplete="off" id="LoginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <img id="yo" src="login.png" alt="Login " width="60px">

                    <div class="textbox">
                        <input id="email" required="" o oninvalid="this.setCustomValidity('Please Enter email or username')" oninput="this.setCustomValidity('')" type="text" name="email" placeholder="Email or Username" style="color:white;">
                    </div>
                    <br>
                    <div class="textbox">
                        <input id="pass" required="" oninvalid="this.setCustomValidity('Please Enter Password')" oninput="this.setCustomValidity('')" type="password" name="pass" placeholder="Password" style="color:white;">
                    </div>

                    <button class="button" type="reset">Reset</button>
                    <button class="button" name="login" type="submit">Login</button>
                </form>
           
        </div>
    </center>
    <script>
        function EmailError() {
            var email = document.getElementById("email");
            email.setAttribute('placeholder', 'It was Invalid');
            email.style.backgroundColor = 'red';
            email.style.border = "5px solid red";
        }

        function PasswordError() {
            var pass = document.getElementById("pass");
            pass.setAttribute('placeholder', 'It was Invalid');
            pass.style.backgroundColor = 'red';
            pass.style.border = "5px solid red";

        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "Connection.php";
        $email = $_REQUEST["email"];
        $pass = $_REQUEST["pass"];
        $query = "select * from Registration where BINARY email = '$email' OR BINARY username = '$email' ";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {

            $query = "select * from Registration where BINARY email = '$email' OR BINARY username = '$email' AND  BINARY password = '$pass'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $arr = mysqli_fetch_array($result);
                $_SESSION['MyStdId'] = $arr['Id'];
                header("Location: http://localhost:8080/FTK/Project/UserPanel.php");
            } else
                echo '<script>PasswordError();</script>';
        } else
            echo '<script>EmailError();</script>';
    }

    ?>

</body>

</html>