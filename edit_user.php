<?php
require_once("config/dbconnection.php");
$connection			= 		mysqli_connect("localhost","root","","ajay");
if(isset($_GET['id'])){
$id					=		mysqli_real_escape_string($connection, $_GET['id']);
}
$userInfo="";
 
 
 if(isset($_POST["saveForm"])&&isset($_GET['id'])){
	 //escape input strings
 	$username		=		mysqli_real_escape_string($connection, $_POST["username"]);
	$firstName		=		mysqli_real_escape_string($connection, $_POST["firstName"]);
	$lastName		=		mysqli_real_escape_string($connection, $_POST["lastName"]);
	$email			=		mysqli_real_escape_string($connection, $_POST["email"]);
	$status			=		mysqli_real_escape_string($connection, $_POST["status"]);
	
	$sqlquery2		=		"UPDATE ajay_users SET username='".$username."', firstName='".$firstName."', lastName='".$lastName."', email='".$email."',  status='".$status."' WHERE id='".$id."' ";
	
	if(mysqli_query($connection, $sqlquery2)){
		header('Location:user_management.php?act=success&m=edit');
	}
	else{die("Could not Update User Info");}

	}

 
if(isset($_GET['id'])){
	
if($connection){
		$sqlquery	=		"SELECT * FROM ajay_users WHERE id='".$id."' ";
		$result		=		mysqli_query($connection,$sqlquery);
		if($result){
				$userInfo	=		mysqli_fetch_assoc($result);
		}
		
		else{die("could not query database");}
		
    }
else{die("could not connect to database");}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>

</head>
<body>
<?php  include("includes/header.php");?>
<div class="container-fluid">
 <br>
 <div class="row">
      <?php include("includes/left_nav.php"); ?>
	  <div class="col-sm-9" style="background-color:white;">
	  <div class="row">
		<div class="col-sm-1" style="background-color:white;">
		</div>
		<div class="col-sm-8" style="background-color:white;">
			<div class="form-control">
				<form id="editForm" action="edit_user.php?id=<?php if(isset($_GET['id'])) echo htmlspecialchars($_GET['id']); ?>" method="POST" >
					<div class="form-group row">
					    <label for="username" class="col-sm-3 col-form-label" style="">Username:</label>
						<div class="col-sm-9">
							<input type="text" id="username" name="username" class="form-control" value = "<?php  if(isset($_GET['id'])) echo $userInfo['username'] ?>" >
							<span id="error_username" style="color:red" ></span>
						</div>
					</div>
					
					<div class="form-group row">
					    <label for="firstName" class="col-sm-3 col-form-label" style="">First Name:</label>
						<div class="col-sm-9">
							<input type="text" id="firstName" name="firstName" class="form-control" value = "<?php if(isset($_GET['id'])) echo $userInfo['firstName'] ?>">
							<span id="error_firstName" style="color:red"></span>
						</div>
					</div>
					<div class="form-group row">
					    <label for="lastName" class="col-sm-3 col-form-label" style="" >Last Name:</label>
						<div class="col-sm-9">
							<input type="text" id="lastName" name="lastName" class="form-control" value = "<?php if(isset($_GET['id'])) echo $userInfo['lastName'] ?>">
							<span id="error_lastName" style="color:red"></span>
						</div>
					</div>
					<div class="form-group row">
					    <label for="email" class="col-sm-3 col-form-label" style="" >Email:</label>
						<div class="col-sm-9">
							<input type="email" id="email" name="email" class="form-control" value = "<?php if(isset($_GET['id'])) echo $userInfo['email'] ?>">
							<span id="error_email" style="color:red"></span>
						</div>
					</div>
					<div class="form-group row">
					    <label for="status" class="col-sm-3 col-form-label" style="" >Status:</label>
						<div class="col-sm-9">
							<input type="text" id="status" name="status" class="form-control" value = "<?php if(isset($_GET['id'])) echo $userInfo['status'] ?>">
							<span id="error_email" style="color:red"></span>
						</div>
					</div>
					<input type="hidden" name="saveForm" value="ok">
					<br><hr color="blue">
					<div class="row">
					<div class="col-sm-4" ></div>
					<div class="col-sm-4" style="background-color:white">
						<button type="submit" id="submitBtn" class="form-control btn btn-primary"><b>UPDATE</b></button>
					</div>
					<div class="col-sm-4" ></div>
					</div>
					
				</form>
			</div>
		</div>
		<div class="col-sm-3" style="background-color:white;">
		</div>
	  </div>
	  </div>
  </div>

  
  
 </div>

	<script src="js/jquery-3.2.1.slim.min.js" ></script>
	<script src="js/popper.min.js"></script>
	<script>
		$(function(){
			var username		=		$('#username').val();
			var lastName		=		$('#lastName').val();
			var firstName		=		$('#firstName').val();
			var email			=		$('#email').val();
			var error_flag		=		false;
			
			$('#submitBtn').click(function(){
				if(username == ""){
					$('#error_username').text("username is required");
					error_flag	=	true;
				}
				else{$('#error_username').text("");}
				
				if(firstName == ""){
					$('#error_firstName').text("Last Name is required");
					error_flag	=	true;
				}
				else{$('#error_firstName').text("");}
				
				if(lastName == ""){
					$('#error_lastName').text("First Name is required");
					error_flag	=	true;
				}
				else{$('#error_lastName').text("");}
				
				if(email==""){
					$('#error_email').text("please provide a email");
					$error_flag	=	true;
				}
				else{$('#error_email').text("");}
				
				if(error_flag){
					return false;
					}
			});
		});
	</script>

</body>
</html>






