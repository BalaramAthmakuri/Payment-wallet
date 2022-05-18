<?php
    session_start();
    $phno = $_POST['phno'];
    $gas = $_POST['gas'];
    $_SESSION['gas'] = $gas;
    $_SESSION['phno'] = $phno;
    $pho = $_SESSION['phno'];
    
  
    $conn = new mysqli('localhost','root','','userinfo');
    $query = "SELECT COST FROM gas WHERE GAS_NAME = '$gas' ";
    $rs = $conn->query($query);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM gas WHERE GAS_NAME = '$gas'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs =  $rowData["COST"];
              $_SESSION["gascost"] = $rs;
        }
    }




    $query1 = "SELECT GAS_NAME FROM gasinfo WHERE PHONE_NUMBER = '$phno' ";
   
    $rs1 = $conn->query($query1);
    
    $resultAll1 = mysqli_query($conn, "SELECT * FROM gasinfo WHERE PHONE_NUMBER = '$phno'");
    if(!$resultAll1){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll1) > 0) {
        while($rowData = mysqli_fetch_array($resultAll1)){
              $rs1 =  $rowData["GAS_NAME"];
              $_SESSION["gasname"] = $rs1;
              
        }
    }

   








    if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($gas == $rs1 ){
            include 'gasbill2.html';
        }
        else{
            echo 'Invalid Credentials. Please try again!!';
            include 'gasbill.html';
        }	
		$conn->close();
	}
?>

                   

               