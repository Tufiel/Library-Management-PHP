<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
    <link rel="stylesheet" href="navbar.css">
</head>


<body>

    <?php

    // INCLUDING FILES
    include "Connection.php";
    include "navbar.php";
    include "VerifyDetails.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    include "phpmailer/src/Exception.php";
     include "phpmailer/src/PHPMailer.php";
     include "phpmailer/src/SMTP.php"; 

    // WHEN USER CLICKS SUBMIT
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $isbn = $_POST['isbn'];
        $sid = $_POST['sid'];

        function IsBookAvailable($isbn)
        {
            global $con;
            $query = "SELECT Presently_Issued_To FROM books WHERE isbn = $isbn";
            $result = mysqli_query($con, $query);
            $row =  mysqli_fetch_array($result);

            return $row['Presently_Issued_To'];
        }

        //CHECK IF STUDENT ID IS CORRECT
        if (Verify("registration", "id", $sid)) {

            //CHECK IF BOOK ISBN IS CORRECT
            if (Verify("books", "isbn", $isbn)) {

                $Available = IsBookAvailable($isbn);

                //CHECK IF BOOK IS AVAILABLE I.E, NOT ISSUED TO ANYONE PRESENTLY
                if (!$Available) //$row =0 IF AVAILABLE
                {
          
                    $sql = "select BooksIssued from registration where id=$sid AND BooksIssued<3";
                    $row = mysqli_query($con, $sql);
                    if (mysqli_num_rows($row)) {
                        $val = mysqli_fetch_array($row);
                        if ($val['BooksIssued'] < 3) {

                            $BOOKNAME = $STUDENTNAME = $EMAILTO = $arr ="";
                            $sql = "SELECT * FROM books where isbn=$isbn";
                            $obj = mysqli_query($con, $sql);
                            if (mysqli_num_rows($obj) > 0) 
                            {
                               $arr = mysqli_fetch_array($obj);
                               $BOOKNAME = $arr['BookTitle'];
                            }
                            $sql = "SELECT * FROM registration where Id=$sid";
                            $obj = mysqli_query($con, $sql);
                            if (mysqli_num_rows($obj) > 0) {
                                 $arr = mysqli_fetch_array($obj);
                                $STUDENTNAME = $arr['FName'];
                                $EMAILTO = $arr['Email'];
                            }

                            echo '<h1 style="color:green;">'.$BOOKNAME.' book successfully issued to '.$STUDENTNAME.' with id ' . $sid . ' </h1>';

                            //UPDATE BOOKS TAKEN BY THIS ID
                            $sql = "select BooksIssued from registration where id=$Available";
                            $row = mysqli_query($con, $sql);
                            $val = mysqli_fetch_array($row);
                            if ($val) {
                                $books =  $val['BooksIssued'];
                                $books++;
                                $sql = "UPDATE `registration` SET `BooksIssued`='$books' ;";
                                $row = mysqli_query($con, $sql);
                            }
                            //UPDATING  PRESENTLY_ISSUED_TO DETAILS
                            $sql = "UPDATE `books` SET `Presently_Issued_TO`=$sid where isbn=$isbn ;";
                            mysqli_query($con, $sql);

                            //UPDATING TOTAL ISSUED BOOKS

                            $sql = "select * from issuedbooks ";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($result);
                            $val = $row['Issued_Books'];
                            $Int = (int)$val;
                            $Int++;
                            $sql = "UPDATE `issuedbooks` SET `Issued_Books`=$Int ;";
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

                            $sql = "select BooksIssued from registration ";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($result);
                            $val = $row['BooksIssued'];
                            $Int = (int)$val;
                            $Int++;
                            $sql = "UPDATE `registration` SET `BooksIssued`=$Int where Id=$sid ;";
                            mysqli_query($con, $sql);

                            //SEND MAIL    
                            $subject =  $BOOKNAME." issued to you" ;
                            $message ="Hello dear it's me tufail i want to inform you that <h3 style='color:red'> ". $BOOKNAME. "</h3> book has been issued to you for 15 days from <h3 style='color:red'>" . date("Y-m-d"). "</h3> to <h3 style='color:red'>".$rdate. "</h3>
                            <br>isbn:<h3 style='color:red'>".$arr['Isbn']. "</h3><br>Author:<h3 style='color:red'>".$arr['Author'].
                            "</h3><br>Edition<h3 style='color:red'>".$arr['Edition']."</h3><br>Publication:<h1 style='color:red'>".
                            $arr['Publication']."<br><br><br><h3 style='color:blue;'>Thanks for using our online library management system</h3>"
                            ;
                            $headers = "From: tufielgulzar20@gmail.com" . "\r\n";

                            $mail = new PHPMailer(true);
                            
                            $mail->isSMTP();
                            $mail->Host= 'smtp.gmail.com';
                            $mail->SMTPAuth=true;
                            $mail->Username = 'tufielgulzar20@gmail.com';
                            $mail->Password = 'xtqsisrkqtoqcpmi';
                            $mail->SMTPSecure ='ssl';
                            $mail->Port = 465;
                            $mail->setFrom('tufielgulzar20@gmail.com');
                            $mail->addAddress($EMAILTO);
                            $mail->isHTML(true);
                            $mail->Subject = $subject;
                            $mail->Body = $message;
                            $mail->send();

                        }
                    } else {
                        echo '<h1 style="color:blue;">Sorry Three books have already been issued to  student Id ' . $sid . '</h1>';
                    }
                } else {


                    $sql = " SELECT FName,LName,id FROM registration where `id`=$Available ";
                    $var = mysqli_query($con, $sql);
                    $stu = mysqli_fetch_array($var);
                    $sql = "SELECT IssueDate,ReturnDate FROM IssuedBookDetails where id=$Available";
                    $var2 = mysqli_query($con, $sql);
                    $date = mysqli_fetch_array($var2);

                    echo '<h1 style="color:blue;">Already issued to <b style="color:red;"> ' . $stu['FName'] . " " . $stu['LName'] . '</b> with student id  <b style="color:red;">' . $Available . '</b> on ' . $date['IssueDate'] . " till " . $date['ReturnDate'] . "</h1>";
                }
            } else {
                echo '<h1 style="color:red;">No book found  with isbn ' . $isbn . ' </h1>';
            }
        } else {

            echo '<h1 style="color:red;">No student found  with id ' . $sid . ' </h1>';
        }
    }
    ?>

    <form method="post" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <input required oninvalid="this.setCustomValidity('Please Enter ISBN')" oninput="this.setCustomValidity('')" type="number" name="isbn" placeholder="ISBN">

        <input required oninvalid="this.setCustomValidity('Please Enter Student Id')" oninput="this.setCustomValidity('')" type="number" name="sid" placeholder="Student Id">

        <input type="submit" value="Issue">
    </form>
</body>

</html>