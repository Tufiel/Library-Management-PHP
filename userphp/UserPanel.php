<?php session_start(); ?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Panel</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="UserPanel.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="UserPanel.js"></script>
  <link rel="stylesheet" href="popup.css">

  <style>
    #closeMsg {
      border: none;
      display: block;
      position: relative;
      bottom: 2px;
      padding: 0.3em 3.4em;
      font-size: 18px;
      background: transparent;
      cursor: pointer;
      user-select: none;
      overflow: hidden;
      color: royalblue;
      z-index: 1;
      font-family: inherit;
      font-weight: 500;
    }

    #closeMsg span {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: transparent;
      z-index: -1;
      border: 4px solid royalblue;
    }

    #closeMsg span::before {
      content: "";
      display: block;
      position: absolute;
      width: 8%;
      height: 500%;
      background: var(--lightgray);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-60deg);
      transition: all 0.3s;
    }

    #closeMsg:hover span::before {
      transform: translate(-50%, -50%) rotate(-90deg);
      width: 100%;
      background: royalblue;
    }

    #closeMsg:hover {
      color: white;
    }

    #closeMsg:active span::before {
      background: #2751cd;
    }


    #message {
      display: none;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 190px;
      height: 254px;
      background: rgb(223, 225, 235);
      border-radius: 50px;
      box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;

    }

    /* POPUP */
    #popup {
      display: none;
      box-sizing: border-box;
      width: 200px;
      height: 254px;
      background: rgba(217, 217, 217, 0.58);
      border: 1px solid white;
      box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
      backdrop-filter: blur(6px);
      border-radius: 17px;
      text-align: center;
      cursor: pointer;
      transition: all 0.5s;
      font-weight: bolder;
    }

    #popup:hover {
      border: 5px solid black;

    }

    .popupBtn {
      margin-top: 12px;
      height: 20px;
      width: 100px;
      border-radius: 10px;
      background: #333;
      justify-content: center;
      align-items: center;
      box-shadow: -5px -5px 15px #444, 5px 5px 15px #222, inset 5px 5px 10px #444, inset -5px -5px 10px #222;
      font-family: 'Damion', cursive;
      border: none;
      font-size: 10px;
      color: rgb(161, 161, 161);
      transition: 500ms;
    }

    .popupBtn:hover {
      box-shadow: -5px -5px 15px #444, 5px 5px 15px #222, inset 5px 5px 10px #222, inset -5px -5px 10px #444;
      color: #d6d6d6;
      transition: 500ms;
    }
  </style>

  <script>
    //********************* POPUP ***********************
    function showPopup() {
      document.getElementById("popup").style.display = "block";
    }

    function hidePopup() {
      document.getElementById("popup").style.display = "none";
    }

    function closeMsg() {
      document.getElementById("message").style.display = "none";

    }

    function forgotPassword() {
      // Make an HTTP request to the PHP file
      var exe = new XMLHttpRequest();
      exe.open("POST", "ForgotPassword.php", true);
      exe.send();
      document.getElementById("msg").style.display = "block";
      document.getElementById("msg").innerHTML = "Password send to your email id";
    }
  </script>

</head>



