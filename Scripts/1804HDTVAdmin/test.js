function ref(){
    //window.location = location.protocol + '//'+ location.host + location.pathname + '/#!bouquet';
    var back = $("#back");
    window.location.href = back.prop('href');
}
ref();
$(document).ready(function(){
    //var href=location.protocol + '//'+ location.host + location.pathname + '/#!bouquet'; 
    //console.log(href);
    //window.setTimeout(ref,2000);  
    
}); 