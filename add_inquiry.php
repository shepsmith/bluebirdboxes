<!-- clone add pizza php but always redirect back to home page 
    to improve, maybe format error in this page and have a back button to go back to home page 
-->
<?php  

	include('config/db_connect.php');

	$email = $question = $mailinglist = '';
	$errors = array('email'=>'', 'message'=>'');

	if (isset($_POST['submit'])) {
		 echo htmlspecialchars($_POST['email']);
		 echo htmlspecialchars($_POST['message']);
		 echo htmlspecialchars($_POST['mailinglist']);# code...
		if(empty($_POST['email'])) {
			$errors['email'] = 'An email is required <br/>';
		} else {
			// echo htmlspecialchars($_POST['email']);
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'email must be a valid email address </br />';
			}
		}
		if(empty($_POST['message'])) {
			$errors['message'] =  'A message is required <br/>';
		} else {
			// echo htmlspecialchars($_POST['title']);
			$message = $_POST['message'];
		}		
		

		if(array_filter($errors)) {
            echo 'errors in the form';
            echo $errors['email'];
            echo $errors['message'];
		} else {
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$message = mysqli_real_escape_string($conn, $_POST['message']);
            $test_mailinglist = mysqli_real_escape_string($conn, $_POST['mailinglist']);
            if($test_mailinglist = "on") {
                $mailinglist = 1;
            } else {
                $mailinglist = 0;
            }

			$today = date("Y-m-d H:i:s");
			// create sql
			$sql = "INSERT INTO inquiry (email, message, mailinglist, date) 
					VALUES ('$email', '$message', '$mailinglist', '$today')";
			// save to database
			if(mysqli_query($conn, $sql)) {
				// success - redirect to index page
				header('Location: index.html');
			} else {
				// error
				echo 'query error on insert : ' . mysqli_error($conn);
			}

		}
		// } else {
		// 	echo 'form is valid';
		// }
	}

?>
<!DOCTYPE html>
<html>


		<h4 class="center">error page</h4>



<html>
