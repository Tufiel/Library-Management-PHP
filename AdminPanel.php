<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>

  <!-- **************** CSS FILES ******************* -->
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="popup.css">
  <link rel="stylesheet" href="AdminPanel.css">



</head>

<body>

  <div id="popup">
    <div id="popup-message"></div>
    <button onclick="hidePopup()">
      <div class="button">
        <div class="box">R</div>
        <div class="box">E</div>
        <div class="box">S</div>
        <div class="box">E</div>
        <div class="box">T</div>
        <div class="box">T</div>
        <div class="box">E</div>
        <div class="box">D</div>
      </div>
    </button>
  </div>

  <?php
  include "UpdateFine.php";
  include "Connection.php";
  include "Navbar.php";
  ?>

  <video id="vid" src="video1.mp4" width="99%" onloadedmetadata="this.muted = true" playsinline autoplay muted loop></video>

  <header>
    <h1 id="Name">LIBRARY MANAGEMENT SYSTEM <br>
    </h1>
  </header>
  <section class="counters">
    <div class="container">
      <div>

        <div class="counter" data-target="
        <?php
        $sql = "select Total_Books from totalbooks ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $val = $row['Total_Books'];
        $Int = (int)$val;
        echo  $Int;
        ?>
        
        ">0</div>

        <h3>Total Books</h3>
      </div>
      <div>

        <div class="counter" data-target="
        <?php
        $sql = "select Total_Users from totalusers ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $val = $row['Total_Users'];
        $Int = (int)$val;
        echo  $Int;
        ?>
        ">0</div>
        <h3>Total Users</h3>
      </div>
      <div>

        <div class="counter" data-target="
        <?php
        $sql = "select Issued_Books from issuedbooks ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $val = $row['Issued_Books'];
        $Int = (int)$val;
        echo  $Int;
        ?>">0</div>
        <h3>Total Issued Books till now</h3>
      </div>
      <div>

        <div class="counter" data-target="
        <?php
        $sql = "select Books_Not_Returned from booksnotreturned ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $val = $row['Books_Not_Returned'];
        $Int = (int)$val;
        echo  $Int;
        ?>
        ">0</div>
        <h3>Books not returned yet</h3>
      </div>
    </div>
  </section>

  <!--**************** JS FILES *************-->
  <script src="AdminPanel.js"></script>
  <script>
    document.getElementById("vid").style.filter = "brightness(50%)";
  </script>
</body>

</html>