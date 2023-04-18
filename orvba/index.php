<?php
session_start();
session_unset();
session_destroy();
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

<!-- <script>
gapi.load('auth2',function(){
    gapi.auth2.init();
})
</script> -->

<style>
   .b{border: 2px solid red;}
    .w{font-size:30px;}
    h2{font-size:20px;}
    .desk{height:100vh;}
    .de{width: 450px;;}
    .xs{display: none;}
    .se{display: none;}
    @media only screen and (max-width:420px){
        
    }
    @media only screen and (max-width:375px){
        .shadow-lg { box-shadow:none!important;}  

    }  
</style>
</head>
<body>

<!-- ------------------desktop dimension----------------------->

<!-- --------------------need to impliment email otp to authentic users , forget password-------------------------------  -->


<div class="desktop"> 
<div class="desk d-flex justify-content-center align-items-center ">
    <div class="de shadow-lg ">
    <div class="text-center  pt-3">
    <h1 class="w  fw-bold ">Welcome To <br>ORVBA </h1>
    <h1 class="w  fw-bold pt-2 ">Login</h1>
    <p class="text-muted "><b>Login to your account</b></p>
    </div>
    
    <form method="POST">
    <div class=" pt-2  px-5 t">
    <h2 class="w2">Email</h2>
    <input class="w-100  p-2 mb-2"  type="email" id="email" name="email" required><br>
    <h2>Password</h2>
    <input class="w-100 p-2 " type="password" id="pwd" name="pwd" required><br>
    </div>
    
    <div class="text-center pt-4">
        <button type="submit" name="submit" class="btn  btn-primary  px-5 text-white ">Login</button>
    <div class="o d-flex text-center px-5 pt-3">
        <hr class="w-50 " ><p class="bg-white text-muted px-2 ">OR</p><hr class="w-50 ">
    
    </div>

 
    <h2><a href="#"  class=" text-decoration-none">Login with Gmail</a></h2>   
    <p><a href="forget.php" class="text-decoration-none">Forgot password?</a></p> 
    </div>
</form>

    <div class="text-center pt-4">
      <p>Don't have an account? <a href="user_signup.php" class="text-decoration-none">Sign up</a></p>  
    </div>
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
$pass = $_POST["pwd"];


$user_emailquery = "select * from user_signup where email='$email' ";
$mech_emailquery = "select * from mech_signup where email='$email' ";

$user_pass = "select * from user_signup where pass='$pass' ";
$mech_pass = "select * from mech_signup where pass='$pass' ";

$user_query = mysqli_query($conn,$user_emailquery);
$mech_query = mysqli_query($conn,$mech_emailquery);

$user_pass_query = mysqli_query($conn,$user_pass);
$mech_pass_query = mysqli_query($conn,$mech_pass);

$user_emailcount = mysqli_num_rows($user_query);
$mech_emailcount = mysqli_num_rows($mech_query);

$user_pass_count = mysqli_num_rows($user_pass_query);
$mech_pass_count = mysqli_num_rows($mech_pass_query);

if($user_emailcount > 0 || $mech_emailcount > 0){
  
  if($user_pass_count > 0 || $mech_pass_count > 0){
  
    if($user_emailcount > 0 && $user_pass_count > 0 ){
      header("Location: a/Product.php");
    }elseif($mech_emailcount > 0 && $mech_pass_count > 0 ){
      header("Location: a/mechanicPage.php");
    }else{
      echo'<script> alert("Password is wrong") </script>';
    }
    
  }
  else{
    echo'<script> alert("Password is wrong") </script>';
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