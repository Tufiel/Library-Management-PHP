<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    include "Connection.php";
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sql = "INSERT INTO `contactus`(`Email`, `Message`) VALUES ('$email','$message')";
    mysqli_query($con,$sql);
}


?>


<footer class="footer-distributed">

    <div class="footer-left">

        <h3>Online Library Management System</h3>

        <p class="footer-links">
            <a href="#">Home</a>
            ·
            <a href="#">Blog</a>
            ·
            <a href="#">Pricing</a>
            ·
            <a href="#">About</a>
            ·
            <a href="#">Faq</a>
            ·
            <a href="#">Contact</a>
        </p>

        <p class="footer-company-name">Library Management System © 2023</p>

        <div class="footer-icons">

            <a href="#"><i class="fa fa-facebook">FB</i></a>
            <a href="#"><i class="fa fa-twitter">Twitter</i></a>
            <a href="#"><i class="fa fa-linkedin">LinkedIn</i></a>
            <a href="#"><i class="fa fa-github">GitHub</i></a>

        </div>

    </div>

    <div class="footer-right">

        <p>Contact Us</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="text" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <button type="reset">Reset</button>
            <button type="submit">Send</button>

        </form>

    </div>

</footer>