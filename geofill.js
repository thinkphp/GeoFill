/*
Author: Adrian Statescu
Filename: geofill.js
Description: Lookup by IP and Postcode
*/
//show me love to the Module Pattern
var geofill = function() {

    var fieldsToFill = null;

    var postcode = null;

    var ipdata = null;  

        //does un IP lookup the current user and tries to get geographical information for that one
        function find(o) {

                 fieldsToFill = o;

                 var url = 'http://geoip.pidgets.com/?format=json&callback=geofill.getpc';

                 getJSON(url); 

        };

        function getPostalCode(o) {

                 ipdata = o;

                 var root = 'http://query.yahooapis.com/v1/public/yql?q=';

                 var yql = 'select postal from geo.places where woeid in (select place.woeid from flickr.places where lat = "'+ o.latitude +'" and lon="'+ o.longitude +'")';

                 var url = root + encodeURIComponent(yql) + '&diagnostics=false&format=json&callback=geofill.set';

                     getJSON(url);

        };

        function set(o) {

               var filtered = {

                   city: ipdata.city,

                   country: ipdata.country_name,

                   postcode: o.query.results.place.postal.content,

                   latitude: ipdata.latitude,

                   longitude: ipdata.longitude
               };

               for(var i in fieldsToFill) {

                       var x = document.getElementById(fieldsToFill[i]);

                       if(x) {

                              x.value = filtered[i];
                       }
               } 


               if(typeof fieldsToFill.callback === 'function') {

                          fieldsToFill.callback(filtered);
               }//endif

        }; 


        //tries to get geographical information from the POSTCODE provided in the form
        function lookup(json) {

                postcode = json;

                var getcode = null;

                if(typeof arguments[1] === 'string') {

                          getcode = arguments[1];  
                } else {

                          var code = document.getElementById(json.postcode);

                          if(code) {

                                getcode = code.value;                                
                          }
                }

                var root = 'http://query.yahooapis.com/v1/public/yql?q=';

                var yql = 'select * from geo.places where text="'+ getcode +'"'; 

                var url = root + encodeURIComponent(yql) + '&diagnostics=false&format=json&callback=geofill.setpc'; 

                    getJSON(url); 
    
        };

        function setPostalCode(json) {

                 if(json.query.results) {

                         var place = json.query.results.place;

                             if(place[1]) {

                                   place = place[0];
                             }

                         if(place.postal) {

                                var filtered = {

                                    postcode: place.postal.content,

                                    city: place.locality1.content,

                                    country: place.country.content,

                                    latitude: place.centroid.latitude,

                                    longitude: place.centroid.longitude
                                };

                                for(var i in postcode) {

                                        var x = document.getElementById(postcode[i]); 

                                            if(x) {

                                                  x.value = filtered[i]; 

                                            }//endif
                                }//endofor

                              
                       
                         //otherwise error
                         } else {

                                var filtered = {'error': 'postcode'};
                         }


                 } else {

                                var filtered = {'error': '404'};
                 }

                 if(typeof postcode.callback === 'function') {

                           postcode.callback(filtered);
                 }

        };//end function

        function getJSON(url) {

                 var script = document.createElement('script');

                     script.setAttribute('type','text/javascript');

                     script.setAttribute('src',url);

                     document.getElementsByTagName('head')[0].appendChild(script);  
        };

         
    return {find: find,set: set,getpc: getPostalCode,setpc: setPostalCode,lookup: lookup}; 

}();