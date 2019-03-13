<?php
   include('session2.php');
?>
<html>
   <head>
              <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                }
                .header {
                    background-color: #f1f1f1;
                    padding: 20px;
                    text-align: center;
                }
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
                    
                }
               .column {
                    float: left;
                    text-align: center;
                    width: 50%;
                    padding: 20px;
                }
                img {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
            </style>

   </head>
   <body>
	<div class="header">
                <h1>Welcome <?php echo $login_session; ?></h1> 
                <h2><a href = "logout2.php">Sign Out</a></h2>
		<!--form action="view.php" method="get"-->
		<form action="viz.php" method="get">
		Choose what to view:
		<select name="response">
			<option value="log">Log</option>
			<option value="error">Error</option>
			<option value="activity">Activities</option>
			<option value="users">Users</option>
		</select><br>
		<input type="submit">
		</form>
		<?php
			if($_SESSION['admin'] == 1) {
				echo "
					<div class = 'header'>
						<form action='http://157.230.57.144:8081/backend_admin'>
    							<input type='submit' value='Manage users' />
						</form>
					</div>";
			}
		?>
	</div>


   </body>
</html>
