(function(){

geofill.find({callback: function(o){

var $ = function(id) { 
return document.getElementById(id);
}

var suggest = document.createElement('div');

    suggest.setAttribute('id','suggest');

var html = '<p><strong>Is this you are?';

    html += '</strong></p>';    

    html += '<p>We think you are in ';

    html += o.city + ', '+ o.country;

    html += '</p>';    

    html += '<p>Is it right?</p>'; 

    suggest.innerHTML = html;

 var but = document.createElement('input');

     but.setAttribute('type','button');     

     but.setAttribute('value','more info');

     but.onclick = function() {

       $('usercity').value = o.city;

       $('usercountry').value = o.country;

       $('userpostcode').value = o.postcode;

       $('userlat').value = o.latitude;

       $('userlon').value = o.longitude;

       $('suggest').parentNode.removeChild($('suggest'));

     }//end handler

        suggest.appendChild(but);

 var p = $('address');

     p.parentNode.insertBefore(suggest,p.nextSibling); 


     }});

})();