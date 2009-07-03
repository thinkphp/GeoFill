<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>GeoFill - a JavaScript wrapper to fill automatically form with geo information either from IP or Postcode</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">

  html,body {background:#666;}

  h1,h2,h3 {font-family:Calibri,sans-serif;}

  h1 {font-size:200%;margin:0 0 10px 0;color:#fff;}

  #ft{ color:#ccc;margin: 4px}

  #ft a { color:#ccc;}

  #bd{background:#fff;border:1em solid #fff;}

  pre {border:1px solid #999;padding:5px;background:#eee;width: 450px}

  form div{ overflow:hidden; }

  label{float:left; width:5em;}
 
  form div { padding-top:.5em;padding-left: 10px;}

  fieldset{margin-left: 100px}

  strong {font-weight: bold}

  a{color: #c9c}

  #suggest {background: #FFF971;padding: 10px;color: #000;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;}

  .example{font-style: oblique}

  </style>
</head>
<body>

<div id="doc" class="yui-t7">

   <div id="hd" role="banner"><h1>GeoFill - JavaScript wrapper to fill automatically form with geo information either from IP or Postcode</h1></div>

   <div id="bd" role="main">

	<div class="yui-g">

<?php
                    $menu = array("ip"=>"Get Geo Information From IP","postcode"=>"Get Geo Information From Postcode","searchButton"=>"Provided a button to get Geo Information","postcodearg"=>"Get Geo Data from Postcode provided as argument");  

                    echo"<ul id='menu'>";

                    foreach(array_keys($menu) as $k) {

                            if($_GET['id'] === $k) {

                                   echo"<li><strong>".$menu[$k]."</strong></li>";

                            } else {

                                    echo"<li><a href=\"index.php?id=".$k."\">".$menu[$k]."</a></li>";  
                            }
                    }

                    echo"</ul>";
?>

	</div>

<div class="yui-g">

    <div class="yui-u first">

<?php
         if(isset($_GET['id'])) {

                  if($_GET['id'] === 'ip') {

                          $file = 'ip.js';

                          $content = file_get_contents($file);

                          echo"<pre>".htmlspecialchars($content)."</pre>"; 
                       

                  } else if($_GET['id'] === 'postcode') {

                          $file = 'postcode.js';

                          $content = file_get_contents($file);

                          echo"<pre>".htmlspecialchars($content)."</pre>"; 

                  } else if($_GET['id'] === 'searchButton') {

                          $file = 'searchButton.js';

                          $content = file_get_contents($file);

                          echo"<pre>".htmlspecialchars($content)."</pre>";

                  } else if($_GET['id'] === 'postcodearg') {

                          $file = 'postcodeArg.js';

                          $content = file_get_contents($file);

                          echo"<pre>".htmlspecialchars($content)."</pre>";
                  }

         }//endif
?>




    </div>

    <div class="yui-u">

          <form action="#" method="get" accept-charset="utf-8">

             <fieldset><legend id="address">Address</legend>
             <div>
               <label for="usercity">City:</label>

               <input type="text" name="usercity" value="" id="usercity">
             </div>
             <div>
               <label for="usercountry">Country:</label>
               <input type="text" name="usercountry" value="" id="usercountry">
             </div>
             <div>
               <label for="userpostcode">Postcode:</label>

               <input type="text" name="userpostcode" value="" id="userpostcode">
             </div>
             <div>
               <label for="userlat">Latitude:</label>
               <input type="text" name="userlat" value="" id="userlat">
             </div>
             <div>
               <label for="userlon">Longitude:</label>

               <input type="text" name="userlon" value="" id="userlon">
             </div>
             </fieldset>

          </form>


    </div>

</div><!-- end yui-g -->

        <div class="yui-g">

             <p><a href="geofill.js">GeoFill</a> is a JavaScript wrapper that simply you embeded in your document and has 2 methods for you to user:</p>

             <p><strong>geofill.find ( properties ) </strong> - does an IP lookup of the current user and tries to get the geograpfical info from that one.</p>

             <p><strong>geofill.lookup ( properties, postcode ) </strong> - tries to get the geographical info from the <strong>postcode</strong> provided in your form (postcode is optional)</p>

             <p>For each method the properties are the same, a list of the IDs of  your form fields and o callback method.</p>

             <p class="example">For example if you want to use lookup and fill only the city, all you need to is:</p>

<pre>
geofill.lookup(
  {
     city: 'usercity',

     postcode: 'userpostcode'
  }
);
</pre>

             <p class="example">usercity and userpostcode are IDs in your form. geofill return always city, country, postcode, latitude and longitude</p>

             <p class="example">The callback method allows you to deal with errors and re-use the information in case you don`t want to make GeoFill access your form automatically. This way you can catch the error case:</p>


<pre>
geofill.lookup(
  {
     city: 'usercity',

     postcode: 'userpostcode',

     callback: function(o) {
 
               if(o.error) {

                    pc.value = 'Invalide postcode';

               } else { 

                    //do something
               }
     }   
  }
);
</pre>                                      

             <p class="example">Or you can skip the automatic access of your form fields</p>

<pre>
geofill.find(
  {

     callback: function(o) {

               //do something with o
     }
  }
);
</pre>                                      

	</div>

             <p class="example">The method lookup also take a second paramenter in case you don`t want to use any form:</p>

<pre>
geofill.lookup(
  {
  callback: function(o){

      console.log(o);
  }          
  },'0300');
</pre>                                      

   </div><!--end main -->

   <div id="ft" role="contentinfo"><p>Written by <a href="http://thinkphp.ro">Adrian Statescu.</a> Using Lerdorf Rasmus`s GeoIP, geo.places and YUI for Layout</p></div>

</div><!-- end doc -->

<script type="text/javascript" src="geofill.js"></script>

<?php if(isset($file)) { ?>
<script type="text/javascript" charset="utf-8" src="<?php echo$file; ?>"></script>
<?php  }  ?>
</body>
</html>
