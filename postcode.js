(function() {

 var but = document.createElement('input');

     but.setAttribute('type','button');

     but.setAttribute('value','Get Info');

 var $ = function(id){ 
 return document.getElementById(id);
 }

 var pc = $('userpostcode');                           
                              
    but.onclick = function() {

        geofill.lookup({

             city: 'usercity',

             country: 'usercountry',

             latitude: 'userlat',

             longitude: 'userlon',

             postcode: 'userpostcode',
 
             callback: function(o) {
 
               if(o.error) {
     
                   $('userpostcode').value = 'Invalide Postcode';

               }
             }
        });
    }

  pc.parentNode.insertBefore(but,pc.nextSibling);
 
})();
