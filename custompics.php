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
$pics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	// Get image data from database 
	//$result = $db->query("SELECT image FROM images ORDER BY uploaded DESC"); 
    //custom_pics (email, seq, custompic, size, finish, request_date) 
    





?>

<!DOCTYPE html>
<html>
    <div class="container">
        <div class="row">

                <?php foreach($pics as $pic){ ?>


 




                        
                    <div class="card z-depth-0 center" >
                        <div class="col l3"><br><br>
                            <?php echo ($pic['size']); ?>
                        </div>
                        <div class="col l3"><br><br>
                            <?php echo ($pic['email']); ?>
                        </div>
                        <div class="col l3"><br><br>
                            <?php echo ($pic['seq']); ?>
                        </div>
                        <div class="col l6">
                            <div class="card-content ">
                                <img height='50px' src="data:image/jpg;charset=utf8;base64, 
                                <?php echo base64_encode($pic['custompic']); ?>" 
                                    class="responsive-img materialboxed">
                                <!--<img src="img/amish1.jpg" alt="" class="responsive-img materialboxed"> -->
                            </div>
                        </div>
                    </div>



                <?php } ?>

        </div>
    </div>


	
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

	<script>
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>

<html>
