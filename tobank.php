<?php
    session_start();
    $bank = $_POST['BANK'];
    $accno = $_POST['accno'];
    $_SESSION['accno'] = $accno;
    $acno = $_SESSION['accno'];
    
    $name = $_POST['accname'];
    $ifsc = $_POST['ifsc'];
    $amt = $_POST['amount'];
    $_SESSION["amount"] = $amt;
    $amts = $_SESSION["amount"];
    $conn = new mysqli('localhost','root','','userinfo');
    $query = "SELECT BANK_NAME FROM bankbalance WHERE ACCOUNT_NUMBER = '$accno' ";
    $rs = $conn->query($query);
    $rs1 = $conn->query($query);
    $rs2 = $conn->query($query);
    $rs3 = $conn->query($query);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM bankbalance WHERE ACCOUNT_NUMBER = '$accno'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs =  $rowData["BANK_NAME"];
              $rs1 =  $rowData["ACCOUNT_NUMBER"];
              $rs2 =  $rowData["ACCOUNT_HOLDER_NAME"];
              $rs3 =  $rowData["IFSC"];
              
        }
    }

   








    if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($rs == $bank && $rs1 == $accno && $rs2 == $name && $rs3 == $ifsc){
            
            include 'tobank2.html';
        }
        else{
            echo 'Invalid Credentials. Please try again!!';
            include 'tobank1.html';
        }	
		$conn->close();
	}
?>

                   

               