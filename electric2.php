<?php
session_start();
$elec = $_POST['serviceno'];
$_SESSION["servicenumber"] = $elec;
$elecp = $_SESSION["electprovider"];

$conn = new mysqli('localhost','root','','userinfo');


$query = "SELECT DUE FROM electricity WHERE ELECTRICBOARD = '$elecp' AND SERVICE_NUMBER = '$elec' ";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM electricity WHERE ELECTRICBOARD = '$elecp' AND SERVICE_NUMBER = '$elec'");
if(!$resultAll)
{
    die(mysqli_error($conn));
}
if (mysqli_num_rows($resultAll) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll))
    {
        $rs =  $rowData["DUE"];
    }
}
$_SESSION["billbal"] = $rs;
include 'electricitybill3.html';
?>
