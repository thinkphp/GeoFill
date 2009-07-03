(function(){

var $ = function(id){
    return document.getElementById(id);
}  

var find = document.createElement('input');

    find.setAttribute('type','button');  

    find.setAttribute('value','Find Locations');  

    find.onclick = function() {

      geofill.find({

       callback: function(o) {

       $('usercity').value = o.city;

       $('usercountry').value = o.country;

       $('userpostcode').value = o.postcode;

       $('userlat').value = o.latitude;

       $('userlon').value = o.longitude;
       }

     });            

    
   }//end handler click 

   var address = $('address');

   address.parentNode.insertBefore(find,address.nextSibling);  

})();