<?php
// local connection - if uploaded, just edit this file in host editor
		$conn = mysqli_connect('localhost','shep','1234','bluebirdboxes');
//echo '111';
		// check connection
		if(!$conn){
			echo 'Connection error: ' . mysqli_connect_error();
		}
//echo '112';
// host site connection
	//$conn = mysqli_connect('localhost','billship_shep','q!!NQ~WAsw^5','billship_bluebirdboxes');

	// check connection
	//if(!$conn){
	//	echo 'Connection error: ' . mysqli_connect_error();
	//}


	// help desk gave this, do not use, original way above works!
	//$servername = "localhost";
    //$username = "billship_shep";
    //$password = "q!!NQ~WAsw^5";
    //$dbname = "billship_bluebirdboxes";
    //$conn = new mysqli($servername, $username, $password, $dbname);
?>