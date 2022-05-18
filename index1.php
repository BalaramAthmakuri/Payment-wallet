<?php
session_start();


$NAME = $_POST['NAME'];
$PHONE_NUMBER = $_POST['PHONE_NUMBER'];
$PASSWORD= $_POST['PASSWORD'];
$MAIL = $_POST['MAIL'];
$DOB = $_POST['DOB'];
$Q1_Your_time_of_birth= $_POST['Q1_Your_time_of_birth'];
$Q2_What_primary_school_did_you_attend= $_POST['Q2_What_primary_school_did_you_attend'];
$Q3_What_was_the_street_name_you_lived_in_as_a_child= $_POST['Q3_What_was_the_street_name_you_lived_in_as_a_child'];



$_SESSION["NAME"] = $NAME;
$_SESSION["PHONE_NUMBER"] = $PHONE_NUMBER;
$_SESSION["PASSWORD"] = $PASSWORD;
$_SESSION["MAIL"] = $MAIL;
$_SESSION["DOB"] = $DOB;
$_SESSION["Q1_Your_time_of_birth"] = $Q1_Your_time_of_birth;
$_SESSION["Q2_What_primary_school_did_you_attend"] = $Q2_What_primary_school_did_you_attend;
$_SESSION["Q3_What_was_the_street_name_you_lived_in_as_a_child"] = $Q3_What_was_the_street_name_you_lived_in_as_a_child; 


?>
<!DOCTYPE html>
<html>
<head>
	<title>otp verification</title>
	        
    <?php include 'link1.php'?>

</head>
<body>

		<!--html part start-->
		<div class="container p-3 my-3 ">
			<div class="row">
				<div  class="col-6  p-4 ml-2">
					<div class="otp_msg"></div>
					<h1  style="color:#9b56db;">Mobile verification</h1>
			<form method="post">
			  <div class="form-group">
			    <label for="mobile">Enter Mobile Number</label>
			    <input type="text" class="form-control" id="mob"  placeholder="Enter mobile" value = "<?php $phon = $_SESSION["PHONE_NUMBER"];echo $phon;?>">
			   
			  </div>
              <button type="button" id="sendotp" class="btn btn-primary">Send OTP</button>
			  <div class="form-group" id="otpdiv">
			    <label for="otp verification">Enter OTP</label>
			    <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
			    <br>
			    <div class="countdown"></div>
				<a href="#" id="resend_otp" type="button">Resend</a>
			  </div>
			 
			  
			  <button type="button" id="verifyotp" class="btn btn-primary">Verify OTP</button>
			  
			</form>
				</div>

				<div class="col-6 ml-2">
					
				</div>
			</div>

			
		</div>

		<!-- html part ends-->

		<script type="text/javascript">
			
			$(document).ready(function(){


				function validate_mobile(mob){

					var pattern =  /^[6-9]\d{9}$/;

					if (mob == '') {

						return false;
					}else if (!pattern.test(mob)) {

						return false;
					}else{

						return true;
					}
				}


				//send otp function
				function send_otp(mob){

						var ch = "send_otp";
							
							$.ajax({

							url: "otp_process1.php",
							method: "post",
							data: {mob:mob,ch:ch},
							dataType: "text",
							success: function(data){

								if (data == 'success') {

									$('#otpdiv').css("display","block");
									$('#sendotp').css("display","none");
									$('#verifyotp').css("display","block");
									
										timer();
									$('.otp_msg').html('<div class="alert alert-success">OTP sent successfully</div>').fadeIn();
										
										window.setTimeout(function(){
										$('.otp_msg').fadeOut();
									},1000)
										

								}else{

									$('.otp_msg').html('<div class="alert alert-danger">Error in sending OTP</div>').fadeIn();
										
										window.setTimeout(function(){
										$('.otp_msg').fadeOut();
									},1000)
								
								}
							}

						});
				}
				//end of send otp function


				//send otp function

				$('#sendotp').click(function(){

					var mob = $('#mob').val();

					

						if (validate_mobile(mob) == false) $('.otp_msg').html('<div class="alert alert-danger" style="position:absolute">Enter Valid mobile number</div>').fadeIn(); else 	send_otp(mob);

						window.setTimeout(function(){
							$('.otp_msg').fadeOut();
						},1000)
						
				
					    	
		

					});

				//end of send otp function


				//resend otp function
				$('#resend_otp').click(function(){

					var mob = $('#mob').val();
					
					send_otp(mob);
						$(this).hide();
				});
				//end of resend otp function


			//verify otp function starts

			$('#verifyotp').click(function(){

						
						var ch = "verify_otp";
						var otp = $('#otp').val();

						$.ajax({

							url: "otp_process1.php",
							method: "post",
							data: {otp:otp,ch:ch},
							dataType: "text",
							success: function(data){

									if (data == "success") {
                                        

										$('.otp_msg').html('<div class="alert alert-success">OTP Verified successfully</div>').show().fadeOut(4000);
										open(URL="reg.php","_self")

                                        


																				
									}else{

										$('.otp_msg').html('<div class="alert alert-danger">otp did not match</div>').show().fadeOut(4000);
									}
							}
						});
								

				});

			//end of verify otp function

            
			//start of timer function

			function timer(){

					var timer2 = "00:59";
					var interval = setInterval(function() {


					  var timer = timer2.split(':');
					  //by parsing integer, I avoid all extra string processing
					  var minutes = parseInt(timer[0], 10);
					  var seconds = parseInt(timer[1], 10);
					  --seconds;
					  minutes = (seconds < 0) ? --minutes : minutes;
					  
					  seconds = (seconds < 0) ? 59 : seconds;
					  seconds = (seconds < 10) ? '0' + seconds : seconds;
					  //minutes = (minutes < 10) ?  minutes : minutes;
					  $('.countdown').html("Resend otp in:  <b class='text-primary'>"+ minutes + ':' + seconds + " seconds </b>");
					  //if (minutes < 0) clearInterval(interval);
					  if ((seconds <= 0) && (minutes <= 0)){
					  	clearInterval(interval);
					  	$('.countdown').html('');
					  	$('#resend_otp').css("display","block");
					  } 
					  timer2 = minutes + ':' + seconds;
					}, 1000);

				}

				//end of timer


			});
		</script>
</body>
</html>