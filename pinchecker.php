
<?php
session_start();
$pin = $_POST['pin'];
$self = $_SESSION["PHONE_NUMBER"] ;
$conn = new mysqli('localhost','root','','userinfo');


$query = "SELECT PIN FROM pins WHERE PHONE_NUMBER = '$self' ";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM pins WHERE PHONE_NUMBER = '$self'");
if(!$resultAll){
    die(mysqli_error($conn));
}

if (mysqli_num_rows($resultAll) > 0) {
    while($rowData = mysqli_fetch_array($resultAll)){
          $rs =  $rowData["PIN"];
    }
}



if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
} else {
    if($pin == $rs){
        echo 'Correct pin you may continue to application';
    }
    else{
        echo 'Incorrect pin !!';
        include 'pinchecker.html';
    }
    
    
    $conn->close();
}

?>

               