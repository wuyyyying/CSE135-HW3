<html>
<body>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<?php
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
	$column_query = "SELECT column_name
		FROM information_schema.columns
		WHERE table_name = '$which'
		AND table_schema = 'analytics'";
	$columns = mysqli_query($db, $column_query);
	$result = mysqli_query($db, $sql);

	# Write the output to a table.
	echo "<table style='width:70%'>";
	echo "<tr>";
	while ($row=mysqli_fetch_row($columns))
	{
	    # Write out each row value to the table
	    foreach ($row as $rowval) {
		echo "<th>";
		echo "$rowval";
		echo "</th>";
	    }
	}
	echo "</tr>";
	while ($row=mysqli_fetch_row($result))
	    {
	    echo "<tr>";
	    # Write out each row value to the table
	    foreach ($row as $rowval) {
		echo "<th>";
		echo "$rowval";
		echo "</th>";
	    }
	    echo "</tr>";
	    }
	echo "</table>";
}
?>

</body>
</html>
