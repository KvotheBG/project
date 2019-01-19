<?php
session_start();

$num_lights=$_GET["num_lights"];
$_SESSION['num_lights']=$num_lights;

// FUNCTION THAT MAKE THE NUMBER OF LIGHTS>>>>>>>>>>>>>>>>>>>>>>

function make_lights_number($num_lights) {
	// CHECK IF THE NUMBER IS NEGATIVE>>>>>>>>>>>>>>>>>>>>>>>>>>
	if ($num_lights<0) {
		echo "Pick positive number";
	} else {
		echo "<p>Pick the distance and the frequency</p>";
		echo "<form method='get' action='end.php'>";
			// CRATE INPUT FORM FOR THE LIGHTS>>>>>>>>>>>>>>>>>>
			for ($i=0; $i < $num_lights; $i++) { 
				echo "<p>Distance ".($i+1).": <input type='number' name='distance_$i' placeholder='metre' required>";
				echo 	  "  time: <input type='number' name='time_$i' placeholder='second' required></p>";
			}
			echo "<input type='submit' name='submit' value='Go'>";
		echo "</form>";
	}
}
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
	<?php make_lights_number($num_lights); ?>
	</div>
</body>
</html>