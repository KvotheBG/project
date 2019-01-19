<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lights</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div>
	<h1>LIGHTS</h1>
	<p>Pick the number of lights:</p>
	<form method="get" action="lights.php">
		<input type="number" name="num_lights" placeholder="lights" required>
		<p></p>
		<input type="submit" name="submit" value="NEXT STEP" class="button">
	</form>
	</div>
</body>
</html>