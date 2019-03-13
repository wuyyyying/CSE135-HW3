<?php
	include("../config.php");
	session_start();
	$entityBody = file_get_contents('php://input');
	$data = json_decode($entityBody, true);
	$email = $_SESSION['login_user'];
	$message = $data["Message"];
	$url = $data["Url"];
	$line = $data["Line"];
	$rate = 0;
	$sql = "REPLACE INTO error
		(email, error_rate, message, url, line)
		VALUES
		('$email',
	 	 '$rate',
		 '$message',
	 	 '$url',
	 	 '$line'
		);";

 	echo "<p>$sql</p>";
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
