<?php
session_start();
$PHONE = $_POST['PHONE_NUMBER'];
$PASS = $_POST['PASSWORD'];
$_SESSION["myno"] = $PHONE;
$_SESSION["acpass"] = $PASS;
$conn = new mysqli('localhost','root','','userinfo');
$query1 = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$PHONE' ";
$rs1 = $conn->query($query1);
$resultAll1 = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$PHONE'");
if(!$resultAll1){
    die(mysqli_error($conn));
}
    
if (mysqli_num_rows($resultAll1) > 0) {
while($rowData1 = mysqli_fetch_array($resultAll1)){
    $rs1 =  $rowData1["BALANCE"];
    $_SESSION["currbalanceamt"] = $rs1;
    }
}

$query143 = "SELECT ACCOUNT_HOLDER_NAME FROM bankbalance WHERE PHONE_NUMBER = '$PHONE' ";
$rs143 = $conn->query($query143);
$resultAll1 = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$PHONE'");
if(!$resultAll1){
    die(mysqli_error($conn));
}
    
if (mysqli_num_rows($resultAll1) > 0) {
while($rowData1 = mysqli_fetch_array($resultAll1)){
    $rs143 =  $rowData1["ACCOUNT_HOLDER_NAME"];
    $_SESSION["ACCOUNT_HOLDER_NAME"] = $rs143;
    }
}
$query = "SELECT PASSWORD FROM useri WHERE PHONE_NUMBER = '$PHONE' ";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM useri WHERE PHONE_NUMBER = '$PHONE'");
if(!$resultAll){
    die(mysqli_error($conn));
}

if (mysqli_num_rows($resultAll) > 0) {
    while($rowData = mysqli_fetch_array($resultAll)){
          $rs =  $rowData["PASSWORD"];
    }
}
if($conn->connect_error){
echo "$conn->connect_error";
die("Connection Failed : ". $conn->connect_error);
} else {
if($PASS == $rs){
      $_SESSION["PHONE_NUMBER"] = $PHONE;
      include 'main2.html';
    }
    else{
        echo 'Incorrect password !!';
        include 'logintry.html';
    }


$conn->close();
}

?>

               