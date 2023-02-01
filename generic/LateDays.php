<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

define("Period",15);
function calculateLateDays( $returnDate)
{
    $datetime1 = new DateTime(date("Y-m-d"));
    $datetime2 = new DateTime($returnDate);
    $interval = $datetime1->diff($datetime2);
    // echo "   late: " .$interval->days;
    if($interval->days-Period<0) 
      Return 0;
    return $interval->days-Period;
    //THIS FUNCTION WILL RETURN PRESENT DATE - RETURN DATE IN DAYS

}


function calculateFine($lateDays)
{
    // echo " Late days:". $lateDays;
    if ($lateDays <= 5)
        return 2 * $lateDays;
    return (10 + ($lateDays - 5) * 4);
        
}

?>