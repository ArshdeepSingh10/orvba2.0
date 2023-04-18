const findMyState = () => {
    // const status = document.querySelector('#status');
    const success = (position) => {
        console.log("hgj");
         console.log(position);
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        // console.log(latitude + " " + longitude);
        const geoapi = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude} &longitude=${longitude}&localityLanguage=en`
        
        //const geoapi = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&localityLanguage=en`
        
        fetch(geoapi)
            .then(res => res.json())
            .then(data => {
                // status.textContent = data.city
                 document.getElementById('status').innerHTML = " "+data.city +"/"+data.countryName;
                 // console.log(data)
            })
    }
    const error = () => {
         document.getElementById('status').innerHTML  = 'unable to get your location'
    }
    navigator.geolocation.getCurrentPosition(success, error);

}
console.log(findMyState());