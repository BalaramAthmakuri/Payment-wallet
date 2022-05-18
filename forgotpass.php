<?php

$PHONE_NUMBER = $_POST['PHONE_NUMBER'];
$Q1_Your_time_of_birth= $_POST['Q1_Your_time_of_birth'];
$Q2_What_primary_school_did_you_attend= $_POST['Q2_What_primary_school_did_you_attend'];
$Q3_What_was_the_street_name_you_lived_in_as_a_child= $_POST['Q3_What_was_the_street_name_you_lived_in_as_a_child'];

$conn = new mysqli('localhost','root','','userinfo');
    $query1 = "SELECT Q1_Your_time_of_birth FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER' ";
    $rs1 = $conn->query($query1);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs1 =  $rowData["Q1_Your_time_of_birth"];
        }
    }

    $query2 = "SELECT Q2_What_primary_school_did_you_attend FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER' ";
    $rs2 = $conn->query($query2);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs2 =  $rowData["Q2_What_primary_school_did_you_attend"];
        }
    }

    $query3 = "SELECT Q3_What_was_the_street_name_you_lived_in_as_a_child FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER' ";
    $rs3 = $conn->query($query3);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs3 =  $rowData["Q3_What_was_the_street_name_you_lived_in_as_a_child"];
        }
    }


    $query4 = "SELECT PASSWORD FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER' ";
    $rs4 = $conn->query($query3);
    
    $resultAll = mysqli_query($conn, "SELECT * FROM useri WHERE PHONE_NUMBER = '$PHONE_NUMBER'");
    if(!$resultAll){
        die(mysqli_error($conn));
    }  
    if (mysqli_num_rows($resultAll) > 0) {
        while($rowData = mysqli_fetch_array($resultAll)){
              $rs4 =  $rowData["PASSWORD"];
        }
    }

    if($rs1 == $Q1_Your_time_of_birth && $rs2 == $Q2_What_primary_school_did_you_attend && $rs3 == $Q3_What_was_the_street_name_you_lived_in_as_a_child ){
        echo 'Verified !';
        echo 'Your password is ';
        echo $rs4;
        include 'logintry.html';
    }


?>