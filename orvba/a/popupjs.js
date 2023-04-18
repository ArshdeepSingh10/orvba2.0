
var arr =['1','2','3','4','5'];
var i =0;
var a = 6;
var d ;
function addrating(val ) {
    
    for(i=0; i < Number(val) ;i++ ){
        document.getElementById(arr[i]).style.color = "aqua"
    }
  
   
}
function submit(a){
 
    document.getElementById("rating"+a).innerHTML = i
    closePopup(); 
}

