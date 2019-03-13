<html>
<head>
  <meta charset="utf-8">
  <!--Script Reference[1]-->
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
		ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>
</head>
<body>
<style>
</style>
<?php 
   if($_REQUEST["response"] == "log"){
      echo "<div id='chartDiv'></div>";
   }
?>
<script>
   <?php 
      /* Open connection to "zing_db" MySQL database. */
      // connect the database
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
         include("./config.php");
	 session_start();
	 $which = "users";

	 # The query itself.
	 if (isset($_REQUEST["response"])) {
	    $which = $_REQUEST["response"];
	    $sql = "SELECT * FROM $which;";
	 }
	 else {
	    $sql = "SELECT * FROM users;";
	 }
	 $data = mysqli_query($db, $sql);
         $count_labels = 1;
	 $count_data = 1;
      }

   ?>
   
   var arr=[<?php 
      while ($row=mysqli_fetch_row($data)){
         # Write out each row value to the table
	 foreach ($row as $rowval) {
            if(($count_data % 5) == 0)
	       echo $rowval.',';
	    $count_data++;
	 }
      }
   ?>];

   Array.prototype.unique = function() {
      return this.filter(function (value, index, self) { 
         return self.indexOf(value) === index;
      });
   }
   
   var i;
   var myData = [];
   for (i = 0; i < (arr.unique()).length; i++){
      myData.push(0);
   }
   for(i = 0; i < arr.length; i++){
      myData[arr[i]]++;
   }

   zingchart.render({
      "type": "bar",
      id: 'chartDiv',
      height: 600,
      width: 900,
      data: {
          "type": 'bar',  // Specify your chart type here.
          "title": {
             "text": 'Load Time' // Adds a title to your chart
          },
          "scaleX": {
             "label": {
                "text": 'load time in seconds',
             }
          },
          "scaleY": {
             "label": {
                "text": 'numbers of each load time',
             }
          },
          // "scale-x":{"values": myLabels},
          "series": [  // Insert your series data here.
             {"values": myData}
          ]
      }
   });

   /*zingchart.render({
      "type":"ring",
      id: 'pieDiv',
      "title":{
         "text":"Pie Chart"
      },
      "series":[
         {"values":[59]},
         {"values":[15]}
      ]
  });*/
  
  </script>
</body>
</html>
