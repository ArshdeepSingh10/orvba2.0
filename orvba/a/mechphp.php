


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MECH_DB";

$conn= mysqli_connect($servername, $username , $password ,$dbname);
if(!$conn){
    die("connection failed: ". mysqli_connect_error());
}

if(isset($_POST['submit'])){
  
    $garage_name = $_POST['gname'];
    $location = $_POST['glocation'];
    $services = $_POST['services'];
   $pNumber = $_POST['mobileNumber'];
   
}
if(isset($_FILES['gimg'])){
    $g_image =$_FILES['gimg']['name']; 
    $g_image_size =$_FILES['gimg']['size']; 
    $g_image_tmp =$_FILES['gimg']['tmp_name']; 
    $g_image_type =$_FILES['gimg']['type'];

  
   
 
move_uploaded_file($g_image_tmp , "images/". $g_image);
}



    $sql = "INSERT INTO mech_edit (GarageName,gimg,location ,services ,pNumber ,status) VALUES('$garage_name', '$g_image','$location' ,'$services',$pNumber, 0)";
    if(mysqli_query($conn, $sql)){
       
       echo " <script>alert('data is inserted')</script>";
    
    }
    else{
        echo "error ". mysqli_error($conn);
    }
      






mysqli_close($conn);


?>

    
</body>
</html>