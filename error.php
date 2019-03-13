      <?php
         if (isset($_GET["click"])){ 
         echo "clicking";
         echo "<script language='javascript'> 
                 window.printme();
                 window.onerror = function() {
		 navigator.sendBeacon('./api/log', 'DATA');
		 }
              </script>";}
      ?>
