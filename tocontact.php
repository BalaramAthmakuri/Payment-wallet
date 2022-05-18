<?php
session_start();
$PHONE = $_POST['mobilenumber'];
$PIN = $_POST['pin'];
$AMT = $_POST['amount'];
$self = $_SESSION["PHONE_NUMBER"];
$myno=$_SESSION["myno"];
$conn = new mysqli('localhost','root','','userinfo');
if($conn->connect_error)
{
echo "$conn->connect_error";
die("Connection Failed : ". $conn->connect_error);
} else
{
    $query = "SELECT PIN FROM pins WHERE PHONE_NUMBER = '$myno' ";
    $rs = $conn->query($query);
    $resultAll = mysqli_query($conn, "SELECT * FROM pins WHERE PHONE_NUMBER = '$myno'");
    if(!$resultAll)
    {
        die(mysqli_error($conn));
    }

    if (mysqli_num_rows($resultAll) > 0) 
    {
        while($rowData = mysqli_fetch_array($resultAll))
        {
            $rs =  $rowData["PIN"];
        }
    }
    if($PIN == $rs)
    {

        if( $AMT > $_SESSION["currbalanceamt"])
        {
            echo 'Insufficient amount';
            include 'tocontact1.html';

        }else{
            if($PHONE != $self && $_SESSION["currbalanceamt"]>0 && $AMT <= $_SESSION["currbalanceamt"])
            {
                $query = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$PHONE' ";
                $rs = $conn->query($query);
                $resultAll = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$PHONE'");
                if(!$resultAll)
                {
                    die(mysqli_error($conn));
                }

                if (mysqli_num_rows($resultAll) > 0) 
                {
                    while($rowData = mysqli_fetch_array($resultAll))
                    {
                        $rs =  $rowData["BALANCE"];
                        $amounti = $rs + $AMT;
                        
                    }
                    $query1 = "SELECT BALANCE FROM bankbalance WHERE PHONE_NUMBER = '$self' ";
                    $rs1 = $conn->query($query1);
                    $resultAll1 = mysqli_query($conn, "SELECT * FROM bankbalance WHERE PHONE_NUMBER = '$self'");
                    if(!$resultAll1){
                        die(mysqli_error($conn));
                    }
                    if (mysqli_num_rows($resultAll1) > 0) {
                        while($rowData = mysqli_fetch_array($resultAll1)){
                            $rs1 =  $rowData["BALANCE"];
                            $amountd = $rs1 - $AMT;
                            $_SESSION["newbalance"] = $amountd;
                        }
                    }
                    $sql = "UPDATE bankbalance SET BALANCE='$amounti' WHERE PHONE_NUMBER = '$PHONE'";
                    $sql1 = "UPDATE bankbalance SET BALANCE='$amountd' WHERE PHONE_NUMBER = '$self'";
                    if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) 
                    {

                        date_default_timezone_set("Asia/Calcutta");
                        $date = date("H:i:s");
                        $DAT = date("Y-m-d");
                        $stmt = $conn->prepare("insert into `{$PHONE}`(FROM_no, TO_no, AMOUNT, TIME, DATE) values(?, ?, ?, ?,?)");
                        $stmt->bind_param("ssiss", $self, $PHONE, $AMT, $date,$DAT);
                        $execval = $stmt->execute();
                        
                        $stmt->close();
                        
                        $stmt1 = $conn->prepare("insert into `{$self}`(FROM_no, TO_no, AMOUNT, TIME, DATE) values(?, ?, ?, ?,?)");
                        $stmt1->bind_param("ssiss", $self, $PHONE, $AMT, $date, $DAT);
                        $execval1 = $stmt1->execute();
                        
                        $stmt1->close();
                        include 'testtophone.html';
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }

                   

            }
            $conn->close();
            }else{
                echo 'Invalid phone number!';
                include 'tocontact1.html';
            }
        }

    }else{
        echo 'Invalid pin!';
        include 'tocontact1.html';
    }



       
}
?>