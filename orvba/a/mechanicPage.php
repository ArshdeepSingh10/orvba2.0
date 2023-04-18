
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MachanicPage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
               
    </head>

<body>
 

<form action="mechphp.php" method="post" enctype ="multipart/form-data">
<input type="file"  class="form-control" name="gimg" id="gimg" accept=".jpg, .jpeg, .png , .TIF" required>
    <input type="text"  class="form-control" name="gname" id="gname" placeholder="Garage Name" required>
    <input type="text"  class="form-control" name="glocation" id="glocation" value="ludhiana" placeholder="Garage Location" required>
    <input type="text"  class="form-control" name="services" id="services" placeholder="Services (separate with commas)" required>
    <input type="tel"  class="form-control" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number" required>
    <button type="button"  class="btn" onclick="findMyState()">Upload Your Location</button>
    <h1 id="mlocation"><h1>
    <input type="submit" class="btn" value="Submit" name="submit" id="submit">
</form>

<script >const findMyState = () => {
    const success = (position) => {
        console.log("hgj");
         console.log(position);
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
       //const geoapi = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude} &longitude=${longitude}&localityLanguage=en`

         const geoapi = `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=20375b6c7cc04d5897f1ad340b09b570`;
    //    fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=20375b6c7cc04d5897f1ad340b09b570`)
    //   .then(response => response.json()).then(result => console.log(result))
      
        fetch(geoapi)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                let d = data.results[0].formatted;
               // let {city , postcode} = d;
                 document.getElementById('mlocation').innerHTML = " "+d +"/";
            })
    }
    const error = () => {
         document.getElementById('mlocation').innerHTML  = 'unable to get your location'
    }
    navigator.geolocation.getCurrentPosition(success, error);

}
</script> 
</body>

</html>