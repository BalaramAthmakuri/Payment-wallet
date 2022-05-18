<?php
session_start();
$elecpass = $_POST['pin4elec'];
$_SESSION["pin4elec"] = $elecpass;
$elecp = $_SESSION["electprovider"];
$phone = $_SESSION["PHONE_NUMBER"];
$bill =   $_SESSION["billbal"];
$elec = $_SESSION["servicenumber"] ;
$conn = new mysqli('localhost','root','','userinfo');


$query = "SELECT PIN FROM pins WHERE PHONE_NUMBER = '$phone' ";
$pass = $conn->query($query);
$resultAll = mysqli_query($conn, "SELECT * FROM  pins WHERE PHONE_NUMBER = '$phone'");
if(!$resultAll)
{
    die(mysqli_error($conn));
}
if (mysqli_num_rows($resultAll) > 0) 
{
    while($rowData = mysqli_fetch_array($resultAll))
    {
        $pass =  $rowData["PIN"];
        
    }
}
$curr =  $_SESSION["currbalanceamt"];
if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
    } else {
                            if($elecpass == $pass){

                                if($curr >= $bill && $bill > 0)
                                {
                                    $query = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$phone' ";
                                    $rs = $conn->query($query);
                                    $resultAll = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$phone'");
                                    if(!$resultAll)
                                    {
                                        die(mysqli_error($conn));
                                    }

                                    if (mysqli_num_rows($resultAll) > 0) 
                                    {
                                        while($rowData = mysqli_fetch_array($resultAll))
                                        {
                                            $rs =  $rowData["BALANCE"];
                                            $amountd = $rs - $bill;
                                            $_SESSION["currbalanceamt"] = $amountd;
                                            
                                        }
                                    }
                                        $query1 = "SELECT DUE  FROM electricity WHERE SERVICE_NUMBER = '$elec' ";
                                        $rs1 = $conn->query($query1);
                                        $resultAll1 = mysqli_query($conn, "SELECT * FROM electricity WHERE SERVICE_NUMBER = '$elec'");
                                        if(!$resultAll1){
                                            die(mysqli_error($conn));
                                        }
                                        if (mysqli_num_rows($resultAll1) > 0) {
                                            while($rowData = mysqli_fetch_array($resultAll1)){
                                                $rs1 =  $rowData["DUE"];
                                                $amountdi = $rs1 - $bill;
                                                
                                            }
                                        }
                                        $sql = "UPDATE bankbalance SET BALANCE='$amountd' WHERE PHONE_NUMBER = '$phone'";
                                        $sql1 = "UPDATE electricity SET DUE='$amountdi' WHERE SERVICE_NUMBER = '$elec'";


                                        if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
                                        {
                                            include 'electricitybill5.html';
                                        } else {
                                            echo "Error updating record: " . $conn->error;
                                        }



                                }else{
                                        if($bill ==0){
                                            echo "Payment is till date";
                                            include 'electricitybill5.html';
                                        }
                                        else{
                                            echo 'Insufficient balance !!!! ';
                                            echo 'Please try again!!!';
                                            include 'electricitybill3.html';
                                        }
                                       
                                
                                }
                            }        else{
            echo 'Incorrect password !!';
            include 'logintry.html';
            echo $elecpass;
            echo $pass;
        }
    }
    
    
    
?>
