<?php
    session_start();
    $card = $_POST['cardnumber'];
    $_SESSION["mycard"] = $card;
    $cardname = $_POST['cardname'];
    $amt = $_POST['AMOUNT'];
    $_SESSION["credamt"] = $amt;
    $conn = new mysqli('localhost','root','','userinfo');
    $query1 = "SELECT CARD_HOLDER_NAME FROM creditcards WHERE CARD_NUMBER = '$card' ";
    $rs1 = $conn->query($query1);
    
    $resultAll1 = mysqli_query($conn, "SELECT * FROM creditcards WHERE CARD_NUMBER = '$card'");
    if(!$resultAll1){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll1) > 0) {
        while($rowData = mysqli_fetch_array($resultAll1)){
              $rs1 =  $rowData["CARD_HOLDER_NAME"];
        }
    }

    

    if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		if($rs1 == $cardname){
            include 'creditcards2.html';
        }
        else{
            echo 'Invalid selection !!';
            include 'creditcards.html';
        }	
		$conn->close();
	}
?>

                   

               