<?php
function items($garagename , $location , $gimg ,$id , $services,$pNumber){
    $element = 
    '  <div class= " col-lg-4 col-md-4 col-sm-6 p-1 rounded-3  ">
    <div class="card col-12 border border-1 border-dark rounded-3 ">
    <p class="p-1 m-1">New</p>
    <img src="images/'.$gimg.'"  height="200" class="mx-2  rounded-3 " alt="image">

    <div class="card-body">
        <p class="float-start" id='.$id.'>
           '.$garagename.'
        </p>
         <div class="float-end">
            
            <span type="button" onclick="openPopup('.$id.')" id="rating'.$id.'"><i class="fa-regular fa-star"></i> 1</span>  

           <p> <span><i class="fa-solid fa-location-dot"></i></span> '.$location.'</p>
        </div>
    </div>


    <div class="px-2">
        <ul class="list-unstyled d-flex justify-content-around flex-wrap " id = "s'.$id.'">
            

       
        </ul>


    </div>
    <div class="card-footer bg-white border-0"> <button class="w-100 btn btn-primary"><a class ="text-decoration-none text-white" href= "tel:'.$pNumber.'">call</a></button></div>
</div>
</div>';
echo $element;

echo '<script>
var ss = "'.$services.'".split(",");
var c = ss.length;
for (var i = 0; i < c; i++){
    sr(i);
}
function sr(i){
    var element = \'<li class="p-1 m-1 border border-1 border-dark rounded-5">\' + ss[i] + \'</li>\';
    document.getElementById("s'.$id.'").innerHTML += element;
}
</script>';
}

    
?>

 
