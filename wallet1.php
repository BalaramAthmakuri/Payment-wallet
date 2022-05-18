
<html>
<head>
<style>
body {font-family: Arial, Helvetica, sans-serif}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04aa44;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}




.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */

.box {
    background-color: rgb(144, 73, 185);
    color: #ffffff;
   
    margin: 15% auto 10% auto; /* 5% from the top, 15% from the bottom and centered */
   
    width: 80%;
    height: 80%
}
/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }


 
}
</style>





<body>
    <br>
    <br>
  <center><h2 style="color:#270d3f;" >
    Your wallet balance is : 
    <?php   
        session_start();
        
  $conn = new mysqli('localhost','root','','userinfo');
  
  $self=$_SESSION["PHONE_NUMBER"];
          if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
          }else{
            $query = "SELECT BALANCE FROM wallet WHERE PHONE_NUMBER = '$self' ";
            $rs = $conn->query($query);
            $resultAll = mysqli_query($conn, "SELECT * FROM wallet WHERE PHONE_NUMBER = '$self'");
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
            echo $rs1;
           
          
          

        }



        
        	
		$conn->close();
	
        
        
        ?>
    
  </h2></center>

    <div class="box" style="text-align: center;width: auto; height:max-content">

    



    
  


   
    <div class="container">
      <form  method = "post">

      <label for="CARD DETAILS"><b>ENTER AMOUNT</b></label>
      <input type="text" placeholder="AMOUNT" name="amount" title="Invalid amount" ><br>
      <label for="CARD DETAILS"><b>ENTER PIN</b></label>
      <input type="password" id="pin" name="pin" placeholder = "Enter the PIN" maxlength="4" minlength="4" required>
    
     
     <button type="submit"  formaction="http://localhost/testsite/walletadd.php">Add_to_wallet</button>
     <button type="submit"  formaction="http://localhost/testsite/walletrem.php">Withdraw_from_wallet</button>
      

      </form>
      
    </div>
    

    <div class="container" style="background-color:#f1f1f1">
      
      <span class="otp"> </span>
    </div>
  </form>
</div>

<center><button onclick="document.getElementById('id01').style.display='block'">Wallet transaction</button></center>





</script>


</body>
</html>

