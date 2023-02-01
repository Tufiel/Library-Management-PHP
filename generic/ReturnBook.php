<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
</head>

<body>
    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include "Connection.php";

        include "VerifyDetails.php";
        include "LateDays.php";

        $isbn = $_POST['isbn'];

        function Issued()
        {
            global $con;
            global $isbn;
            $sql = "select * from books where isbn=$isbn ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $val = $row['Presently_Issued_To'];
            return (int)$val;
        }

        if (Verify("books", "isbn", $isbn)) {
            if (Issued()) {
                //GETTING ID OF STUDENT

                $row = mysqli_query($con, "SELECT id from IssuedBookDetails WHERE isbn=$isbn");

                $var = mysqli_fetch_array($row);
                $id = $var['id'];

                //UPDATING  PRESENTLY_ISSUED_TO DETAILS
                $sql = "UPDATE `books` SET `Presently_Issued_TO`=0 where isbn=$isbn ;";
                mysqli_query($con, $sql);

                //UPDATE BOOKS TAKEN BY THIS ID
                $sql = "select BooksIssued from registration where id=$id";
                $row = mysqli_query($con, $sql);
                $arr = mysqli_fetch_array($row);
                $val = $arr['BooksIssued'] - 1;
                if($var <0)
                  $var = 0;
                $sql = "UPDATE `registration` SET `BooksIssued`='$val' ;";
                $row = mysqli_query($con, $sql);



                //UPDATING BOOKS NOT RETURNED
                $sql = "select * from booksnotreturned ";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $val = $row['Books_Not_Returned'];
                $Int = (int)$val;
                $Int--;
                $sql = "UPDATE `booksnotreturned` SET `Books_Not_Returned`=$Int ;";
                mysqli_query($con, $sql);

                //LATE DAYS 
                $sql = "select ReturnDate from IssuedBookDetails ";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $returnDate = $row['ReturnDate'];
                $lateDays = calculateLateDays($returnDate);
                $Fine = calculateFine($lateDays);
                
                echo "Number of late days: " . $lateDays . " and Fine is " . $Fine;
                $sql = "UPDATE `issuedbookdetails` SET `DueDays`='$lateDays',`Fine`='$Fine' where id=$id and isbn=$isbn and ReturnDate = '$returnDate' ";
                mysqli_query($con, $sql);
            } else {
                $sql = "SELECT BookTitle from books WHERE isbn=$isbn";
                $obj = mysqli_query($con, $sql);
                $arr = mysqli_fetch_array($obj);
                echo '<h1 style="color:blue;">The book with name <b style="color:red"> ' . $arr['BookTitle'] . '</b> and isbn <b style="color:red">' . $isbn . '</b> is not issued to anyone yet! </h1>';
            }
        } else {
            echo '<h1 style="color:red;">No book found  with isbn ' . $isbn . ' </h1>';
        }
    }

    ?>

    <form method="post" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input required oninvalid="this.setCustomValidity('Please Enter ISBN')" oninput="this.setCustomValidity('')" type="number" name="isbn" placeholder="ISBN">
        <input type="submit" value="Return">
    </form>

</body>

</html>