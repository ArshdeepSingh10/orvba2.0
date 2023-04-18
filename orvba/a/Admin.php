<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panle</title>
    <link rel = "stylesheet" href = "Adminpanalcss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <div class= "bg-primary text-white navbar-nav "><h1 class="p-2">Admin Panal</h1></div>
        

        <table class= "table text-center  table-hover table-sm table-bordered">
            <thead >
                <tr class="bg-dark text-white">
                    <th>ID</th>
                    <th>Garage Name</th>
                    <th>Garage location</th>
                    <th>Services</th>
                    <th>Mobile Number</th>
                    <th>Accept</th>
                    <th>Reject</th>
                </tr>
            </thead>
            <tbody id="admin">
                
            </tbody>
        </table>
       
    </div>
    <script>
        
        

function checkboxa(id){
    let checkbox = document.getElementById(id);
    if(checkbox.checked){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "update.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send("id=" + id);
    }
}

    </script>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MECH_DB";
    
    $conn= mysqli_connect($servername, $username , $password ,$dbname);
    if(!$conn){
        die("connection failed: ". mysqli_connect_error());
    }
   

    $sql = "SELECT ID , GarageName,  location, gimg ,services,pNumber from mech_edit";
    $result = mysqli_query($conn, $sql);

   if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo '<script>
        var tag = "<tr><td>' . $row['ID'] . '</td> <td>' . $row['GarageName'] . '</td><td>' . $row['location'] . '</td><td>' . $row['services'] . '</td><td>' . $row['pNumber'] . '</td><td><input type=\"checkbox\" id=\"' . $row['ID'] . '\" onclick=\"checkboxa(this.id)\"></td><td><input type=\"checkbox\" onclick=\"checkbox()\"></td></tr>";
        document.getElementById("admin").innerHTML += tag;
        </script>';
        
    }
      }
   else{
       echo "0 result ";
   }


     
  
    ?>