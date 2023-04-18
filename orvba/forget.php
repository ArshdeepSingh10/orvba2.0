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

  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content= "768682101981-ne4r9hp4g2jdo8j2tt0ds0ol167pd9lq.apps.googleusercontent.com">



  <style>
         .w{font-size:30px;}
    h2{font-size:20px;}
    .desk{height:100vh;}
    .de{width: 450px;;}
    </style>
</head>
<body>
<div class="otp"> 
        <div class="desk d-flex justify-content-center align-items-center ">
            <div class="de shadow-lg ">
            <div class="text-center  pt-3">
            <h1 class="w  fw-bold ">Forgot Password</h1>
            
            <!-- <div class=""><p class="text-muted "><b>We'have sent a verification code to your email - <span class="oemail"></span> </b></p></div> -->
            </div>
            
            <form method="post">
            <div class=" pt-2  px-5 t">
            <h2 class="w2">Email</h2>
            <input class="w-100  p-2 mb-2"  type="email" id="email" name="email" placeholder="Enter your email" required><br>
        
            
            <div class="text-center py-4 ">
                <button type="submit" name="submit" class="btn  btn-primary  px-5 text-white ">Submit</button>
           
            </div>
        </form>
        
    
            </div>
            </div>
        </div>

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

    $email = $_POST["email"];
    $otp = rand(1000, 9999);
    $_SESSION['email']  = $_POST["email"];
    $_SESSION['otp']  = $otp;


$user_emailquery = "select * from user_signup where email='$email' ";
$mech_emailquery = "select * from mech_signup where email='$email' ";

$user_query = mysqli_query($conn,$user_emailquery);
$mech_query = mysqli_query($conn,$mech_emailquery);

$user_emailcount = mysqli_num_rows($user_query);
$mech_emailcount = mysqli_num_rows($mech_query);


if($user_emailcount > 0 || $mech_emailcount > 0){
  

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
             header("Location: otpToReset.php");
         } else {
             echo 'Email sending failed: ' . $mail->ErrorInfo;
         }
    
    
}
else{
  echo'<script> alert("Email is not registered") </script>';
}

}
// header("Location: index.php");
mysqli_close($conn);
?>

</body>
</html>