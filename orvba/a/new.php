
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "MECH_DB";
        
        $conn= mysqli_connect($servername, $username , $password ,$dbname);
        if(!$conn){
            die("connection failed: ". mysqli_connect_error());
        }
       
    //    function getdata(){
        // $sql = "SELECT ID , GarageName,  location, gimg ,services,pNumber from mech_edit";
        $sql = "SELECT * from mech_edit WHERE status = 1";

        $result = mysqli_query($conn, $sql);

       if(mysqli_num_rows($result)>0){
           return $result;
          }
       else{
           echo "0 result ";
       }
    //    }
       
          
        
        
      
        ?>
        