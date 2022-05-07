<?php require('components/htmlhead.inc.php'); ?>
<?php

if(!empty($_POST["username"]) && !empty($_POST["password"])) {
	
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$cleardb_server = $cleardb_url["host"];
	$cleardb_username = $cleardb_url["user"];
	$cleardb_password = $cleardb_url["pass"];
	$cleardb_db = substr($cleardb_url["path"],1);
	$active_group = 'default';
	$query_builder = TRUE;
	// Connect to DB
	$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
	if($conn->connect_error) {
		die("Connection failed!".$conn->connect_error);
	}
 
	$username = $_POST["username"];
	$statement = "SELECT * FROM user WHERE username=?";
	$stmt = $conn->prepare($statement);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows<1) {
		$conn->close();
		$value = "invalid";
		header("Location:login.php?credentials=$value");
	}

	$row = $result->fetch_assoc();
	$hash = $row["password"]; 

	if(password_verify($_POST["password"], $hash)) {
		echo "Successful login";
		session_start();
		$_SESSION["username"] = $_POST["username"];
		$conn->close();
		header("Location: display_items.php");
	} else {
		$conn->close();
		$value = "invalid";
		header("Location:login.php?credentials=$value");
	}/*verifies if user has entered correct password*/

} else {
	header("Location:login.php");
} /*verify user not directly accessing this page */

?>
<?php require('components/htmlfoot.inc.php'); ?>