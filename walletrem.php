

<?php
session_start();
$amt = $_POST['amount'];

$PHONE=$_SESSION["PHONE_NUMBER"];
$pas = $_SESSION["acpass"];
$conn = new mysqli('localhost','root','','userinfo');
$pin=$_POST["pin"];




$query2 = "SELECT PIN FROM pins WHERE PHONE_NUMBER = '$PHONE' ";
$pa = $conn->query($query2);
$resultAll2 = mysqli_query($conn, "SELECT * FROM pins WHERE PHONE_NUMBER = '$PHONE'");
if(!$resultAll2)
{
    die(mysqli_error($conn));
}
if (mysqli_num_rows($resultAll2) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll2))
    {
        $pa =  $rowData["PIN"];
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


$query = "SELECT BALANCE FROM wallet WHERE PHONE_NUMBER = '$PHONE' ";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM wallet WHERE PHONE_NUMBER = '$PHONE'");
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
if($pa == $pin){
    $bankbal = $rs1;
    $wallbal = $rs;
    if( $amt > $rs)
    {
        echo 'Insufficient amount';
        include 'wallet2.php';
    }else{
        $rs3 = $bankbal + $amt;
        $rs4 = $wallbal - $amt;
        $_SESSION["newbalance"] = $rs4;
        $sql = "UPDATE wallet SET BALANCE='$rs4' WHERE PHONE_NUMBER = '$PHONE'";
        $sql1 = "UPDATE bankbalance SET BALANCE='$rs3' WHERE PHONE_NUMBER = '$PHONE'";
        if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
        {
            echo 'Amount added to bank';
            session_abort();
            include 'wallet1.php';
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }


}else{
    echo 'Incorrect password !!';
    session_abort();
    include 'wallet1.php';
}
}





        
            

            

            


                
                



         

      
    
    





?>

               