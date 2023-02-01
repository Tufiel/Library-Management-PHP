<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
    <style>
        * {
            transition: all 400ms linear;
        }

        .login-box {
            box-shadow: 15px 15px 10px black;
        }

        .login-box:hover {
            box-shadow: 0px 0px 0px;
        }

        .button {
            padding: 5px;
            border-radius: 10%;
            font-weight: bold;
            color: white;
        }

        ::placeholder {
            color: rgba(255, 215, 0, 0.5);
        }

        .button:hover {
            transform: scale(0.95);
            background-color: gold;
            color: rgba(0, 0, 0, 0.675);
            border: 0;
        }

        #yo {
            position: absolute;
            width: 97%;
            right: 1.5px;
            height: 80vh;
            z-index: -20;
            opacity: 0.3;
        }

        img {
            position: absolute;
            width: 100%;
            height: 100vh;
            z-index: -12;
            opacity: 0.3;
        }

        .button {
            padding: 6px;
        }

        input {
            min-height: 5vh;
            text-align: center;
             /* text-transform: uppercase; */
        }

        @media only screen and (min-width:200px) and (max-width:812px) {
            div {
                padding-top: 60px;
                padding-bottom: 60px;
            }
        }
    </style>
</head>

<body>
    <img src="addbook1.jpg" alt="" srcset="">
    <form action="AdminVerify.php" method="post">
        <center>
            <div class="login-box">

                <img id="yo" src="login.png" alt="Login " width="60px">

                <h1 style="color:white;">Login</h1>

                <div class="textbox">

                    <input class="1" type="text" placeholder="Email" name="email" value="" style="color:white;">
                </div>

                <div class="textbox">
                    <input class="text" type="password" placeholder="Password" name="pass" value="" style="color:white;">
                </div>

                <input class="button" type="submit" name="login" value="Sign In">
            </div>
        </center>
    </form>
</body>

</html>