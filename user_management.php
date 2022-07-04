<?php
require_once("config/dbconnection.php");
$sqlQuery 			=	"SELECT * FROM `ajay_users`";
$executeQuery		=	mysqli_query($connection, $sqlQuery);




if(isset($_GET['m']) && $_GET['m']=='delete'){

	if(isset($_GET["id"])){

		$id				=	htmlspecialchars($_GET["id"]);
		$deleteQuery	= 	"DELETE FROM ajay_users WHERE ajay_users.id='".$id."'";

		if(mysqli_query($connection, $deleteQuery)){	
		  
		  header("Location:user_management.php?act=success&m=delete");
		
		}
	}

}


if(isset($_GET['m']) && $_GET['m']=='inactivate'){

	if(isset($_GET["id"])){

		$id				=	htmlspecialchars($_GET["id"]);
		
		$Query	= 	"UPDATE ajay_users SET status=0 WHERE ajay_users.id='".$id."'";

		if(mysqli_query($connection, $Query)){	
		  
		  header("Location:user_management.php?act=success&m=inactivate");
		
		}
		else die("error");
		
	}

}



if(isset($_GET['m']) && $_GET['m']=='activate'){

	if(isset($_GET["id"])){

		$id				=	htmlspecialchars($_GET["id"]);
		
		$Query	= 	"UPDATE ajay_users SET status=1 WHERE ajay_users.id='".$id."'";

		if(mysqli_query($connection, $Query)){	
		  
		  header("Location:user_management.php?act=success&m=activate");
		
		}
		
		else die("error");
		
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <script src="js/bootstrap.min.js"></script>
  
</head>
<body>

<?php include("includes/header.php");?>
<div class="container-fluid">
 <br>
 <div class="row">
	<?php include("includes/left_nav.php"); ?>
   
   <div class="col-sm-9"> <!--  right Body -->
	
	
	<div class="row"  >
	<div class="col-sm-4"><h2>Manage User</h2></div>
	<div class="col-sm-8 pull-right" > <a href="add_new_user.php" class="btn btn-primary">Add New</a></div>
	</div>
	
	<div class="row">
	<?php if(isset($_GET['act'])&&$_GET['act']=="success"){
			$method = $_GET['m'];
			switch($method){
			case 'edit':
			echo '<b style="color:green;">User information has been edited suceessfully</b>';
			break;
			
			case 'delete':
			echo '<b style="color:green;">User information has been updated suceessfully</b>';
			break;
			
			case 'activate':
			echo '<b style="color:green;">User has been activated suceessfully</b>';
			break;
			
			case 'inactivate':
			echo '<b style="color:green;">User has been inactivateed suceessfully</b>';
			break;
			
			}
	} ?>
	</div>

	<table class="table table-striped form-control">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
		<th>Username</th>
		<th>Email</th>
		<th>Created Date</th>
		<th>Modified Date</th>
		<th>Status</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	  <?php 
	  while($line = mysqli_fetch_assoc($executeQuery)){ 
	  ?>
	
		<tr>
			<td><?php echo $line['id']; ?></td>
			<td><?php echo $line['firstName']; ?></td>
			<td><?php echo $line['lastName']; ?></td>
			<td><?php echo $line['username']; ?></td>
			<td><?php echo $line['email']; ?></td>
			<td><?php echo $line['created_at']; ?></td>
			<td><?php echo $line['modefied_at']; ?></td>
			<td>
			
			 <?php 
			  if($line['status']==1){ ?>
			  
			  <a  user_id="<?php echo $line['id']; ?>" class="active_record"  href="javascript:;"> Active </a>
			  <?php 
			
			  }else{?>
			  
			<a  user_id="<?php echo $line['id']; ?>" class="inactive_record"  href="javascript:;"> Inactive </a>
			
			 <?php }
			  ?>
			
			</td>
	
			<td><a href="edit_user.php?id=<?php echo $line['id']; ?>">Edit</a> |<a  user_id="<?php echo $line['id']; ?>" class="delete_record"  href="javascript:;"> Delete</a></td>
		
		</tr>
   <?php 	} ?>
   
    </tbody>
  </table>
   </div>
 
 
 
 <!--  End right Body -->
 </div>

  
  
 </div>

	<script src="js/jquery-3.2.1.slim.min.js" ></script>
	<script src="js/popper.min.js"></script>
	<script>
   $(function(){
	   
	   
	  
	   
	   $('.delete_record').click(function(){
		
         var  user_id  = $(this).attr('user_id');	
         
		 var flag     =   confirm("Do you want delete this record.");
		 
		 if(flag){
			
				window.location.href="user_management.php?id="+user_id+"&m=delete";	
		 }else{ return false; }
		 
		 //alert(user_id);		 
		   
	   });
	   
	   
	   
	   $('.active_record').click(function(){
         var  user_id  = $(this).attr('user_id');	
         
		 var flag     =   confirm("Do you want inactivate this record.");
		 
		 if(flag){
			
				window.location.href="user_management.php?id="+user_id+"&m=inactivate";	
		 }else{ return false; }
		 
		 //alert(user_id);		 
		   
	   });
	   
	   $('.inactive_record').click(function(){
         var  user_id  = $(this).attr('user_id');	
         
		 var flag     =   confirm("Do you want activate this record.");
		 
		 if(flag){
			
				window.location.href="user_management.php?id="+user_id+"&m=activate";
		 }else{ return false; }
		 
		 //alert(user_id);		 
		   
	   });
	   
	   
	   
   });
   
   </script>
	

</body>
</html>






