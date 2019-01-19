<?php
session_start();

// THE ARRAY [DISTANCE , TIME]>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$road_map=[];

for ($i=0; $i < $_SESSION['num_lights']; $i++) { 
	$road_map[$i][0]=$_GET["distance_$i"];
	$road_map[$i][1]=$_GET["time_$i"];
}
$time="";
$round="";

// THIS IS NUMBER FOR LIGHT POSITION CHECK>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$x=$road_map[0][0]/$road_map[0][1];

// WE NEED (x) TO BE ROUND ON UP>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$round_x= ceil ($x);
// LIGHT ONE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
if ($road_map[0][0]<$road_map[0][1]) {
	$pass=$road_map[0][0];
}else {
	if ($road_map[0][0]==$road_map[0][1]) {
		$pass=(($round_x)+1)*$road_map[0][1];

		// THIS IS WHEN THE LIGHT IS RED >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	}elseif ($round_x%2==0){
		$pass=$round_x*$road_map[0][1];
	}else {

		// THIS IS WHEN THE LIGHT JUST TURN RED >>>>>>>>>>>>>>>>>>>>>>>>>>
		if (($road_map[0][1]*$round_x)==$road_map[0][0]) {
			$pass=(($round_x)+1)*$road_map[0][1];
		}else {
			$pass=$road_map[0][0];
		}
	}
}
// ALL LIGHT AFTER THE FIRST ONE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
for ($i=1; $i < $_SESSION['num_lights']; $i++) { 

	// HERE (time_$i) IS THE TIME THAT U GO TO THE NEXT LIGHT.
	// CALCULATION: (THE TIME THAT WE PASS LIGHT 1 + THE DISTANCE FROM LIGHT 1 TO LIGHT 2).

	$time=($road_map[$i][0]-$road_map[$i-1][0])+$pass;                  

	$x=$time/$road_map[$i][1];
	$round= ceil ($x);

	if ($time<$road_map[$i][1]) {
		$pass=$time;
	}else {
		if ($time==$road_map[$i][1]) {
			$pass=(($round)+1)*$road_map[$i][1];
		}elseif ($round%2==0){
			$pass=$round*$road_map[$i][1];
		}else {
			if (($road_map[$i][1]*$round)==$time) {
				$pass=(($round)+1)*$road_map[$i][1];
			}else {
			$pass=$time;
			}
		}
	}
}

// HERE WE USE "FOR" TO SEE IF THE DISTANCE GROW>>>>>>>>>>>>>>>>>>>>>>>>>>
for ($i=0; $i < $_SESSION['num_lights']; $i++) { 
	// IF THE NUMBER OF LIGHTS IS ONE>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	if (($_SESSION['num_lights'])==1) {
		$answer= "You pass for :";
		$answer2=$pass." sec";
		$again="<a href='index.php'>AGAIN</a>";
	} else {
		if ($i!=0) {
			// CHECK IF THE DISTANCE DONT GROW>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			if (($road_map[$i][0])<($road_map[$i-1][0])) {
				$answer= "The distance for each trafic light must grow";
				$answer2="<a href='index.php'>BACK</a>";
				$again="";
			} else {
			// HERE THE DISTANCE GROW>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
				$answer= "You pass for :";
				$answer2=$pass." sec";
				$again="<a href='index.php'>AGAIN</a>";
			}
		}
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
	<p><?php echo $answer ?></p>
	<p><?php echo $answer2 ?></p>
	<p><?php echo $again ?></p>
	</div>
</body>
</html>