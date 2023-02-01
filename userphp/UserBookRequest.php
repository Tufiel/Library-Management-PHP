<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Request</title>
</head>

<body>
    <?php

    include 'SendMail.php';
    include 'SearchBooks.php';

    if (isset($_POST['SearchBook']) && mysqli_num_rows($result) > 0) {
        echo '<script>document.getElementById("SearchForm").style.display="none"; </script>'
    ?>
        <center>
            <form style="position:absolute;top:100px;left:50%;transform:translateX(-50%);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <input style="text-align: center;" required oninvalid="this.setCustomValidity('Please Enter Book ISBN')" oninput="this.setCustomValidity('')" placeholder="ISBN of the book" type="text" name="RequestBookIsbn">
                <input type="submit" name="RequestBookBtn" value="Request">
            </form>
        </center>
    <?php
    }

     if(isset($_POST['RequestBookBtn']))
     {

        include "VerifyDetails.php";
        

        $isbn = $_POST['RequestBookIsbn'];
        $sid = $_SESSION['MyStdId'];
        //CHECK IF BOOK ISBN IS CORRECT
        if (Verify("books", "isbn", $isbn)) 
        {

            $Available = IsBookAvailable($isbn);

            //CHECK IF BOOK IS AVAILABLE I.E, NOT ISSUED TO ANYONE PRESENTLY
            if (!$Available) //$row =0 IF AVAILABLE
            {

                $sql = "select BooksIssued from registration where id=$sid AND BooksIssued<2";
                $row = mysqli_query($con, $sql);
                if (mysqli_num_rows($row))
                 {
                    $val = mysqli_fetch_array($row);
                    if ($val['BooksIssued'] < 3) {

                        //GET BOOK TITLE
                        $BOOKNAME = $STUDENTNAME = $EMAILTO = $arr = "";
                        $sql = "SELECT * FROM books where isbn=$isbn";
                        $obj = mysqli_query($con, $sql);
                        if (mysqli_num_rows($obj) > 0) {
                            $arr = mysqli_fetch_array($obj);
                            $BOOKNAME = $arr['BookTitle'];
                        }

                        //GET STUDENT NAME AND EMAIL
                        $sql = "SELECT * FROM registration where Id=$sid";
                        $obj = mysqli_query($con, $sql);
                        if (mysqli_num_rows($obj) > 0) {
                            $arr = mysqli_fetch_array($obj);
                            $STUDENTNAME = $arr['FName'];
                            $EMAILTO = $arr['Email'];
                        }

                        echo '<h1 style="color:green;"> Congratulations  "' . $BOOKNAME . '" Book has been successfully issued to you for 15 days from '.date("Y-m-d").' </h1>';

                        //UPDATE BOOKS TAKEN BY THIS ID
                        $sql = "select BooksIssued from registration where id=$sid";
                        $row = mysqli_query($con, $sql);
                        if (mysqli_num_rows($row)>0) {
                            $val = mysqli_fetch_array($row);
                            $books =  $val['BooksIssued'];
                            $books++;
                            $sql = "UPDATE `registration` SET `BooksIssued`='$books' ;";
                            $row = mysqli_query($con, $sql);
                        }

                        //UPDATING  PRESENTLY_ISSUED_TO DETAILS
                        $sql = "UPDATE `books` SET `Presently_Issued_TO`=$sid where isbn=$isbn ;";
                        mysqli_query($con, $sql);

                        //UPDATING NO. OF PRESENTLY ISSUED BOOKS

                        $sql = "select * from issuedbooks ";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $val = $row['Issued_Books'];
                        $Int = (int)$val;
                        $Int++;
                        $sql = "UPDATE `issuedbooks` SET `Issued_Books`=$Int ;";
                        mysqli_query($con, $sql);

                        //UPDATING TOTAL NO. OF ISSUED BOOKS

                        $sql = "select * from registration ";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $val = $row['TotalBooksIssued'];
                        $Int = (int)$val;
                        $Int++;
                        $sql = "UPDATE `registration` SET `TotalBooksIssued`=$Int ;";
                        mysqli_query($con, $sql);

                        //UPDATING BOOKS NOT RETURNED

                        $sql = "select * from booksnotreturned ";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $val = $row['Books_Not_Returned'];
                        $Int = (int)$val;
                        $Int++;
                        $sql = "UPDATE `booksnotreturned` SET `Books_Not_Returned`=$Int ;";
                        mysqli_query($con, $sql);

                        //UPDATING ISUUEBOOKDETAILS
                        // set the timezone first
                        if (function_exists('date_default_timezone_set')) {
                            date_default_timezone_set("Asia/Kolkata");
                        }
                        $sql = "SELECT * from books where isbn=$isbn";
                        $obj = mysqli_query($con, $sql);
                        $arr = mysqli_fetch_array($obj);
                        $name = $arr['BookTitle'];
                        $pdate =  date(" Y-m-d");
                        $rdate = date('Y-m-d', strtotime('+15 days'));
                        $sql = " INSERT INTO `issuedbookdetails`(`id`, `isbn`, `Name`, `IssueDate`, `ReturnDate`, `DueDays`, `Fine`) VALUES ('$sid','$isbn','$name','$pdate','$rdate','0','0')";
                        mysqli_query($con, $sql);

                        //UPDATING BooksIssued IN REGISTRATION TABLE

                        $sql = "select BooksIssued from registration where Id=$sid ";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $val = $row['BooksIssued'];
                        $Int = (int)$val;
                        $Int++;
                        $sql = "UPDATE `registration` SET `BooksIssued`=$Int where Id=$sid ;";
                        mysqli_query($con, $sql);

                        //SEND MAIL    
                        $subject =  $BOOKNAME . " issued to you";
                        $message = "Hello dear it's me tufail i want to inform you that <b style='color:red'> " . $BOOKNAME . "</b> book has been issued to you for 15 days from <b style='color:red'>" . date("Y-m-d") . "</b> to <b style='color:red'>" . $rdate . "</b>
                            <br>isbn:<b style='color:red'>" . $arr['Isbn'] . "</b><br>Author:<b style='color:red'>" . $arr['Author'] .
                        "</b><br>Edition: <b style='color:red'>" . $arr['Edition'] . "</b><br>Publication:<b style='color:red'>" .
                        $arr['Publication'] . "<br><br><br><h3 style='color:blue;'>Thanks for using our online library management system</h3>";
                        $headers = "From: tufielgulzar20@gmail.com" . "\r\n";

                        sendMail($EMAILTO, $subject, $message);
                    }
                }
                 else 
                    echo '<h1 style="color:blue;">Sorry Three books have already been issued to  you </h1>';
                
            }
             else 
            {


                $sql = " SELECT FName,LName,id FROM registration where `id`=$Available ";
                $var = mysqli_query($con, $sql);
                $stu = mysqli_fetch_array($var);
                $sql = "SELECT IssueDate,ReturnDate FROM IssuedBookDetails where id=$Available";
                $var2 = mysqli_query($con, $sql);
                $date = mysqli_fetch_array($var2);

                echo '<h1 style="color:blue;">Already issued till ' . $date['ReturnDate'] . "</h1>";
            }

        }
        else 
         echo '<h1 style="color:red;">No book found  with isbn ' . $isbn . ' </h1>';

    
    }

    ?>

</body>

</html>