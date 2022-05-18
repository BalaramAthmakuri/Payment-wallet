<?php
    session_start();
    $PHONEr = $_POST['PHONE_NUMBER'];
    $_SESSION["mypno"] = $PHONEr;
    $PASS = $_POST['NETWORK'];
    $conn = new mysqli('localhost','root','','userinfo');
    $query = "SELECT NETWORK FROM mobilerecharge WHERE PHONE_NUMBER = '$PHONEr' ";
    $rs = $conn->query($query);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM mobilerecharge WHERE PHONE_NUMBER = '$PHONEr'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs =  $rowData["NETWORK"];
        }
    }
    if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($rs == $PASS){
            include 'mobilere2.html';
        }
        else{
            echo 'Invalid selection !!';
            include 'mobilere.html';
        }	
		$conn->close();
	}
?>

                   

               