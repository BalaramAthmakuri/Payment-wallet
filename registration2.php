<?php
	$NAME = $_POST['NAME'];
    $PHONE_NUMBER = $_POST['PHONE_NUMBER'];
    $PASSWORD= $_POST['PASSWORD'];
    $MAIL = $_POST['MAIL'];
    $DOB = $_POST['DOB'];
    $Q1_Your_time_of_birth= $_POST['Q1_Your_time_of_birth'];
	$Q2_What_primary_school_did_you_attend= $_POST['Q2_What_primary_school_did_you_attend'];
    $Q3_What_was_the_street_name_you_lived_in_as_a_child= $_POST['Q3_What_was_the_street_name_you_lived_in_as_a_child'];
	

	// Database connection
	$conn = new mysqli('localhost','root','','userinfo');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into useri(NAME, PHONE_NUMBER, PASSWORD, MAIL, DOB, Q1_Your_time_of_birth, Q2_What_primary_school_did_you_attend, Q3_What_was_the_street_name_you_lived_in_as_a_child) values(?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssdsss", $NAME, $PHONE_NUMBER, $PASSWORD, $MAIL, $DOB, $Q1_Your_time_of_birth ,$Q2_What_primary_school_did_you_attend ,$Q3_What_was_the_street_name_you_lived_in_as_a_child);
		$execval = $stmt->execute();
		
		echo "Registered Successfully ! Login now below";
		include 'logintry.html';
		$stmt->close();
		$conn->close();
	}
?>
