<?php
    session_start();
    $accno = $_POST['policy'];
    $hname = $_POST['holdername'];
    $amount = $_POST['amount'];
    $pin = $_POST['pin'];
    $PHONE=$_SESSION["PHONE_NUMBER"];
    
    
  
    $conn = new mysqli('localhost','root','','userinfo');
    $query1 = "SELECT HOLDER_NAME FROM lic WHERE POLICY_NUMBER = '$accno' ";
    $rs1 = $conn->query($query1);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM lic WHERE POLICY_NUMBER = '$accno'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs1 =  $rowData["HOLDER_NAME"];
        }
    }




    $query2 = "SELECT AMOUNT FROM lic WHERE POLICY_NUMBER = '$accno' ";
    $rs2 = $conn->query($query2);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM lic WHERE POLICY_NUMBER = '$accno'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs2 =  $rowData["AMOUNT"];
        }
    }


    $query3 = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$PHONE' ";
    $rs3 = $conn->query($query3);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$PHONE'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs3 =  $rowData["BALANCE"];
        }
    }

    $query4 = "SELECT PIN FROM pins WHERE PHONE_NUMBER = '$PHONE' ";
    $rs4 = $conn->query($query4);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM pins WHERE PHONE_NUMBER = '$PHONE'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs4 =  $rowData["PIN"];
        }
    }

    $rs5 = $rs3 - $amount;
    $rs6 = $rs2 + $amount;


   


   








    if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($pin == $rs4 && $rs1 == $hname ){
            $sql = "UPDATE lic SET AMOUNT='$rs6' WHERE POLICY_NUMBER = '$accno'";
            $sql1 = "UPDATE bankbalance SET BALANCE='$rs5' WHERE PHONE_NUMBER = '$PHONE'";
            if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
            {
                echo "Your LIC Payment completed...";
                include 'lictest.html';
            } else {
                echo "Error updating record: " . $conn->error;
            }



            
        }
        else{
            echo 'Invalid Credentials. Please try again!!';
            include 'lic.html.html';
        }	
		
	}
?>

                   

               