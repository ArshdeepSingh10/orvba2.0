<?php
include('Items.php');
include("new.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORVBA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="indexcss.css">
    <script src="popupjs.js"></script>


    <script  >
        const findMyState = () => {
    // const status = document.querySelector('#status');
    const success = (position) => {
        console.log("hgj");
         console.log(position);
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        // console.log(latitude + " " + longitude);
        
    const geoapi = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude} &longitude=${longitude}&localityLanguage=en`
      //  const geoapi= `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${apikey}`
        //const geoapi = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&localityLanguage=en`
        
        fetch(geoapi)
            .then(res => res.json())
            .then(data => {
                // status.textContent = data.city
                 document.getElementById('status').innerHTML = " "+data.city +"/"+data.countryName;
                 console.log(data)
            })
    }
    const error = () => {
         document.getElementById('status').innerHTML  = 'unable to get your location'
    }
    navigator.geolocation.getCurrentPosition(success, error);

}
console.log(findMyState());
    </script>

    
</head>

<body>
    <!-- **********************navbarSTART*************************** -->

    <div class="container-fluid sticky-top x">
        <div class="row p-1 bg-primary text-white  d-flex align-items-center ">

            <div class="col-lg-4 col-md-3 col-sm-2 col-3 p-1">
                <h2 class="fs-4 m-0">
                    ORVBA
                </h2>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-5 col-9 p-1">
                <div class="input-group">
                    <span class="input-group-text bg-white"> <i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control   border-0">

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-12  p-1 d-flex justify-content-end ">

                
                    <span><i class="fa-solid fa-location-dot"></i> </span><h2 class="fs-6 m-0  " id ="status"> Ludhiana/punjab/india
                </h2>
            </div>
        </div>
    </div>
    <!-- **********************navbarEND*************************** -->
    <!-- ///////////////////////CARD////////////////////////////// -->
    

    <div class="container">
        <div class="row p-1">
          
               
            <?php
            $is = false;
          
       
           while($row = mysqli_fetch_assoc($result)){
            items($row['GarageName'],$row['location'], $row['gimg'] , $row['ID'] , $row['services'] ,$row['pNumber']);
          
        }
     
            ?>

        </div>
    </div>

    <div class="d-flex justify-content-center align-item-center p" id="popup">
<div class="bg-black popup text-center text-white " >
    <span class="float-end px-3 py-2" onclick="closePopup()" ><i class="fa-solid fa-circle-xmark"></i></span>
   
   <div class="py-5">
   
    <h1 id="g_name">
    
    </h1>
    <input style="width: 75%; height: 100px; " placeholder="Feedback" type="text"  class="rounded-3 my-3 p-2">
    
    <p>
        <span onclick="addrating(this.id)" class="fs-3" id="1"><i class="fa-regular fa-star"></i></span>
        <span onclick="addrating(this.id)" class="fs-3" id="2"><i class="fa-regular fa-star"></i></span> 
        <span onclick="addrating(this.id)" class="fs-3" id="3"><i class="fa-regular fa-star"></i></span>
        <span onclick="addrating(this.id)" class="fs-3" id="4"><i class="fa-regular fa-star"></i></span>
        <span onclick="addrating(this.id)" class="fs-3" id="5"><i class="fa-regular fa-star"></i></span>
    </p>
    <button class="btn rounded-5 btn-light" onclick="submit(d)">Submit</button>
</div>
</div>
    </div>

    <script>
        
 let popupa = document.getElementById("popup");


function openPopup(val){
    popupa.classList.add("open-popup");
   
    d=val;
    var g = document.getElementById(val).innerHTML;

     var r = document.getElementById("rating"+val).innerHTML;
    document.getElementById("g_name").innerHTML = g;


}
function closePopup(){
 popupa.classList.remove("open-popup");
    
}
    </script>
</body>

</html>