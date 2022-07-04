<?php
require_once("config/dbconnection.php");

if(isset($_POST["saveForm"]) ){
	
	if($_POST["username"]!=""&&$_POST["first_name"]!=""&&$_POST["last_name"]!=""&&$_POST["email"]!=""){
		
		//$sqlQuery 			=	sprintf("INSERT INTO `ajay_users` (`username`, `firstName`, `lastName`, `email`, `status`, `created_at`, `modefied_at`) VALUES (%s,%s,%s,%s, '1', CURRENT_DATE(), CURRENT_TIME())",$_POST["username"],$_POST["first_name"] ,$_POST["last_name"], $_POST["email"]);
		
		echo $sqlQuery 			=	"INSERT INTO ajay_users  set username='".$_POST['username']."', firstName ='".$_POST['first_name']."', lastName='".$_POST['last_name']."',email='".$_POST['email']."',created_at='".date('Y-m-d')."'";
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
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>

</head>
<body>

<div class="container-fluid">
 
  <div class="row">
	<div class="col-sm-3">Logo </div>
	<div class="col-sm-9"> Header2 </div>
 </div>
 <hr />
 <div class="row">
	<?php include("includes/left_nav.php"); ?>
   
   <div class="col-sm-9"> <!--  right Body -->
<div class="col-sm-9">
<br>
  <form action="add_new_user.php" id="userForm" method="POST">
  <div class="form-control">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-6">
        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
		<span id="errorUsername"></span>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">First Name</label>
      <div class="col-sm-6">
        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
		<span id="errorFirstName"></span>
      </div>
    </div>
	<div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
      <div class="col-sm-6">
        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
		<span id="errorLastName"></span>
      </div>
    </div>
	<div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-6">
        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
		<span id="errorEmail"></span>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-8">
	   <input type="hidden"  name="saveForm"  value="ok">
        <button type="submit" name="submit" id="saveForm" class="btn btn-primary">Add User</button>
      </div>
    </div>
  </form>
  </div>
</div>  
 
 <!--  End right Body -->
 </div>

  
  
 </div>

	<script src="js/jquery-3.2.1.slim.min.js" ></script>
	<script src="js/popper.min.js"></script>
	<script>
/*	function validateEmail(sEmail) {
		alert(sEmail);
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}​
*/

	 $(function(){
	  
			$("#saveForm").click(function(){
				
				var username		=	$('#username').val();
				var first_name		=	$('#first_name').val();
				var last_name		=	$('#last_name').val();
				var email		    =	$('#email').val();
		        var flag			=   true;
				
				if(username==''){
					//alert("Please enter username.");
					$('#errorUsername').text("please enter username");
					flag = false;
				}
				else { $('#errorUsername').text("");}

				if(first_name==''){
					$('#errorFirstName').text("please enter your first name");
					flag = false;
				}
				else{$('#errorFirstName').text("");}
				
				if(last_name==''){
					$('#errorLastName').text("please enter your last name");
					flag = false;
				}
				
				else{$('#errorLastName').text("");}
				
				if(email==''){
					
					$('#errorEmail').text("please enter your email");
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












