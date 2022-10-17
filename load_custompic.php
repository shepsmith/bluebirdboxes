<!-- clone add pizza php but always redirect back to home page 
    to improve, maybe format error in this page and have a back button to go back to home page 
-->
<?php  

	include('config/db_connect.php');

	$email = $question = $mailinglist = '';
	$errors = array('email'=>'', 'message'=>'');

	$status = $statusMsg = ''; 
	$status = 'fail';
	if (isset($_POST['submit'])) {
		$status = 'error'; 
		// Get file info 
		$fileName = basename($_FILES["custompic"]["name"]); 
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['custompic']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
			$todaysdate = date("Y-m-d H:i:s");
			$x = rand(1,999);
			$size="8x10"; // todo
			$finish="matte"; // todo
			$email="xyz@yahoo.com";
            // Insert image content into database 
            //$insert = $db->query("INSERT into custom_pics (custompic, uploaded) VALUES ('$imgContent', NOW())"); 
			$sql = "INSERT INTO custom_pics (email, seq, custompic, size, finish, request_date) 
			VALUES ('$email', '$x', '$imgContent', '$size', '$finish', '$todaysdate' )"; 
			$insert = mysqli_query($conn, $sql);
			if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
				$dberror = '';

				if (mysqli_errno($conn)) {
					$dberror = "MySQL error ".mysqli_errno($conn).": ".mysqli_error($conn)."\n<br>When executing:<br>\n$sql\n<br>";
				}

				echo $dberror;
				//$statusMsg = "File upload failed, please try again. DB error: ".$dberror;
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
	} 
	echo $statusMsg;


	// 	 echo htmlspecialchars($_POST['email']);
	// 	 echo htmlspecialchars($_POST['message']);
	// 	 echo htmlspecialchars($_POST['mailinglist']);# code...
	// 	if(empty($_POST['email'])) {
	// 		$errors['email'] = 'An email is required <br/>';
	// 	} else {
	// 		// echo htmlspecialchars($_POST['email']);
	// 		$email = $_POST['email'];
	// 		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	// 			$errors['email'] = 'email must be a valid email address </br />';
	// 		}
	// 	}
	// 	if(empty($_POST['message'])) {
	// 		$errors['message'] =  'A message is required <br/>';
	// 	} else {
	// 		// echo htmlspecialchars($_POST['title']);
	// 		$message = $_POST['message'];
	// 	}		
		

	// 	if(array_filter($errors)) {
    //         echo 'errors in the form';
    //         echo $errors['email'];
    //         echo $errors['message'];
	// 	} else {
	// 		$email = mysqli_real_escape_string($conn, $_POST['email']);
	// 		$message = mysqli_real_escape_string($conn, $_POST['message']);
    //         $test_mailinglist = mysqli_real_escape_string($conn, $_POST['mailinglist']);
    //         if($test_mailinglist = "on") {
    //             $mailinglist = 1;
    //         } else {
    //             $mailinglist = 0;
    //         }

	// 		$today = date("Y-m-d H:i:s");
	// 		// create sql
	// 		$sql = "INSERT INTO inquiry (email, message, mailinglist, date) 
	// 				VALUES ('$email', '$message', '$mailinglist', '$today')";
	// 		// save to database
	// 		if(mysqli_query($conn, $sql)) {
	// 			// success - redirect to index page
	// 			header('Location: index.html');
	// 		} else {
	// 			// error
	// 			echo 'query error on insert : ' . mysqli_error($conn);
	// 		}

	// 	}
	// 	// } else {
	// 	// 	echo 'form is valid';
	// 	// }
	// }

?>
<!DOCTYPE html>
<html>

		<h4 class="center">success</h4>
		<script>
				  //window.location.href = 'load_custompic_success.html';
				  window.location.href = 'uniqueart/index.html?loadstatus=<?php echo $status ?>';
				  //window.location.href = 'uniqueart/index.html#custom_pic_select';

		</script>

<html>

<?php 
//	header('Location: materialize_file.html'); // back to materialize file upload page
//<script>
//window.location.href = 'http://www.yourwebsite.com';
//</script>
?>

