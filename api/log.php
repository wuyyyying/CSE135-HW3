<?php
	include("../config.php");
//	session_start();
	$entityBody = file_get_contents('php://input');
	$data = json_decode($entityBody, true);
	//file_put_contents('sample.txt', $data);
//	$email = $_SESSION['login_user'];
	$device = $data["Device"];
	$browser = $data["Browser"];
	$height = $data["Height"];
	$width = $data["Width"];
	$load_time = $data["Duration"];
	$sql = "INSERT INTO log
		(device, browser, screen_width, screen_height, load_time)
		VALUES
		('$device',
		 '$browser',
		 '$width',
	 	 '$height',
	 	 '$load_time'
		)";

	$result = mysqli_query($db, $sql);

	# If we executed correctly then output it, if not give the error.
	if ($result === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $db->error;
	}

	// Free result set
	// mysqli_free_result($result);
?> 
