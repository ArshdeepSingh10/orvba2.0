<?php
session_start(); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/phpmailer/src/Exception.php';
require 'C:/xampp/phpmailer//src/PHPMailer.php';
require 'C:/xampp/phpmailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
<style>


    .w{font-size:30px;}
    h2{font-size:20px;}
    .desk{height:100vh;}
    .de{width: 450px;;}
  
    @media only screen and (max-width:420px){

    }

    @media only screen and (max-width:375px){
        .shadow-lg { box-shadow:none!important;} 
        .align-items-center {
    align-items: start!important;
}
    }
</style>
    
</head>
<body>

<!-- ------------------desktop dimension--------------------- -->
<div class="desktop"> 
    <div class="desk d-flex justify-content-start justify-content-center  align-items-center ">
        <div class="de shadow-lg ">

        <div class="sign text-center pt-3">
    
            <h1 class="w fw-bold">Sign up</h1>
        <p class="text-muted "><b>Create an account. It's free</b></p>
        </div>
        
        <div class="sel d-flex justify-content-between px-5  fs-5">
            <div> As a User <input type="radio" onclick="user()" class="form-check-input" name="user" id="user" checked></div>
        <div>As a Mech <input type="radio" onclick="mech()" class="form-check-input" name="mech_user" id="mech"></div>
        </div>
    
    
         <form method="post" >
        <div class="pt-4 px-5 ">
            <h5>First name</h5>
            <input class="w-100 p-2 "  type="fname" id="fname" name="fname" required><br>
            <h5>Last name</h5>
            <input class="w-100 p-2 "  type="lname" id="lname" name="lname" required><br>
            <h5>Email</h5>
            <input class="w-100 p-2" type="email" id="email" name="email" required><br>
            <h5>Password</h5>
            <input class="w-100 p-2 "  type="password" id="pwd" name="pwd" pattern=".{8,}" title="Eight or more characters" required><br>
            <h5>Confirm Password</h5>
            <input class="w-100 p-2" type="password" id="cpwd" name="cpwd" pattern=".{8,}" title="Eight or more characters" required><br>
        
        </div>
    
    
         
        <div class="text-center pt-4">
            <button type="submit" name="submit" value="submit" onclick="otp()" class="btn  btn-primary  px-5 text-white " >Sign up</button>
        </div>
         </form>

        <div class="text-center pt-3">
            <p>Already have an account? <a href="index.php" class="text-decoration-none">Login</a></p>  
          </div>
    
    </div>
    </div>
    </div>

<!-- ------------------ popup------------------------ -->

<!-- 
<div class="popup" id="popup"> 
        <div class="desk d-flex justify-content-center align-items-center ">
            <div class="de shadow-lg ">
            <div class="text-center  pt-3">
            <h1 class="w  fw-bold ">OTP Verification</h1>
            
            <div class=""><p class="text-muted "><b>We'have sent a verification code to your email - <span class="oemail"></span> </b></p></div>
            </div>
            
            <form method="POST">
            <div class=" pt-2  px-5 t">
            <h2 class="w2">OTP</h2>
            <input class="w-100  p-2 mb-2"  type="otp" id="otp" name="otp" placeholder="Enter verification code" required><br>
        
            
            <div class="text-center py-4 ">
                <button type="submit" name="submit" class="btn  btn-primary  px-5 text-white ">Login</button>
           
            </div>
        </form>
        
    
            </div>
            </div>
        </div> -->


<script>
    function user(){
            window.location = 'user_signup.php';
        }
        function mech(){
            window.location = 'mech_signup.php';
        }
    </script>



<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_demo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST["submit"])) {
 $_SESSION['fname']  = $_POST["fname"];
 $_SESSION['lname']  = $_POST["lname"];
 $_SESSION['email']  = $_POST["email"];
 $_SESSION['pwd']  = $_POST["pwd"];
    
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$pass = $_POST["pwd"];
$cpass= $_POST["cpwd"];
$otp = rand(1000, 9999);

$_SESSION['otp']  = $otp;

$user_emailquery = "select * from user_signup where email='$email' ";
$mech_emailquery = "select * from mech_signup where email='$email' ";

$user_query = mysqli_query($conn,$user_emailquery);
$mech_query = mysqli_query($conn,$mech_emailquery);

$user_emailcount = mysqli_num_rows($user_query);
$mech_emailcount = mysqli_num_rows($mech_query);

if($user_emailcount > 0 || $mech_emailcount > 0){
    echo'<script> alert("Email is already registered") </script>';
} else{
        if($pass != $cpass){
            echo'<script> alert("Confirm Password is not matching") </script>';

        }else{
            echo'<script>
            window.location.href = "otpToSignUp.php";
            </script>';
            
            $sql = "INSERT INTO otp (email, otp)
             VALUES ('$email','$otp')";
             mysqli_query($conn, $sql);


            $mail = new PHPMailer(true);

                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp-relay.sendinblue.com';                  // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'noreply.orvba@gmail.com';             // SMTP username
                $mail->Password   = 'xsmtpsib-8696b7703be4b381235479bcf4d520c2acb080f7ffd0997b6502a0e7adbd0847-GhYVA8THJbmscUSn';             // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                $mail->setFrom('noreply.orvba@gmail.com', 'ORVBA');
                $mail->addAddress("$email", 'Recipient');    // Add a recipient


                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Subject = 'OTP Verification';
                $mail->Body    = "Your OTP code is: $otp";

                // $mail->send();
                // echo 'Message has been sent';

                if ($mail->send()) {
                    echo 'Email sent successfully.';
                    
                } else {
                    echo 'Email sending failed: ' . $mail->ErrorInfo;
                }


        }
    }

}
mysqli_close($conn);
?>




</body>
</html>