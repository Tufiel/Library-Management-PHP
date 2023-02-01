<?php
  include "Connection.php";
  include "LateDays.php";

  $sql = "SELECT * FROM issuedbookdetails ";
  $obj = mysqli_query($con,$sql);

  if( mysqli_num_rows($obj)>0 )
  {
   while($arr = mysqli_fetch_array($obj))
   {
    $DueDays = calculateLateDays($arr['ReturnDate']);
    $Fine = calculateFine($DueDays);
    $id = $arr['id'];
    $isbn = $arr['isbn'];
    $Name = $arr['Name'];
    $IDate = $arr['IssueDate'];
    //  echo "Due Days :". $DueDays ."<br>Fine:". $Fine."<br><br>";
    $sql = "UPDATE issuedbookdetails SET DueDays='$DueDays',Fine=$Fine where id=$id  AND isbn =$isbn  AND IssueDate LIKE '%$IDate%'  AND Name LIKE '%$Name%'  ;";
    mysqli_query($con,$sql);
   }

  }


?>