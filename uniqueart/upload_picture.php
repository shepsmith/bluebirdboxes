<?php

include('../config/db_connect.php');

//define variable and set to empty values
$size = $finish = $email = $unique_pic = "";

$errors = array('email'=>'', 'size'=>'','unique_pic'=>'', 'finish'=>'');

//echo "size : " . $size;
        if(isset($_POST['size'])) {
            $size_num = mysqli_real_escape_string($conn, $_POST['size']);
            switch($size_num){
                case 1: 
                    $size = "8/10";
                break;
                case 2: 
                    $size = "11/14";
                break;
                case 3: 
                    $size = "12/16";
                break;
                case 4: 
                    $size = "16/20";
                break;
                default:     
                    $size = "any-not specified";
                break;
               }
        }
        if(isset($_POST['finish'])){
            $finish_num = mysqli_real_escape_string($conn, $_POST['finish']);
            switch($finish_num){
                case 1:
                    $finish = "matte";
                break;
                case 2:
                    $finish = "satin";
                break;
                case 3:
                    $finish = "gloss";
                break;
                default:
                    $finish = "matte";
                break;
            }
        }
		if(empty($_POST['email'])) {
			$errors['email'] = 'An email is required <br/>';
		} else {
		 //echo htmlspecialchars($_POST['email']);
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'email must be a valid email address </br />';
			}
		}
    $status = $statusMsg = ''; 
    if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["unique_pic"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["unique_pic"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','JPG','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['unique_pic']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            date_default_timezone_set('US/Eastern');
            $todaysdate = date("Y-m-d H:i:s");
			$x = rand(1,999);
			//$size="8x10"; 
			//$finish="matte"; 
         
            $sql = "INSERT INTO custom_pics (email, seq, custompic, size, finish, request_date) 
			VALUES ('$email', '$x', '$imgContent', '$size', '$finish', '$todaysdate' )"; 
            $insert = mysqli_query($conn, $sql);
            $dberror = "";

			//if(!(mysqli_query($conn, $sql))) {
			//	echo 'query error on insert1a : ' . mysqli_error($conn);
			//}
            $dberror =  mysqli_error($conn);

            if(!($insert)) {
				$dberror ='query error on insert1 : ' . mysqli_error($conn);
			}
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
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