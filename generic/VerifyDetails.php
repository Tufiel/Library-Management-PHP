<?php
include "Connection.php";
//FUNCTION TO VERIFY DETAILS
function Verify($table, $col, $val)
{
    global $con;
    $query = "SELECT $col FROM $table WHERE $col = $val";
    if ($result = mysqli_query($con, $query)) {
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function IsBookAvailable($isbn)
{
    global $con;
    $query = "SELECT Presently_Issued_To FROM books WHERE isbn = $isbn";
    $result = mysqli_query($con, $query);
    $row =  mysqli_fetch_array($result);

    return $row['Presently_Issued_To'];
}
?>