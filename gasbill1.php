<?php
session_start();
$PHONE = $_POST['gaspho'];
$PASS = $_POST['gaspin'];
$myno=$_SESSION["myno"];
$gas = $_SESSION['gas'];
$gcost = $_SESSION["gascost"] ;
$pas = $_SESSION["acpass"];
$conn = new mysqli('localhost','root','','userinfo');


$query2 = "SELECT PIN FROM pins WHERE PHONE_NUMBER = '$myno' ";
$rs2 = $conn->query($query2);
$resultAll2 = mysqli_query($conn, "SELECT * FROM pins WHERE PHONE_NUMBER = '$myno'");
if(!$resultAll2)
{
    die(mysqli_error($conn));
}
if (mysqli_num_rows($resultAll2) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll2))
    {
        $rs2 =  $rowData["PIN"];
    }
    
}




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
$query = "SELECT BALANCE FROM gas_accounts WHERE GAS_NAME = '$gas' ";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM gas_accounts WHERE GAS_NAME = '$gas'");
if(!$resultAll){
    die(mysqli_error($conn));
}

if (mysqli_num_rows($resultAll) > 0) {
    while($rowData = mysqli_fetch_array($resultAll)){
          $rs =  $rowData["BALANCE"];
    }
}
if($conn->connect_error){
echo "$conn->connect_error";
die("Connection Failed : ". $conn->connect_error);
} else {
if($rs2 == $PASS){

        if( $gcost > $rs)
        {
            echo 'Insufficient amount';
            include 'gasbill3.html';

        }else{
            $rs3 = $rs1 - $gcost;
            $rs4 = $rs + $gcost;
            $_SESSION["newbalance"] = $rs4;
            $sql = "UPDATE gas_accounts SET BALANCE='$rs4' WHERE GAS_NAME = '$gas'";
            $sql1 = "UPDATE bankbalance SET BALANCE='$rs3' WHERE PHONE_NUMBER = '$PHONE'";
            if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
            {
                include 'testtogas.html';
            } else {
                echo "Error updating record: " . $conn->error;
            }

            
        }



      
    }
    else{
        echo 'Incorrect password !!';
        include 'gasbill3.html';
    }


$conn->close();
}

?>

               