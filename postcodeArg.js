(function(){
 
geofill.lookup({

    callback: function(o){

        var $ = function(id){
        return document.getElementById(id);
        }

            if(!o.error) {

                $('usercity').value = o.city;   

                $('usercountry').value = o.country;   

                $('userpostcode').value = o.postcode;   

                $('userlat').value = o.latitude;   

                $('userlon').value = o.longitude;   

            } else {

                alert('Invalid Postcode!');
            }
    }

},'0300000');

})();