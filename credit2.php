<?php
  session_start();
  $PIN = $_POST['pin'];  
  $conn = new mysqli('localhost','root','','userinfo');
  $mycard=$_SESSION["mycard"];
  $credamt=$_SESSION["credamt"];
  $self = $_SESSION["PHONE_NUMBER"];
  
    



    if( $credamt > $_SESSION["currbalanceamt"])
        {
            echo 'Insufficient amount';
            include 'mobilere2.html';

        }else{
          if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
          }else{
            $query = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$self' ";
            $rs = $conn->query($query);
            $resultAll = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$self'");
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
            $updated = $rs1 - $credamt;
            $query1 = "SELECT AMOUNT FROM creditcards WHERE CARD_NUMBER = '$mycard' ";
            $rs2 = $conn->query($query1);
            $resultAll = mysqli_query($conn, "SELECT * FROM creditcards WHERE CARD_NUMBER = '$mycard'");
            if(!$resultAll)
            {
                die(mysqli_error($conn));
            }
        
            if (mysqli_num_rows($resultAll) > 0) 
            {
                while($rowData = mysqli_fetch_array($resultAll))
                {
                    $rs2 =  $rowData["AMOUNT"];
                }
            }
            $newbal = $credamt + $rs2;
            $sql = "UPDATE bankbalance SET BALANCE='$updated' WHERE PHONE_NUMBER = '$self'";
            $sql1 = "UPDATE creditcards SET AMOUNT='$newbal' WHERE CARD_NUMBER = '$mycard'";
            
            if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
                    {
                      echo 'Successfully paid  !!';
                      include 'creditcards3.html';
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }

        }	
		$conn->close();
	}
?>

                   

               