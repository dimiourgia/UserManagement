<?php
require_once("config/dbconnection.php");

if(isset($_POST["saveForm"]) ){
	echo "here";
	if($_POST["username"]!=""&&$_POST["firstName"]!=""&&$_POST["lastName"]!=""&&$_POST["email"]!=""){
		
		//$sqlQuery 			=	sprintf("INSERT INTO `ajay_users` (`username`, `firstName`, `lastName`, `email`, `status`, `created_at`, `modefied_at`) VALUES (%s,%s,%s,%s, '1', CURRENT_DATE(), CURRENT_TIME())",$_POST["username"],$_POST["first_name"] ,$_POST["last_name"], $_POST["email"]);
		//escape input string
		$username				=	mysqli_real_escape_string($connection, $_POST['username']);
		$firstName				=	mysqli_real_escape_string($connection, $_POST['firstName']);
		$lastName				=	mysqli_real_escape_string($connection, $_POST['lastName']);
		$email					=	mysqli_real_escape_string($connection, $_POST['email']);
		
		$sqlQuery 			=	"INSERT INTO ajay_users  set username='".$username."', firstName ='".$firstName."', lastName='".$lastName."',email='".$email."',created_at='".date('Y-m-d')."'";
		$executeQuery		=	mysqli_query($connection, $sqlQuery);
		
        if($executeQuery) echo "user added";
		else die("can not query database");
		 
	 }
	 else echo "please fill all entries";
 }

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>

</head>
<body>
<?php include("includes/header.php");?>
<br>
<div class="container-fluid"
 <br>
 <div class="row">
	<?php include("includes/left_nav.php"); ?>
   
   <div class="col-sm-9"> <!--  right Body -->
   <div class="row">
		<div class="col-sm-1" style="background-color:white;">
		</div>
		<div class="col-sm-8" style="background-color:white;">
			<div class="form-control">
				<form id="editForm" action="add_new_user.php" method="POST" >
					<div class="form-group row">
					    <label for="username" class="col-sm-3 col-form-label" style="">Username:</label>
						<div class="col-sm-9">
							<input type="text" id="username" name="username" placeholder="username" class="form-control">
							<span id="error_username" style="color:red" ></span>
						</div>
					</div>
					
					<div class="form-group row">
					    <label for="firstName" class="col-sm-3 col-form-label" style="">First Name:</label>
						<div class="col-sm-9">
							<input type="text" id="firstName" name="firstName" class="form-control">
							<span id="error_firstName" style="color:red"></span>
						</div>
					</div>
					<div class="form-group row">
					    <label for="lastName" class="col-sm-3 col-form-label" style="">Last Name:</label>
						<div class="col-sm-9">
							<input type="text" id="lastName" name="lastName" class="form-control">
							<span id="error_lastName" style="color:red"></span>
						</div>
					</div>
					<div class="form-group row">
					    <label for="email" class="col-sm-3 col-form-label" style="">Email:</label>
						<div class="col-sm-9">
							<input type="text" id="email" name="email" class="form-control">
							<span id="error_email" style="color:red"></span>
						</div>
					</div>
					<input type="hidden" name="saveForm" value="ok">
					<br><hr color="blue">
					<div class="row">
					<div class="col-sm-4" ></div>
					<div class="col-sm-4" style="background-color:white">
						<button type="submit" id="submitBtn"  class="form-control btn btn-primary"><b>ADD USER</b></button>
					</div>
					<div class="col-sm-4" ></div>
					</div>
					
				</form>
			</div>
		</div>
		<div class="col-sm-2" style="background-color:white;">
		</div>
	  </div>
	  </div>
   </div> <!--  End right Body -->
</div>
  
  
 </div>

	<script src="js/jquery-3.2.1.slim.min.js" ></script>
	<script src="js/popper.min.js"></script>
	<script>
	 $(function(){
	  
			$("#submitBtn").click(function(){
				
				var username		=	$('#username').val();
				var first_name		=	$('#firstName').val();
				var last_name		=	$('#lastName').val();
				var email		    =	$('#email').val();
		        var flag			=   true;
				
				if(username==''){
					//alert("Please enter username.");
					$('#error_username').text("please enter username");
					flag = false;
				}
				else { $('#error_username').text("");}

				if(first_name==''){
					$('#error_firstName').text("please enter your first name");
					flag = false;
				}
				else{$('#error_firstName').text("");}
				
				if(last_name==''){
					$('#error_lastName').text("please enter your last name");
					flag = false;
				}
				
				else{$('#error_lastName').text("");}
				
				if(email==''){
					
					$('#error_email').text("please enter your email");
					flag = false;
				}
				
				if(!flag){
					return false;
				}
				
			   
			});
		
		});
	
	</script>
	

</body>
</html>












