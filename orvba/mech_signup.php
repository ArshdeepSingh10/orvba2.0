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
    .b{border: 2px solid red;}

    .xs{display: none;}
    .w{font-size:30px;}
    h2{font-size:20px;}
    .desk{height:100vh;}
    .de{width: 550px;;}

    @media only screen and (max-width:420px){
    .f-c{flex-direction: column;}
    .align-items-center {
    align-items: start!important;
}
.shadow-lg { box-shadow:none!important;} 
    }
    @media only screen and (max-width:375px){
 }
    
 
</style>
    
</head>
<body>
<!-- ------------------desktop dimension--------------------- -->

<div class="desktop"> 
        <div class="desk d-flex justify-content-center  align-items-center ">
            
            <div class="de shadow-lg ">
    
            <div class="sign text-center pt-3">
                <h1 class="w fw-bold">Sign up</h1>
            <p class="text-muted "><b>Create an account. It's free</b></p>
            </div>
            
            <div class="sel d-flex justify-content-between px-5  fs-5">
                <div> As a User <input type="radio" onclick="user()" class="form-check-input" name="user" id="user" ></div>
            <div>As a Mech <input type="radio" onclick="mech()" class="form-check-input" name="mech_user" id="mech" checked></div>
            </div>
        
        
             <form method="post">
            <div class="f-c pt-4 d-flex  px-5 ">
                <div class="1-5 w-100 pe-0 pe-sm-3 ">
                    <h5>First name</h5>
                    <input class="w-100 p-2 "  type="fname" id="fname" name="fname" required><br>
                    <h5>Last name</h5>
                    <input class="w-100 p-2 "  type="lname" id="lname" name="lname" required><br>
                    <h5>Email</h5>
                    <input class="w-100 p-2" type="email" id="email" name="email" required><br>
                    <h5>Address</h5>
                    <input class="w-100 p-2" type="address" id="address" name="address" required><br>
                     
                </div>
                
           
                <div class="5-10 w-100 ">
                    <h5>Services</h5>
                    <input class="w-100 p-2" type="services" id="services" name="services" required ><br>

                    <h5>Phone Number</h5>
                    <input class="w-100 p-2" type="ph" id="ph" name="ph" required ><br>
                    <h5>Password</h5>
                    <input class="w-100 p-2 "  type="password" id="pwd" name="pwd" pattern=".{8,}" title="Eight or more characters" required><br>
                    <h5>Confirm Password</h5>
                    <input class="w-100 p-2" type="password" id="cpwd" name="cpwd" pattern=".{8,}" title="Eight or more characters" required><br>  
                </div>
                        
            </div>
        
        
             
            <div class="text-center pt-4">
                <button type="submit" name="submit" value="submit" class="btn  btn-primary  px-5 text-white ">Sign up</button>
            </div>
             </form>

            <div class="text-center pt-3">
                <p>Already have an account? <a href="index.php" class="text-decoration-none">Login</a></p>  
              </div>
        
        </div>
        </div>
        </div>


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

if(isset($_POST['submit'])) {

$_SESSION['fname']  = $_POST["fname"];
$_SESSION['lname']  = $_POST["lname"];
$_SESSION['email']  = $_POST["email"];
$_SESSION['address'] = $_POST["address"];
$_SESSION['services'] = $_POST["services"];
$_SESSION['ph'] = $_POST["ph"];
$_SESSION['pwd']  = $_POST["pwd"];


$fname = $_POST["fname"];
$lname = $_POST["username"];
$email = $_POST["email"];
$address = $_POST["address"];
$services = $_POST["services"];
$ph = $_POST["ph"];
$pass = $_POST["pwd"];
$cpass = $_POST["cpwd"];
$otp = rand(1000, 9999);

$user_emailquery = "select * from user_signup where email='$email' ";
$mech_emailquery = "select * from mech_signup where email='$email' ";

$user_query = mysqli_query($conn,$user_emailquery);
$mech_query = mysqli_query($conn,$mech_emailquery);

$user_emailcount = mysqli_num_rows($user_query);
$mech_emailcount = mysqli_num_rows($mech_query);

// $emailquery = "select * from mech_signup where email='$email' ";
// $query = mysqli_query($conn,$emailquery);
// $emailcount = mysqli_num_rows($query);

if($user_emailcount > 0 || $mech_emailcount > 0){
    echo'<script> alert("Email is already registered") </script>';
}
    else{
        if($pass === $cpass){
            // $sql = "INSERT INTO mech_signup (fname, lname, email, addres, services, phone_number, pass)
            // VALUES ('$fname','$lname','$email','$addres','$services','$ph' ,'$pass')";
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
                    echo'<script>
                    window.location.href = "otpToSignUp.php";
                    </script>';
                } else {
                    echo 'Email sending failed: ' . $mail->ErrorInfo;
                }

            // if (mysqli_query($conn, $sql)) {
            //     // echo '<script>
            //     // if(!alert("Your login id is created. You can login now")){
            //     //   window.location.href = "index.php";
            //     // }  
            //     // </script>';
              
            //   } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            //   }
        }else{
            echo'<script> alert("Confirm Password is not matching") </script>';
        }
    }

}


mysqli_close($conn);


?>

</body>
</html>