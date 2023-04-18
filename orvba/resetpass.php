<?php
session_start();
if(!isset($_SESSION['email'])){
  header('Location: index..php');
    exit();
} 
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
            <h1 class="w  fw-bold ">Reset Password</h1>
            
            <!-- <div class=""><p class="text-muted "><b>We'have sent a verification code to your email - <span class="oemail"></span> </b></p></div> -->
            </div>
            
            <form method="post">
            <div class=" pt-2  px-5 t">
            <h2 class="w2">Password</h2>
            <input class="w-100  p-2 mb-2"  type="password" id="pwd" name="pwd" placeholder="New password" required><br>

            <h2 class="w2">Confirm Password</h2>
            <input class="w-100  p-2 mb-2"  type="password" id="cpwd" name="cpwd" placeholder="Confirm password" required><br>
        
            
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

    $email =$_SESSION['email'];
    $pass = $_POST["pwd"];
    $cpass= $_POST["cpwd"];




$user_emailquery = "select * from user_signup where email='$email' ";
$mech_emailquery = "select * from mech_signup where email='$email' ";

$user_query = mysqli_query($conn,$user_emailquery);
$mech_query = mysqli_query($conn,$mech_emailquery);

$user_emailcount = mysqli_num_rows($user_query);
$mech_emailcount = mysqli_num_rows($mech_query);


if($user_emailcount > 0 || $mech_emailcount > 0){

    if($pass != $cpass){
        echo'<script> alert("Confirm Password is not matching") </script>';

    }else{

        if($user_emailcount > 0  ){
            $sql = "UPDATE `user_signup` SET `pass` = '$pass' WHERE `user_signup`.`email` = '$email'";                     
            //   header("Location: user_interface.html");
            }elseif($mech_emailcount > 0 ){
                $sql = "UPDATE `mech_signup` SET `pass` = '$pass' WHERE `mech_signup`.`email` = '$email'";
            //   header("Location: mech_interface.html");
            }else{
              echo'<script> alert("Email is not registered") </script>';
            }

            if (mysqli_query($conn, $sql)) {
                echo '<script>
                if(!alert("Your password is reset. You can login now")){
                  window.location.href = "index.php";
                }  
                </script>';

        // echo'<script>
        // window.location.href = "otp.php";
        // </script>';
    }
}

}else{
    echo'<script> alert("Email is not registered") </script>';
  }
}
// header("Location: index.php");
mysqli_close($conn);
?>

</body>
</html>