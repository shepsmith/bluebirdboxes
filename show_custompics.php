<!-- clone add pizza php but always redirect back to home page 
    to improve, maybe format error in this page and have a back button to go back to home page 
-->

<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
</head>



<?php  

include('config/db_connect.php');
$sql = "select custompic, size, finish, email, request_date, seq 
  from custom_pics order by email, request_date, seq";
$result = mysqli_query($conn, $sql);
	// Get image data from database 
	//$result = $db->query("SELECT image FROM images ORDER BY uploaded DESC"); 
	//custom_pics (email, seq, custompic, size, finish, request_date) 
?>

<?php 
	if($result->num_rows > 0){ ?> 

<div class="row">
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()) { ?> 
            <div class="col s12 l12">
                <img src="data:image/jpg;charset=utf8;base64,
                    <?php echo base64_encode($row['custompic']); ?>" 
                        class="responsive-img materialboxed" width="800"/>
            </div>
            <div class="col s12 l12 offset-l1">
                <?php echo $row['finish']; ?>
                <?php echo $row['request_date']; ?>
                <?php echo $row['email']; ?>                   
                <?php echo $row['seq']; ?><br><br>
            </div>
        <?php } ?> 
    </div> 
</div>

<?php } else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>

<!DOCTYPE html>
<html>







		<h4 class="center">success2</h4>
	
	
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

	<script>
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>

<html>
