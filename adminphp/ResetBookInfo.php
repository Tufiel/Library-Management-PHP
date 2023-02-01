<?php
 include "Connection.php";

 //RESET BOOKS ISSUED
 $sql = "UPDATE `issuedbooks` SET `Issued_Books`='0' WHERE 1";
mysqli_query($con,$sql);

//RESET BOOKS NOT RETURNED
$sql = "UPDATE `booksnotreturned` SET `Books_Not_Returned`='0' WHERE 1";
mysqli_query($con, $sql);

//ISSUED BOOKS TO STUDENTS
$sql = "UPDATE `registration` SET `BooksIssued`='0' WHERE 1";
mysqli_query($con, $sql);

//ISSUED BOOK DETAILS
$sql = "DELETE FROM `issuedbookdetails` WHERE 1"; mysqli_query($con, $sql);

//PRESENTLY ISSUED TO
$sql = "UPDATE `books` SET `Presently_Issued_To`='0' WHERE 1";
mysqli_query($con, $sql);

//TOTAL BOOKS ISSUED
$sql = "UPDATE `registration` SET `TotalBooksIssued`='0' WHERE 1";
mysqli_query($con, $sql);

?>