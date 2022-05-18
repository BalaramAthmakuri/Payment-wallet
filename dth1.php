<?php
session_start();

$myno = $_SESSION["myno"];


$conn = new mysqli('localhost','root','','userinfo');
$myno=$_SESSION["myno"];



$query1 = "SELECT ACCOUNT_NUMBER FROM bankbalance WHERE PHONE_NUMBER = '$myno' ";
$rs123 = $conn->query($query1);
$resultAll1 = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$myno'");
if(!$resultAll1){
    die(mysqli_error($conn));
}
    
if (mysqli_num_rows($resultAll1) > 0) {
while($rowData1 = mysqli_fetch_array($resultAll1)){
    $rs123 =  $rowData1["ACCOUNT_NUMBER"];
    }
}





$cid = $_SESSION["cid"];
$amts=$_SESSION["dthamt"];
$PIN = $_POST["pin"];
$query = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$myno'";
$rs = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$myno'");
if(!$resultAll)
{
    die(mysqli_error($conn));
}
if (mysqli_num_rows($resultAll) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll))
    {
        $rs1 =  $rowData["BALANCE"];
    }
    
}



$query1 = "SELECT BALANCE FROM dthrecharge WHERE COSTUMER_ID = '$cid' ";

$rs3 = $conn->query($query1);
$rs4 = $conn->query($query1);
$rs5 = $conn->query($query1);
$resultAll1 = mysqli_query($conn, "SELECT * FROM dthrecharge WHERE COSTUMER_ID = '$cid'");
if(!$resultAll1)
{
    die(mysqli_error($conn));
}
if (mysqli_num_rows($resultAll1) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll1))
    {
        $rs5 =  $rowData["BALANCE"];
    }
    
}


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



if($conn->connect_error)
{
echo "$conn->connect_error";
die("Connection Failed : ". $conn->connect_error);
} else
{
   
    if($PIN == $rs2)
    {

        if( $amts > $rs)
        {
            echo 'Insufficient amount';
            include 'tobank2.html';

        }else{
            $rs3 = $rs5 + $amts;
            $rs4 = $rs1 - $amts;
            $_SESSION["newbalance"] = $rs4;
            $sql = "UPDATE dthrecharge SET BALANCE='$rs3' WHERE COSTUMER_ID = '$cid'";
            $sql1 = "UPDATE bankbalance SET BALANCE='$rs4' WHERE PHONE_NUMBER = '$myno'";
            if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
            {
                include 'testtodth.html';
            } else {
                echo "Error updating record: " . $conn->error;
            }




            $trans = "SELECT PHONE_NUMBER FROM bankbalance WHERE ACCOUNT_NUMBER = '$rs123' ";
            $tra = $conn->query($trans);
            $resultAll45 = mysqli_query($conn, "SELECT * FROM bankbalance WHERE ACCOUNT_NUMBER = '$rs123'");
            if(!$resultAll45)
            {
                die(mysqli_error($conn));
            }
            if (mysqli_num_rows($resultAll45) > 0) 
            {
                while($rowData = mysqli_fetch_array($resultAll45))
                {
                    $rs2 =  $rowData["PHONE_NUMBER"];
                }
                
            }
            date_default_timezone_set("Asia/Calcutta");
            $date = date("H:i:s");
            $DAT = date("Y-m-d");
            $stmt = $conn->prepare("insert into `{$rs2}`(FROM_no, TO_no, AMOUNT, TIME, DATE) values(?, ?, ?, ?,?)");
            $stmt->bind_param("ssiss", $myno, $rs2, $amts, $date,$DAT);
            $execval = $stmt->execute();
            
            $stmt->close();
            
            $stmt1 = $conn->prepare("insert into `{$myno}`(FROM_no, TO_no, AMOUNT, TIME, DATE) values(?, ?, ?, ?,?)");
            $stmt1->bind_param("ssiss", $myno, $rs2, $amts, $date, $DAT);
            $execval1 = $stmt1->execute();
            
            $stmt1->close();
            


            
        }

    }else{
        echo 'Incorrect password ,Please try again!';
        include 'tobank2.html';
    }



       
}


	

	
	
	
    

	
	 
	$conn->close();
	
?>