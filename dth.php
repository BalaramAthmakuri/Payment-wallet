<?php
session_start();
$cid = $_POST['cid'];
$amt = $_POST['Amount'];
$net = $_POST["DTHNET"];
$conn = new mysqli('localhost','root','','userinfo');
$query1 = "SELECT COMPANY FROM dthrecharge WHERE COSTUMER_ID = '$cid' ";
$rs1 = $conn->query($query1);
$resultAll1 = mysqli_query($conn, "SELECT * FROM dthrecharge WHERE COSTUMER_ID = '$cid'");
if(!$resultAll1){
    die(mysqli_error($conn));
}
    
if (mysqli_num_rows($resultAll1) > 0) {
while($rowData1 = mysqli_fetch_array($resultAll1)){
    $rs1 =  $rowData1["COMPANY"];
    }
}

if($conn->connect_error){
echo "$conn->connect_error";
die("Connection Failed : ". $conn->connect_error);
} else {
if($rs1 == $net){
      $_SESSION["cid"] = $cid;
      $_SESSION["dthamt"] = $amt;
      include 'dthrecharge.html';
    }
    else{
        echo 'Incorrect password !!';
        include 'dth.html';
    }


$conn->close();
}

?>

               