<?php
session_start();
$PHONE = $_POST['mobilenumber'];
$PASS = $_POST['password'];
$PHONE1 = $_SESSION["PHONE_NUMBER"] ;

$conn = new mysqli('localhost','root','','userinfo');

$query = "SELECT PASSWORD FROM useri WHERE PHONE_NUMBER = '$PHONE1' ";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM useri WHERE PHONE_NUMBER = '$PHONE1'");
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
if($PASS == $rs && $PHONE == $PHONE1){
      $_SESSION["PHONE_NUMBER"] = $PHONE;
      include 'checkbalance1.html';
    }
    else{
        echo 'Incorrect password !!';
        include 'logintry.html';
    }


$conn->close();
}

?>

               