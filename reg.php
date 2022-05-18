<?php
                session_start();
                $NAME = $_SESSION["NAME"] ;
                $PHONE_NUMBER = $_SESSION["PHONE_NUMBER"] ;
                $PASSWORD = $_SESSION["PASSWORD"] ;
                $MAIL = $_SESSION["MAIL"] ;
                $DOB = $_SESSION["DOB"] ;
                $Q1_Your_time_of_birth = $_SESSION["Q1_Your_time_of_birth"] ;
                $Q2_What_primary_school_did_you_attend = $_SESSION["Q2_What_primary_school_did_you_attend"] ;
                $Q3_What_was_the_street_name_you_lived_in_as_a_child = $_SESSION["Q3_What_was_the_street_name_you_lived_in_as_a_child"] ;
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