<body>
  <?php
  include 'Connection.php';

  $FName = $LName = $Age = $TotalBooksIssued = $Fine = $BooksNotReturned = null;
  $SId = $_SESSION['MyStdId'];
  $sql = "select * from registration where Id = $SId ";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $FName = $row['FName'];
    $LName = $row['LName'];
    $Age = $row['Age'];

    $val = $row['TotalBooksIssued'];
    $TotalBooksIssued = (int)$val;

    $val = $row['BooksIssued'];
    $BooksNotReturned = (int)$val;

    $Fine = 0;
    $sql = "select * from issuedbookdetails where id=$SId";
    $obj = mysqli_query($con, $sql);
    if (mysqli_num_rows($obj) > 0) {
      while ($arr = mysqli_fetch_array($obj))
        $Fine += (int)$arr['Fine'];
    }
  }

  ?>

  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
          Home
        </a>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="index.html">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              <span class="ml-4">Dashboard</span>
            </a>
          </li>
        </ul>

        <!-------------------------- CHANGE PASSWORD ---------------------------------------->

        <div id="popup">

          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="pass" required="" oninvalid="this.setCustomValidity('Please Enter New Password')" oninput="this.setCustomValidity('')" placeholder="Enter New Password">
            <input class="popupBtn" type="submit" name="ChangePassword" value="Change"><br><br>
            <input class="popupBtn" onclick="hidePopup();" type="button" value="Cancel">
          </form>

        </div>


        <?php

        if (isset($_POST['ChangePassword'])) {
          $NewPass = $_POST['pass'];
          $sql = "UPDATE `registration` SET `Password`='$NewPass' WHERE  Id=$SId";

          if (mysqli_query($con, $sql))
            echo '<style> #message{display:block;}</style>';
          else
            echo '<marquee>Failed to change password sorry </marquee>';
        }

        ?>
        <center>
          <div id="message">
            <h5><br>Password changed to <br>"<?php echo $NewPass ?>"<br> successfully</h5>
            <button onclick="closeMsg()" id="closeMsg">Ok <span></span></button>
          </div>
        </center>

        <ul>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="UserBookRequest.php">
              <svg class="w-5 h-5" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M903.730334 183.712672l-57.869998-0.55085c-0.733102 0-91.938759-5.443998-128.643-11.866831-79.154527-13.8245-142.529957-12.603004-209.451102 35.234966-68.571648-47.286096-114.940343-50.221575-204.129969-35.052714-7.523509 1.283952-14.741901 2.630361-21.89886 3.977794-26.790983 5.136833-104.050298 8.258659-104.050298 8.258659H120.002432c-12.969555 0-23.489977 10.520422-23.489977 23.489977v599.172573c0 12.969555 10.520422 23.489977 23.489977 23.489977h292.827107c-0.673717 2.079511-1.346409 4.159022-1.346409 6.483242 0 12.603004 10.642264 22.819332 23.918985 22.819332h146.138128c13.273649 0 23.97837-10.216328 23.978371-22.819332 0-2.32422-0.673717-4.403731-1.405795-6.483242h299.617515c13.028941 0 23.552434-10.520422 23.552434-23.489977V207.202649c0-12.969555-10.523493-23.489977-23.552434-23.489977z" fill="#27323A"></path>
                  <path d="M143.551794 230.752012h30.709393v552.133233H143.551794z" fill="#FFFFFF"></path>
                  <path d="M206.621082 230.937335c33.951013-0.184299 59.579887-4.710896 83.865424-9.298927a825.054986 825.054986 0 0 1 21.043915-3.855952c88.086902-14.924152 119.773081-8.929304 178.498024 33.768762 0.366551 0.244709 0.736174 0.366551 1.102724 0.550851v497.934887c-76.097205-66.738893-144.487625-40.252004-230.309693-6.483242l-54.19937 22.631961c-0.12389-92.309405-0.12389-431.198042-0.001024-535.24834z" fill="#79CCBF"></path>
                  <path d="M272.564417 772.302366c88.512839-34.805958 141.916649-55.727007 208.470219 10.523494 0 0 0.062457 0.059385 0.121842 0.059385H247.17718l25.387237-10.582879zM534.745612 782.885245c0.304094-0.244709 0.733102-0.429008 1.040268-0.733102 61.41469-66.921145 119.465916-45.022286 215.323084-8.932376l23.611819 9.665478H534.745612z" fill="#F4CE73"></path>
                  <path d="M814.847873 765.87851l-52.363543-21.532309c-93.163326-35.109028-167.485114-62.883965-240.034556 7.281873v-498.30451c1.405795-0.673717 2.87507-1.221495 4.159022-2.201354 57.562833-45.022286 108.578943-46.491561 182.535204-33.522005 29.055818 5.076423 80.197866 9.480154 105.703873 11.437823 0.243685 103.321292 0.243685 445.697282 0 536.840482z" fill="#79CCBF"></path>
                  <path d="M846.108116 230.752012h34.132241v552.133233h-34.132241z" fill="#FFFFFF"></path>
                </g>
              </svg>
              <span class="ml-4">Request for Book </span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="ReturnBookUser.php">
              <svg class="w-5 h-5" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M903.730334 183.712672l-57.869998-0.55085c-0.733102 0-91.938759-5.443998-128.643-11.866831-79.154527-13.8245-142.529957-12.603004-209.451102 35.234966-68.571648-47.286096-114.940343-50.221575-204.129969-35.052714-7.523509 1.283952-14.741901 2.630361-21.89886 3.977794-26.790983 5.136833-104.050298 8.258659-104.050298 8.258659H120.002432c-12.969555 0-23.489977 10.520422-23.489977 23.489977v599.172573c0 12.969555 10.520422 23.489977 23.489977 23.489977h292.827107c-0.673717 2.079511-1.346409 4.159022-1.346409 6.483242 0 12.603004 10.642264 22.819332 23.918985 22.819332h146.138128c13.273649 0 23.97837-10.216328 23.978371-22.819332 0-2.32422-0.673717-4.403731-1.405795-6.483242h299.617515c13.028941 0 23.552434-10.520422 23.552434-23.489977V207.202649c0-12.969555-10.523493-23.489977-23.552434-23.489977z" fill="#27323A"></path>
                  <path d="M143.551794 230.752012h30.709393v552.133233H143.551794z" fill="#FFFFFF"></path>
                  <path d="M206.621082 230.937335c33.951013-0.184299 59.579887-4.710896 83.865424-9.298927a825.054986 825.054986 0 0 1 21.043915-3.855952c88.086902-14.924152 119.773081-8.929304 178.498024 33.768762 0.366551 0.244709 0.736174 0.366551 1.102724 0.550851v497.934887c-76.097205-66.738893-144.487625-40.252004-230.309693-6.483242l-54.19937 22.631961c-0.12389-92.309405-0.12389-431.198042-0.001024-535.24834z" fill="#79CCBF"></path>
                  <path d="M272.564417 772.302366c88.512839-34.805958 141.916649-55.727007 208.470219 10.523494 0 0 0.062457 0.059385 0.121842 0.059385H247.17718l25.387237-10.582879zM534.745612 782.885245c0.304094-0.244709 0.733102-0.429008 1.040268-0.733102 61.41469-66.921145 119.465916-45.022286 215.323084-8.932376l23.611819 9.665478H534.745612z" fill="#F4CE73"></path>
                  <path d="M814.847873 765.87851l-52.363543-21.532309c-93.163326-35.109028-167.485114-62.883965-240.034556 7.281873v-498.30451c1.405795-0.673717 2.87507-1.221495 4.159022-2.201354 57.562833-45.022286 108.578943-46.491561 182.535204-33.522005 29.055818 5.076423 80.197866 9.480154 105.703873 11.437823 0.243685 103.321292 0.243685 445.697282 0 536.840482z" fill="#79CCBF"></path>
                  <path d="M846.108116 230.752012h34.132241v552.133233h-34.132241z" fill="#FFFFFF"></path>
                </g>
              </svg>
              <span class="ml-4">Return Book</span>
            </a>
          </li>



          <li class="relative px-6 py-3">
            <button class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg class="w-5 h-5" viewBox="0 0 600 600" version="1.1" id="svg9724" sodipodi:docname="settings.svg" inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <defs id="defs9728"></defs>
                    <sodipodi:namedview id="namedview9726" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:showpageshadow="2" inkscape:pageopacity="0.0" inkscape:pagecheckerboard="0" inkscape:deskcolor="#d1d1d1" showgrid="true" inkscape:zoom="1.1896171" inkscape:cx="205.52832" inkscape:cy="369.44661" inkscape:window-width="1920" inkscape:window-height="1009" inkscape:window-x="0" inkscape:window-y="1080" inkscape:window-maximized="1" inkscape:current-layer="g10449" showguides="true">
                      <inkscape:grid type="xygrid" id="grid9972" originx="0" originy="0"></inkscape:grid>
                    </sodipodi:namedview>
                    <g id="g10449" transform="matrix(0.95173205,0,0,0.95115787,13.901174,12.168794)" style="stroke-width:1.05103">
                      <path id="path1129" style="color:#000000;fill:#000000;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke fill markers" d="m -899.99998,-310.79461 c -20.43409,0 -40.0078,4.62259 -52.90398,19.2757 -12.89618,14.65312 -13.31011,30.27623 -14.05636,39.78187 -0.74624,9.50565 -1.36732,15.42265 -2.80675,19.0879 -1.43942,3.66526 -2.62672,6.46545 -11.63186,11.66458 -9.00514,5.19911 -12.02109,4.82429 -15.91499,4.23825 -3.89398,-0.58605 -9.32638,-3.00427 -17.93168,-7.11083 -8.6053,-4.10655 -22.3462,-11.56116 -41.4843,-7.71929 -19.138,3.84186 -32.9287,18.48118 -43.1458,36.17762 -10.2171,17.69644 -15.9985,36.95986 -9.7566,55.45483 6.2418,18.49497 19.5659,26.66798 27.4249,32.06708 7.859,5.39908 12.6704,8.893362 15.1249,11.972567 2.4545,3.079205 4.2876,5.506097 4.2876,15.904332 0,10.398237 -1.8331,12.825128 -4.2876,15.904333 -2.4545,3.079204 -7.2659,6.57348 -15.1249,11.972569 -7.859,5.39909 -21.1831,13.572101 -27.4249,32.067077 -6.2419,18.4949758 -0.4605,37.758386 9.7566,55.454828 10.2171,17.696443 24.0078,32.335764 43.1458,36.177623 19.1381,3.84186 32.879,-3.612739 41.4843,-7.719295 8.6053,-4.106556 14.0377,-6.52478 17.93168,-7.110826 3.8939,-0.586047 6.90985,-0.960867 15.91499,4.238251 9.00514,5.199118 10.19243,7.999328 11.63186,11.664579 1.43943,3.665252 2.06051,9.582259 2.80675,19.087903 0.74625,9.505639 1.16018,25.128749 14.05636,39.781869 12.89618,14.65311 32.46989,19.2757 52.90398,19.2757 20.43409,0 40.0078,-4.62259 52.90398,-19.2757 12.89617,-14.65312 13.31011,-30.27623 14.05635,-39.781869 0.74624,-9.505644 1.36733,-15.422651 2.80676,-19.087903 1.43942,-3.665251 2.62672,-6.465461 11.63186,-11.664579 9.00513,-5.199119 12.02108,-4.824297 15.91499,-4.238251 3.89392,0.586046 9.32639,3.004271 17.93164,7.110826 8.60525,4.106555 22.34625,11.561156 41.48432,7.719295 19.13806,-3.84186 32.92874,-18.481179 43.14579,-36.177623 10.21705,-17.696442 15.99856,-36.9598523 9.75668,-55.454828 -6.24189,-18.494976 -19.56594,-26.667988 -27.42495,-32.067077 -7.859,-5.399088 -12.67039,-8.893365 -15.12488,-11.972569 -2.45449,-3.079205 -4.28764,-5.506097 -4.28764,-15.904333 0,-10.398236 1.83315,-12.825127 4.28764,-15.904332 2.45449,-3.079205 7.26588,-6.573487 15.12488,-11.972567 7.85901,-5.3991 21.18307,-13.57211 27.42495,-32.06708 6.24188,-18.49497 0.46037,-37.75839 -9.75668,-55.45483 -10.21705,-17.69644 -24.00773,-32.33576 -43.14579,-36.17762 -19.13807,-3.84186 -32.87907,3.61274 -41.48432,7.71929 -8.60525,4.10656 -14.03772,6.52478 -17.93164,7.11083 -3.89391,0.58604 -6.90986,0.96086 -15.91499,-4.23825 -9.00514,-5.19913 -10.19243,-7.99932 -11.63186,-11.66458 -1.43943,-3.66525 -2.06052,-9.58225 -2.80676,-19.0879 -0.74624,-9.50564 -1.16018,-25.12875 -14.05635,-39.78187 -12.89618,-14.65311 -32.46989,-19.2757 -52.90398,-19.2757 z m 0.0181,130.78031 c 55.63168,0 100.16735,44.4506 100.16735,100.014299 0,55.563699 -44.53567,100.014302 -100.16735,100.014302 -55.63168,0 -100.16738,-44.450603 -100.16738,-100.014302 0,-55.563699 44.5357,-100.014299 100.16738,-100.014299 z" transform="matrix(1.3636076,0,0,1.3667651,1527.8554,411.9526)" sodipodi:nodetypes="ssssssssscssssscssssssssssssssssssssssssssssssssssssss"></path>
                      <g id="path10026" inkscape:transform-center-x="-0.59233046" inkscape:transform-center-y="-20.347403" transform="matrix(1.3807551,0,0,1.2700888,273.60014,263.99768)"></g>
                      <g id="g11314" transform="matrix(1.5092301,0,0,1.3955555,36.774048,-9.4503933)" style="stroke-width:50.6951"></g>
                      <path style="color:#000000;fill:#020202;stroke-width:1.05103;stroke-linejoin:round;paint-order:stroke fill markers" d="m 300.60937,218.51428 c -46.03938,0 -84.05805,38.06434 -84.05805,84.09712 0,46.03278 38.01867,84.09711 84.05805,84.09711 46.03938,0 84.05649,-38.06433 84.05649,-84.09711 0,-46.03278 -38.01711,-84.09712 -84.05649,-84.09712 z" id="path344" sodipodi:nodetypes="sssss"></path>
                    </g>
                  </g>
                </svg>
                <span class="ml-4">Settings</span>
              </span>

              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <template x-if="isPagesMenuOpen">
              <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
                <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                  <buttton onclick="showPopup()" class="w-full">Change Password</buttton>
                </li>


                <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                  <buttton onclick="forgotPassword();" class="w-full">Forgot Password</buttton>
                </li>

                <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                  <a href="http://localhost:8080/FTK/Project/UserLogin.php" class="w-full">Log Out</a>
                </li>

              </ul>
            </template>
          </li>
        </ul>


      </div>
    </aside>

    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
    <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
          Home
        </a>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="index.html">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              <span class="ml-4">Dashboard</span>

            </a>
          </li>
        </ul>
        <ul>

          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="forms.html">
              <svg class="w-5 h-5" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M903.730334 183.712672l-57.869998-0.55085c-0.733102 0-91.938759-5.443998-128.643-11.866831-79.154527-13.8245-142.529957-12.603004-209.451102 35.234966-68.571648-47.286096-114.940343-50.221575-204.129969-35.052714-7.523509 1.283952-14.741901 2.630361-21.89886 3.977794-26.790983 5.136833-104.050298 8.258659-104.050298 8.258659H120.002432c-12.969555 0-23.489977 10.520422-23.489977 23.489977v599.172573c0 12.969555 10.520422 23.489977 23.489977 23.489977h292.827107c-0.673717 2.079511-1.346409 4.159022-1.346409 6.483242 0 12.603004 10.642264 22.819332 23.918985 22.819332h146.138128c13.273649 0 23.97837-10.216328 23.978371-22.819332 0-2.32422-0.673717-4.403731-1.405795-6.483242h299.617515c13.028941 0 23.552434-10.520422 23.552434-23.489977V207.202649c0-12.969555-10.523493-23.489977-23.552434-23.489977z" fill="#27323A"></path>
                  <path d="M143.551794 230.752012h30.709393v552.133233H143.551794z" fill="#FFFFFF"></path>
                  <path d="M206.621082 230.937335c33.951013-0.184299 59.579887-4.710896 83.865424-9.298927a825.054986 825.054986 0 0 1 21.043915-3.855952c88.086902-14.924152 119.773081-8.929304 178.498024 33.768762 0.366551 0.244709 0.736174 0.366551 1.102724 0.550851v497.934887c-76.097205-66.738893-144.487625-40.252004-230.309693-6.483242l-54.19937 22.631961c-0.12389-92.309405-0.12389-431.198042-0.001024-535.24834z" fill="#79CCBF"></path>
                  <path d="M272.564417 772.302366c88.512839-34.805958 141.916649-55.727007 208.470219 10.523494 0 0 0.062457 0.059385 0.121842 0.059385H247.17718l25.387237-10.582879zM534.745612 782.885245c0.304094-0.244709 0.733102-0.429008 1.040268-0.733102 61.41469-66.921145 119.465916-45.022286 215.323084-8.932376l23.611819 9.665478H534.745612z" fill="#F4CE73"></path>
                  <path d="M814.847873 765.87851l-52.363543-21.532309c-93.163326-35.109028-167.485114-62.883965-240.034556 7.281873v-498.30451c1.405795-0.673717 2.87507-1.221495 4.159022-2.201354 57.562833-45.022286 108.578943-46.491561 182.535204-33.522005 29.055818 5.076423 80.197866 9.480154 105.703873 11.437823 0.243685 103.321292 0.243685 445.697282 0 536.840482z" fill="#79CCBF"></path>
                  <path d="M846.108116 230.752012h34.132241v552.133233h-34.132241z" fill="#FFFFFF"></path>
                </g>
              </svg>
              <span class="ml-4">Request For Book</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="cards.html">
              <svg class="w-5 h-5" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M903.730334 183.712672l-57.869998-0.55085c-0.733102 0-91.938759-5.443998-128.643-11.866831-79.154527-13.8245-142.529957-12.603004-209.451102 35.234966-68.571648-47.286096-114.940343-50.221575-204.129969-35.052714-7.523509 1.283952-14.741901 2.630361-21.89886 3.977794-26.790983 5.136833-104.050298 8.258659-104.050298 8.258659H120.002432c-12.969555 0-23.489977 10.520422-23.489977 23.489977v599.172573c0 12.969555 10.520422 23.489977 23.489977 23.489977h292.827107c-0.673717 2.079511-1.346409 4.159022-1.346409 6.483242 0 12.603004 10.642264 22.819332 23.918985 22.819332h146.138128c13.273649 0 23.97837-10.216328 23.978371-22.819332 0-2.32422-0.673717-4.403731-1.405795-6.483242h299.617515c13.028941 0 23.552434-10.520422 23.552434-23.489977V207.202649c0-12.969555-10.523493-23.489977-23.552434-23.489977z" fill="#27323A"></path>
                  <path d="M143.551794 230.752012h30.709393v552.133233H143.551794z" fill="#FFFFFF"></path>
                  <path d="M206.621082 230.937335c33.951013-0.184299 59.579887-4.710896 83.865424-9.298927a825.054986 825.054986 0 0 1 21.043915-3.855952c88.086902-14.924152 119.773081-8.929304 178.498024 33.768762 0.366551 0.244709 0.736174 0.366551 1.102724 0.550851v497.934887c-76.097205-66.738893-144.487625-40.252004-230.309693-6.483242l-54.19937 22.631961c-0.12389-92.309405-0.12389-431.198042-0.001024-535.24834z" fill="#79CCBF"></path>
                  <path d="M272.564417 772.302366c88.512839-34.805958 141.916649-55.727007 208.470219 10.523494 0 0 0.062457 0.059385 0.121842 0.059385H247.17718l25.387237-10.582879zM534.745612 782.885245c0.304094-0.244709 0.733102-0.429008 1.040268-0.733102 61.41469-66.921145 119.465916-45.022286 215.323084-8.932376l23.611819 9.665478H534.745612z" fill="#F4CE73"></path>
                  <path d="M814.847873 765.87851l-52.363543-21.532309c-93.163326-35.109028-167.485114-62.883965-240.034556 7.281873v-498.30451c1.405795-0.673717 2.87507-1.221495 4.159022-2.201354 57.562833-45.022286 108.578943-46.491561 182.535204-33.522005 29.055818 5.076423 80.197866 9.480154 105.703873 11.437823 0.243685 103.321292 0.243685 445.697282 0 536.840482z" fill="#79CCBF"></path>
                  <path d="M846.108116 230.752012h34.132241v552.133233h-34.132241z" fill="#FFFFFF"></path>
                </g>
              </svg>
              <span class="ml-4">Return Book</span>
            </a>
          </li>

          <li class="relative px-6 py-3">
            <button class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg class="w-5 h-5" viewBox="0 0 600 600" version="1.1" id="svg9724" sodipodi:docname="settings.svg" inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <defs id="defs9728"></defs>
                    <sodipodi:namedview id="namedview9726" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:showpageshadow="2" inkscape:pageopacity="0.0" inkscape:pagecheckerboard="0" inkscape:deskcolor="#d1d1d1" showgrid="true" inkscape:zoom="1.1896171" inkscape:cx="205.52832" inkscape:cy="369.44661" inkscape:window-width="1920" inkscape:window-height="1009" inkscape:window-x="0" inkscape:window-y="1080" inkscape:window-maximized="1" inkscape:current-layer="g10449" showguides="true">
                      <inkscape:grid type="xygrid" id="grid9972" originx="0" originy="0"></inkscape:grid>
                    </sodipodi:namedview>
                    <g id="g10449" transform="matrix(0.95173205,0,0,0.95115787,13.901174,12.168794)" style="stroke-width:1.05103">
                      <path id="path1129" style="color:#000000;fill:#000000;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke fill markers" d="m -899.99998,-310.79461 c -20.43409,0 -40.0078,4.62259 -52.90398,19.2757 -12.89618,14.65312 -13.31011,30.27623 -14.05636,39.78187 -0.74624,9.50565 -1.36732,15.42265 -2.80675,19.0879 -1.43942,3.66526 -2.62672,6.46545 -11.63186,11.66458 -9.00514,5.19911 -12.02109,4.82429 -15.91499,4.23825 -3.89398,-0.58605 -9.32638,-3.00427 -17.93168,-7.11083 -8.6053,-4.10655 -22.3462,-11.56116 -41.4843,-7.71929 -19.138,3.84186 -32.9287,18.48118 -43.1458,36.17762 -10.2171,17.69644 -15.9985,36.95986 -9.7566,55.45483 6.2418,18.49497 19.5659,26.66798 27.4249,32.06708 7.859,5.39908 12.6704,8.893362 15.1249,11.972567 2.4545,3.079205 4.2876,5.506097 4.2876,15.904332 0,10.398237 -1.8331,12.825128 -4.2876,15.904333 -2.4545,3.079204 -7.2659,6.57348 -15.1249,11.972569 -7.859,5.39909 -21.1831,13.572101 -27.4249,32.067077 -6.2419,18.4949758 -0.4605,37.758386 9.7566,55.454828 10.2171,17.696443 24.0078,32.335764 43.1458,36.177623 19.1381,3.84186 32.879,-3.612739 41.4843,-7.719295 8.6053,-4.106556 14.0377,-6.52478 17.93168,-7.110826 3.8939,-0.586047 6.90985,-0.960867 15.91499,4.238251 9.00514,5.199118 10.19243,7.999328 11.63186,11.664579 1.43943,3.665252 2.06051,9.582259 2.80675,19.087903 0.74625,9.505639 1.16018,25.128749 14.05636,39.781869 12.89618,14.65311 32.46989,19.2757 52.90398,19.2757 20.43409,0 40.0078,-4.62259 52.90398,-19.2757 12.89617,-14.65312 13.31011,-30.27623 14.05635,-39.781869 0.74624,-9.505644 1.36733,-15.422651 2.80676,-19.087903 1.43942,-3.665251 2.62672,-6.465461 11.63186,-11.664579 9.00513,-5.199119 12.02108,-4.824297 15.91499,-4.238251 3.89392,0.586046 9.32639,3.004271 17.93164,7.110826 8.60525,4.106555 22.34625,11.561156 41.48432,7.719295 19.13806,-3.84186 32.92874,-18.481179 43.14579,-36.177623 10.21705,-17.696442 15.99856,-36.9598523 9.75668,-55.454828 -6.24189,-18.494976 -19.56594,-26.667988 -27.42495,-32.067077 -7.859,-5.399088 -12.67039,-8.893365 -15.12488,-11.972569 -2.45449,-3.079205 -4.28764,-5.506097 -4.28764,-15.904333 0,-10.398236 1.83315,-12.825127 4.28764,-15.904332 2.45449,-3.079205 7.26588,-6.573487 15.12488,-11.972567 7.85901,-5.3991 21.18307,-13.57211 27.42495,-32.06708 6.24188,-18.49497 0.46037,-37.75839 -9.75668,-55.45483 -10.21705,-17.69644 -24.00773,-32.33576 -43.14579,-36.17762 -19.13807,-3.84186 -32.87907,3.61274 -41.48432,7.71929 -8.60525,4.10656 -14.03772,6.52478 -17.93164,7.11083 -3.89391,0.58604 -6.90986,0.96086 -15.91499,-4.23825 -9.00514,-5.19913 -10.19243,-7.99932 -11.63186,-11.66458 -1.43943,-3.66525 -2.06052,-9.58225 -2.80676,-19.0879 -0.74624,-9.50564 -1.16018,-25.12875 -14.05635,-39.78187 -12.89618,-14.65311 -32.46989,-19.2757 -52.90398,-19.2757 z m 0.0181,130.78031 c 55.63168,0 100.16735,44.4506 100.16735,100.014299 0,55.563699 -44.53567,100.014302 -100.16735,100.014302 -55.63168,0 -100.16738,-44.450603 -100.16738,-100.014302 0,-55.563699 44.5357,-100.014299 100.16738,-100.014299 z" transform="matrix(1.3636076,0,0,1.3667651,1527.8554,411.9526)" sodipodi:nodetypes="ssssssssscssssscssssssssssssssssssssssssssssssssssssss"></path>
                      <g id="path10026" inkscape:transform-center-x="-0.59233046" inkscape:transform-center-y="-20.347403" transform="matrix(1.3807551,0,0,1.2700888,273.60014,263.99768)"></g>
                      <g id="g11314" transform="matrix(1.5092301,0,0,1.3955555,36.774048,-9.4503933)" style="stroke-width:50.6951"></g>
                      <path style="color:#000000;fill:#020202;stroke-width:1.05103;stroke-linejoin:round;paint-order:stroke fill markers" d="m 300.60937,218.51428 c -46.03938,0 -84.05805,38.06434 -84.05805,84.09712 0,46.03278 38.01867,84.09711 84.05805,84.09711 46.03938,0 84.05649,-38.06433 84.05649,-84.09711 0,-46.03278 -38.01711,-84.09712 -84.05649,-84.09712 z" id="path344" sodipodi:nodetypes="sssss"></path>
                    </g>
                  </g>
                </svg>
                <span class="ml-4">Settings</span>
              </span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <template x-if="isPagesMenuOpen">
              <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
                <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                  <a class="w-full" href="pages/login.html">Change Password</a>
                </li>

                <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                  <a class="w-full" href="pages/forgot-password.html">
                    Forgot password
                  </a>
                </li>

                <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                  <a class="w-full" href="pages/blank.html">Log Out</a>
                </li>
              </ul>
            </template>
          </li>
        </ul>

      </div>
    </aside>
    <div class="flex flex-col flex-1 w-full">
      <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
          <!-- Mobile hamburger -->
          <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
          </button>





          </ul>
        </div>
      </header>
      <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          <h2 style="text-align: center;" class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
          </h2>

          <!-- ********************** Card *************************-->
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg width="24" height="24" viewBox="0 0 366.34 366.34" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <defs>
                      <style>
                        .cls-1 {
                          fill: url(#linear-gradient);
                        }

                        .cls-2 {
                          fill: url(#linear-gradient-2);
                        }

                        .cls-3 {
                          fill: #e18477;
                        }

                        .cls-4 {
                          fill: url(#linear-gradient-3);
                        }

                        .cls-5 {
                          fill: #a76962;
                        }

                        .cls-6 {
                          fill: none;
                          stroke: #00214e;
                          stroke-miterlimit: 10;
                        }

                        .cls-7 {
                          fill: #ffffff;
                        }

                        .cls-8 {
                          fill: #00214e;
                        }
                      </style>

                      <linearGradient id="linear-gradient" x1="113.2" y1="123.3" x2="273.17" y2="123.3" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#16243f"></stop>
                        <stop offset="1" stop-color="#000000"></stop>
                      </linearGradient>
                      <linearGradient id="linear-gradient-2" x1="224.19" y1="73.8" x2="274.1" y2="153.34" xlink:href="#linear-gradient"></linearGradient>
                      <linearGradient id="linear-gradient-3" x1="69.93" y1="285.8" x2="296.41" y2="285.8" xlink:href="#linear-gradient"></linearGradient>
                    </defs>
                    <path class="cls-1" d="M250.35,160.79a35.93,35.93,0,0,1-5.09,4.41c-10.4,7.53-24.28,10-36.14,14.06-5,1.71-59.22,17.12-59.22,20.47,0-.73-5.31-6-12-12.4a79.91,79.91,0,0,1-19.56-85.74c10.91-28.67,45.69-48.43,74.82-53,13.87-2.17,30.33-3.38,43.14,3.27,6.55,3.41,12.05,8.38,17,13.89q2.34,2.61,4.54,5.33c.63.76,1.25,1.52,1.86,2.29C282.47,102,274.4,135.52,250.35,160.79Z"></path>
                    <path class="cls-2" d="M250.35,160.79a35.93,35.93,0,0,1-5.09,4.41,22.42,22.42,0,0,1-1.15-2.3c-2.64-6-4-12.51-5-19a275.93,275.93,0,0,1-3.17-28.53c-.91-15.34-7.46-22.95,5.57-34.91a43,43,0,0,1,16.35-9.38c.63.76,1.25,1.52,1.86,2.29C282.47,102,274.4,135.52,250.35,160.79Z"></path>
                    <path class="cls-3" d="M296.41,281.15a184.56,184.56,0,0,1-226.48-1l48.66-22.81a46.83,46.83,0,0,0,6.65-3.82c.64-.44,1.28-.9,1.89-1.38A46.35,46.35,0,0,0,139.91,237a44.69,44.69,0,0,0,4.64-14.48,67.91,67.91,0,0,0,.74-9.91c0-5.72-.31-11.44-.37-17.17q-.06-4.75-.1-9.51l2,1,5.2,2.69,2.41.41,27.88,4.74,31.12,5.3.94,32,.31,10.46.15,5.08V248l12.1,4.92Z"></path>
                    <path class="cls-4" d="M296.41,281.15a184.56,184.56,0,0,1-226.48-1l48.66-22.81a46.83,46.83,0,0,0,6.65-3.82c.64-.44,1.28-.9,1.89-1.38,23.55,16.76,55.69,27.33,83.49,14.82,6.62-3,12.7-7.84,16.3-14.06Z"></path>
                    <path class="cls-5" d="M214.81,247.64c-10.45.63-22.13-2.07-33-8.34-20.41-11.79-31.32-32.35-27.4-49.21l27.88,4.74,31.12,5.3.94,32Z"></path>
                    <circle class="cls-3" cx="134.98" cy="157.97" r="17"></circle>
                    <circle class="cls-5" cx="140.38" cy="157.97" r="15.22"></circle>
                    <path class="cls-3" d="M141,142.81c.22,2.6.07,5.2.27,7.81l1.65,21.48,1.51,19.72c.56,7.27,3.4,11.62,8.12,17.43a85.15,85.15,0,0,0,31.26,23.92c11.6,5.17,27.68,10.31,40.06,5.3,12.65-5.13,16.69-19.33,20.95-31.11s8.2-24.74,8-37.46C252.55,152.64,248,143,248,143l3.33-20c1.25-7.5,2.86-15.35,1-22.9-1.36-5.5-5-9.34-8.79-13.28-4.68-4.83-7-4.67-13.63-2.79a53.78,53.78,0,0,0-28.57,20.27C194.35,114,190.21,126,181,133.5c-6.36,5.19-14.24,7.32-22.28,8a44.19,44.19,0,0,1-8.76.18,63.79,63.79,0,0,0-8.85.36l-.17,0C141,142.28,141,142.54,141,142.81Z"></path>
                    <path class="cls-6" d="M215.13,141.77c-.08.35,13.36,38.47,13.36,38.47l-17.94.88"></path>
                    <path class="cls-6" d="M169.11,135.21a80.57,80.57,0,0,1,28.13-.79"></path>
                    <path class="cls-6" d="M231.7,134.26a55.64,55.64,0,0,1,17.45-1.21"></path>
                    <path class="cls-6" d="M177.94,195.1a39.62,39.62,0,0,1,15.24-14.42"></path>
                    <path class="cls-6" d="M195.85,150.41a11.64,11.64,0,0,1-5.18,8.33,12.08,12.08,0,0,1-1.85,1,23.21,23.21,0,0,1-6.41,1.37"></path>
                    <line class="cls-6" x1="197.21" y1="118.03" x2="228.81" y2="118.03"></line>
                    <line class="cls-6" x1="193.18" y1="124.56" x2="224.79" y2="124.56"></line>
                    <path class="cls-6" d="M228.67,148.13a34.62,34.62,0,0,0,3.74,7.23,10.08,10.08,0,0,0,6.24,4"></path>
                    <path class="cls-7" d="M190,191.61a1.86,1.86,0,0,1,2.68-.5c2.08,1.46,5.88,4.56,11.28,5.64,7.36,1.46,13.75-1.48,15.27.42.86,1.06-.19,2.37-2.2,4.05a19.74,19.74,0,0,1-14.86,3.68c-7.08-1.32-12.39-9.53-12.39-12.43A1.72,1.72,0,0,1,190,191.61Z"></path>
                    <path class="cls-8" d="M187.3,145.31c6.11-.07,6.29,9.26.19,9.43h-.28c-6.1.07-6.28-9.25-.18-9.42h.27Z"></path>
                    <path class="cls-8" d="M237.54,143.68c5.67-.07,5.83,8.59.17,8.74h-.25c-5.66.06-5.83-8.59-.17-8.75h.25Z"></path>
                  </g>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  My Details
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?php
                  echo 'Name:<b style="color:green;"> ' . $FName . ' ' . $LName . '</b><br>' . 'Id:<b style="color:green;"> ' . $SId . '</b>' .
                    '<br>Age:<b style="color:green;">' . $Age . '</b>';
                  ?>
                </p>
              </div>
            </div>

            <!-- ********************** Cards *************************-->

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione" preserveAspectRatio="xMidYMid meet" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path d="M54.9 39.7l7.3 7.6l-32.1 16.1s-4.2 2.1-6.2-1.2c-8-13 31-22.5 31-22.5" fill="#256382"> </path>
                    <path d="M29.2 53.9s-6.1 2.3-5 6.6c1.2 4.5 6.1 1.8 6.1 1.8l30.5-15s-1.7-4.8 1.4-8l-33 14.6" fill="#d9e3e8"> </path>
                    <path fill="#42ade2" d="M34.4 8.9L63.6 39L29.1 53.3L7 16.7z"> </path>
                    <g fill="#94989b">
                      <path d="M60.7 42.6l-20.4 8.8l20-9.7z"> </path>
                      <path d="M60.4 45.2l-21.7 9.5L60 44.3z"> </path>
                      <path d="M60.6 46.7L32.9 59.4l27.3-13.6z"> </path>
                    </g>
                    <path d="M23.8 62.1c-3.4-7.5 5.3-8.8 5.3-8.8L7 16.7s-5-.1-5 5.4c0 2.3 1 4 1 4l20.8 36" fill="#428bc1"> </path>
                    <path d="M8.7 32.2l-7.3 7.6l32.1 16.1s4.2 2.1 6.2-1.2c8-13-31-22.5-31-22.5" fill="#547725"> </path>
                    <path d="M34.3 46.4s6.1 2.3 5 6.6c-1.2 4.5-6 1.8-6 1.8l-30.5-15s1.7-4.8-1.4-8l32.9 14.6" fill="#d9e3e8"> </path>
                    <path fill="#83bf4f" d="M29.2 1.4L0 31.5l34.5 14.3L56.6 9.2z"> </path>
                    <g fill="#94989b">
                      <path d="M3.2 34.2l20 9.7l-20.4-8.8z"> </path>
                      <path d="M3.6 36.8l21.2 10.4l-21.7-9.5z"> </path>
                      <path d="M3.4 38.3l27.2 13.6L2.9 39.2z"> </path>
                    </g>
                    <path d="M39.8 54.6c3.4-7.5-5.3-8.8-5.3-8.8L56.6 9.2s5-.1 5 5.4c0 2.3-1 4-1 4l-20.8 36" fill="#699635"> </path>
                    <path d="M56.7 26l6.1 6.4l-27.1 13.5s-3.6 1.7-5.3-1C23.8 34 56.7 26 56.7 26z" fill="#962c2c"> </path>
                    <path d="M35 38s-5.2 1.9-4.2 5.6c1 3.8 5.1 1.5 5.1 1.5l25.7-12.7s-1.4-4 1.2-6.7L35 38z" fill="#d9e3e8"> </path>
                    <path fill="#ed4c5c" d="M39.4 0L64 25.4L34.9 37.5L16.2 6.6z"> </path>
                    <path fill="#ffffff" d="M40.1 5.8l4.8 5.3l-17.7 6.7L23 11z"> </path>
                    <g fill="#94989b">
                      <path d="M61.6 28.5l-17.2 7.3l16.8-8.2z"> </path>
                      <path d="M61.4 30.7L43 38.6l18-8.8z"> </path>
                      <path d="M61.6 31.9L38.2 42.6L61.1 31z"> </path>
                    </g>
                    <path d="M30.5 44.9c-2.8-6.3 4.5-7.4 4.5-7.4L16.2 6.6s-4.3-.1-4.3 4.5c0 1.9.8 3.4.8 3.4l17.8 30.4" fill="#c94747"> </path>
                  </g>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Books Not Returned Yet
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?php echo $BooksNotReturned; ?>
                </p>
              </div>
            </div>



            <!-- ********************** Card *************************-->

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">

                <svg width="24" height="24" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-33.51 -33.51 402.10 402.10" xml:space="preserve">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <g>
                      <g>
                        <path d="M311.175,115.775c-1.355-10.186-1.546-27.73,7.915-33.621c0.169-0.108,0.295-0.264,0.443-0.398 c7.735-2.474,13.088-5.946,8.886-10.618l-114.102-34.38L29.56,62.445c0,0-21.157,3.024-19.267,35.894 c1.026,17.89,6.637,26.676,11.544,31l-15.161,4.569c-4.208,4.672,1.144,8.145,8.88,10.615c0.147,0.138,0.271,0.293,0.443,0.401 c9.455,5.896,9.273,23.438,7.913,33.626c-33.967,9.645-21.774,12.788-21.774,12.788l7.451,1.803 c-5.241,4.736-10.446,13.717-9.471,30.75c1.891,32.864,19.269,35.132,19.269,35.132l120.904,39.298l182.49-44.202 c0,0,12.197-3.148-21.779-12.794c-1.366-10.172-1.556-27.712,7.921-33.623c0.174-0.105,0.301-0.264,0.442-0.396 c7.736-2.474,13.084-5.943,8.881-10.615l-7.932-2.395c5.29-3.19,13.236-11.527,14.481-33.183 c0.859-14.896-3.027-23.62-7.525-28.756l15.678-3.794C332.949,128.569,345.146,125.421,311.175,115.775z M158.533,115.354 l30.688-6.307l103.708-21.312l15.451-3.178c-4.937,9.036-4.73,21.402-3.913,29.35c0.179,1.798,0.385,3.44,0.585,4.688 L288.14,122.8l-130.897,32.563L158.533,115.354z M26.71,147.337l15.449,3.178l99.597,20.474l8.701,1.782l0,0l0,0l26.093,5.363 l1.287,40.01L43.303,184.673l-13.263-3.296c0.195-1.25,0.401-2.89,0.588-4.693C31.44,168.742,31.651,156.373,26.71,147.337z M20.708,96.757c-0.187-8.743,1.371-15.066,4.52-18.28c2.004-2.052,4.369-2.479,5.991-2.479c0.857,0,1.474,0.119,1.516,0.119 l79.607,25.953l39.717,12.949l-1.303,40.289L39.334,124.07l-5.88-1.647c-0.216-0.061-0.509-0.103-0.735-0.113 C32.26,122.277,21.244,121.263,20.708,96.757z M140.579,280.866L23.28,247.98c-0.217-0.063-0.507-0.105-0.733-0.116 c-0.467-0.031-11.488-1.044-12.021-25.544c-0.19-8.754,1.376-15.071,4.519-18.288c2.009-2.052,4.375-2.479,5.994-2.479 c0.859,0,1.474,0.115,1.519,0.115c0,0,0.005,0,0,0l119.316,38.908L140.579,280.866z M294.284,239.459 c0.185,1.804,0.391,3.443,0.591,4.693l-147.812,36.771l1.292-40.01l31.601-6.497l4.667,1.129l17.492-5.685l80.631-16.569 l15.457-3.18C293.261,219.146,293.466,231.517,294.284,239.459z M302.426,185.084c-0.269,0.006-0.538,0.042-0.791,0.122 l-11.148,3.121l-106.148,29.764l-1.298-40.289l34.826-11.359l84.327-27.501c0.011-0.005,4.436-0.988,7.684,2.315 c3.144,3.214,4.704,9.537,4.52,18.28C313.848,184.035,302.827,185.053,302.426,185.084z"></path>
                      </g>
                    </g>
                  </g>
                </svg>

              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Total Books issued
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?php
                  echo $TotalBooksIssued; ?>
                </p>
              </div>
            </div>

            <!-- ********************** Card *************************-->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg width="24" height="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 495 495" xml:space="preserve" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <g>
                      <path style="fill:#EE8700;" d="M333.73,135.64L367.4,10.42h-33.19l-5.07,3.41c-6.71,4.52-10.4,7.01-19.76,7.01 c-9.37,0-13.06-2.49-19.77-7.01C280.94,8,269.07,0,247.5,0v135.64H333.73z"></path>
                      <path style="fill:#CC7400;" d="M403.8,196.95c-18.08-26.12-42.08-47.06-70.07-61.31H247.5v65.541h15v12.579 c24.762,6.63,43.053,29.253,43.053,56.078h-30c0-9.954-5.216-18.708-13.053-23.688v57.858l2.501,0.79 c26.15,8.261,40.552,27.923,40.552,55.365c0,26.824-18.291,49.448-43.053,56.078v12.579h-15V495h190V305 C437.5,266.15,425.85,228.78,403.8,196.95z"></path>
                      <path style="fill:#CC7400;" d="M275.553,360.163c0-11.873-3.985-19.388-13.053-24.096v47.784 C270.338,378.87,275.553,370.117,275.553,360.163z"></path>
                      <path style="fill:#EE8700;" d="M232.5,428.819V416.24c-24.762-6.63-43.053-29.253-43.053-56.078h30 c0,9.954,5.216,18.708,13.053,23.688v-57.858l-2.5-0.79c-26.151-8.261-40.553-27.923-40.553-55.365 c0-26.824,18.291-49.448,43.053-56.078v-12.579h15V135.64h-86.23c-27.99,14.25-51.99,35.19-70.07,61.31 C69.15,228.78,57.5,266.15,57.5,305v190h190v-66.181H232.5z"></path>
                      <path style="fill:#EE8700;" d="M219.447,269.837c0,11.873,3.985,19.388,13.053,24.096v-47.784 C224.662,251.13,219.447,259.883,219.447,269.837z"></path>
                      <path style="fill:#FF9811;" d="M247.5,0c-21.58,0-33.45,8-42.12,13.83c-6.7,4.52-10.4,7.01-19.76,7.01 c-9.36,0-13.05-2.49-19.76-7.01l-5.07-3.41h-33.2l33.68,125.22h86.23V0z"></path>
                      <path style="fill:#FFCD00;" d="M232.5,213.76c-24.762,6.63-43.053,29.253-43.053,56.078c0,27.442,14.402,47.104,40.553,55.365 l2.5,0.79v57.858c-7.838-4.981-13.053-13.734-13.053-23.688h-30c0,26.824,18.291,49.448,43.053,56.078v12.579h30V416.24 c24.762-6.63,43.053-29.253,43.053-56.078c0-27.442-14.402-47.104-40.552-55.365l-2.501-0.79v-57.858 c7.838,4.981,13.053,13.734,13.053,23.688h30c0-26.824-18.291-49.448-43.053-56.078v-12.579h-30V213.76z M219.447,269.837 c0-9.954,5.216-18.708,13.053-23.688v47.784C223.432,289.225,219.447,281.71,219.447,269.837z M275.553,360.163 c0,9.954-5.216,18.708-13.053,23.688v-47.784C271.568,340.775,275.553,348.29,275.553,360.163z"></path>
                    </g>
                  </g>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Total Fine To Pay
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  Rs <?php echo $Fine; ?>
                </p>
              </div>
            </div>

            <!-- ********************** Card *************************-->


            <!-- ********************** Cards End *************************-->


          </div>

        </div>
    </div>
  </div>
  </div>
  </main>
  </div>
  </div>
</body>

</html>