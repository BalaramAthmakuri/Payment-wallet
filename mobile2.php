<?php
  session_start();
  $BAL = $_POST['BALANCE'];  
  $conn = new mysqli('localhost','root','','userinfo');
  $mypno=$_SESSION["mypno"];
  $self=$_SESSION["PHONE_NUMBER"];
  
    



    if( $BAL > $_SESSION["currbalanceamt"])
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
            $updated = $rs1 - $BAL;
            $query1 = "SELECT BALANCE_AMOUNT FROM mobilerecharge WHERE PHONE_NUMBER = '$mypno' ";
            $rs2 = $conn->query($query1);
            $resultAll = mysqli_query($conn, "SELECT * FROM mobilerecharge WHERE PHONE_NUMBER = '$mypno'");
            if(!$resultAll)
            {
                die(mysqli_error($conn));
            }
        
            if (mysqli_num_rows($resultAll) > 0) 
            {
                while($rowData = mysqli_fetch_array($resultAll))
                {
                    $rs2 =  $rowData["BALANCE_AMOUNT"];
                }
            }
            $newbal = $BAL + $rs2;
            $sql = "UPDATE bankbalance SET BALANCE='$updated' WHERE PHONE_NUMBER = '$self'";
            $sql1 = "UPDATE mobilerecharge SET BALANCE_AMOUNT='$newbal' WHERE PHONE_NUMBER = '$mypno'";
            
            if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
                    {
                      echo 'Successfully recharged  !!';




                      
                      include 'test.html';
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }

        }	
		$conn->close();
	}
?>

                   

               