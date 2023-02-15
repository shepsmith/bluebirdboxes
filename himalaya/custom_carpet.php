<!-- clone add pizza php but always redirect back to home page 
    to improve, maybe format error in this page and have a back button to go back to home page 
-->
<?php  

	include('../config/db_connect.php');

	$email = $message = $design = '';
	$red = $green = $brown = $blue = $black = $white = $yellow = $maroon = $gold = 0;
	// do associative array instead and iterate to insert
	$colors = array();
	$errors = array('email'=>'', 'message'=>'');

	function check_color_set($color) {
		$is_color_set = 0;
		//if(!(isset($_POST['red_check']))) {
		//	return $is_color_set;
		//}
		if($color == "") {
			return $is_color_set;
		}
		if($color = "on") {
			$is_color_set = 1;
		} else {
			$is_color_set = 0;
		}
		return $is_color_set; 
	}
	echo '111';
	if (isset($_POST['submit'])) {
		 //echo htmlspecialchars($_POST['email']);
		 //echo htmlspecialchars($_POST['message']);
		if(empty($_POST['email'])) {
			$errors['email'] = 'An email is required <br/>';
		} else {
			// echo htmlspecialchars($_POST['email']);
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'email must be a valid email address </br />';
			}
		}
		echo '222';
		if(empty($_POST['message'])) {
			$errors['message'] =  'A message is required <br/>';
		} else {
			// echo htmlspecialchars($_POST['title']);
			$message = $_POST['message'];
		}		
		
		echo '333';
		if(array_filter($errors)) {
            //echo 'errors in the form';
            //echo $errors['email'];
            echo $errors['message'];
		} else {
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$message = mysqli_real_escape_string($conn, $_POST['message']);
			$i=0;
			if(isset($_POST['red_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['red_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "red";
					$i++;
				}
			}
			if(isset($_POST['blue_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['blue_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "blue";
					$i++;
				}
			}
			if(isset($_POST['brown_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['brown_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "brown";
					$i++;
				}
			}
			if(isset($_POST['black_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['black_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "black";
					$i++;
				}
			}
			if(isset($_POST['white_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['white_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "white";
					$i++;
				}
			}
			if(isset($_POST['green_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['green_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "green";
					$i++;
				}
			}
			if(isset($_POST['yellow_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['yellow_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "yellow";
					$i++;
				}
			}
			if(isset($_POST['maroon_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['maroon_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "maroon";
					$i++;
				}
			}
			if(isset($_POST['gold_check'])) {
				$test_color = mysqli_real_escape_string($conn, $_POST['gold_check']);
				if(check_color_set($test_color)) {
					$colors[$i] = "gold";
					$i++;
				}
			}
			//todo remaining colors
			
			if(isset($_POST['size'])) {
				$size = mysqli_real_escape_string($conn, $_POST['size']);
			}
			//echo "size : " . $size;
			if(isset($_POST['design'])) {
				$design_num = mysqli_real_escape_string($conn, $_POST['design']);
				switch($design_num){
					case 1: 
						$design = "den";
					break;
					case 2: 
						$design = "livingroom";
					break;
					case 3: 
						$design = "diningroom";
					break;
					case 4: 
						$design = "hall";
					break;
					default:     
						$design = "any-not specified";
					break;
				   }
			}
			//$todaysdate = date('Y/m/d');
			//$todaysdate = date("Y-m-d H:i:s");
			// STR_TO_DATE('$todaysdate', '%m/%d/%Y' )";
			$todaysdate = date("Y-m-d H:i:s");
			$status = 'error'; // default status
			$sql = "START TRANSACTION";
			if(!(mysqli_query($conn, $sql))) {
				echo 'query error on transaction : ' . mysqli_error($conn);
			}

			// INSERT INTO user_date VALUES ('', '$name', STR_TO_DATE('$todaysdate', '%m/%d/%Y'))
			// create sql assume 1 quilt per date or add sequence and check for dupes
			$x = rand(1,999);
			$sql = "INSERT INTO carpet (email, seq, message, design, request_date) 
			VALUES ('$email', '$x', '$message', '$design', '$todaysdate' )";
			if(!(mysqli_query($conn, $sql))) {
				echo 'query error on insert1 : ' . mysqli_error($conn);
			}

			// save colors use foreach 
			foreach ( $colors as $color ) {
				$sql = "INSERT INTO carpet_colors (email, seq, color, request_date)
				VALUES ('$email', '$x', '$color',  '$todaysdate' )";
				if(!(mysqli_query($conn, $sql))) {
					echo 'query error on insert2 : ' . mysqli_error($conn);
				}
			}
			$sql = "COMMIT";
			if(!(mysqli_query($conn, $sql))) {
				echo 'query error on commit : ' . mysqli_error($conn);
			} else {
				$status = 'success'; 
			}
			////header('Location: index.html');
			// echo 'thanks!';  //todo: do redirect and position at form?
		}
		// } else {
		// 	echo 'form is valid';
		// }
	}

?>
<!DOCTYPE html>
<html>


	<script>
		debugger;
			window.location.href = 'index.html?loadstatus=<?php echo $status; ?>';
		//alert("Continue???");
		//  window.location.href = 'index.html?id=#custom_pic_select';
	</script>



<html>
