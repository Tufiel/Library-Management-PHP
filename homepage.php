<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="">
    <title>Library Amnagement System</title>
    <link rel="stylesheet" href="UserNav.css">
    <link rel="stylesheet" href="footer.css">
    <style>
        body {
            background-image: url("Lib_BackGround.jpg");
            width: 100%;
            height: 40vh;
            background-repeat: no-repeat;
            background-size: cover;
        }


        .middle {
            font-family: sans-serif;
            position: absolute;
            top: 20vh;
            left: 20vw;
            background-color: skyblue;
            padding: 20px;
            border-radius: 40%;
            text-align: center;
        }

        .middle h1 {
            font-weight: bold;
            font-size: 20px;
            color: black;
        }

        .middle2 {
            font-weight: 900;
            font-size: 33px;
            color: black;
            margin-top: 7px;
            letter-spacing: 2px;
        }

        .middle3 {
            font-weight: bold;
            font-size: 20px;
            color: black;
            margin-top: 8px;

        }

        .middle4:hover {
            background-color: transparent;
            border-radius: 4px;
            border: 2px solid;
        }
    </style>
</head>

<body>
    <?php include "UserNav.php"; ?>
    </div>
    <div class="middle">
        <h1><b>Library</b></h1>
        <div class="middle2">
            Mangement
        </div>
        <div class="middle3">
            System
        </div>

    </div>


    <?php include "footer.php" ?>
</body>

</html>