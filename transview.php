<?php
session_start();
$myno = $_SESSION["myno"];
$conn = new mysqli('localhost','root','','userinfo');
$q = "SELECT * FROM `{$myno}`  WHERE TO_no = '$myno' OR FROM_no = '$myno'";
$rs2 = $conn->query($q);
$resultAll2 = mysqli_query($conn, "SELECT * FROM `{$myno}` WHERE TO_no = '$myno' OR FROM_no = '$myno'");
if(!$resultAll2)
{
    die(mysqli_error($conn));
}
echo "                    FROM  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    ";
echo "                     TO                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    ";
echo "                      AMOUNT      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           ";
echo "                      TIME     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;                 ";
echo "                      DATE     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                  ";
echo '<br />';
if (mysqli_num_rows($resultAll2) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll2))
    {
        echo $rowData['FROM_no'] . "&nbsp;&nbsp;&nbsp; " . $rowData['TO_no']."&nbsp;&nbsp;&nbsp; ". $rowData['AMOUNT']. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;".$rowData['TIME']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;".$rowData['DATE'];
        echo '<br />';
    }
    
}

?>