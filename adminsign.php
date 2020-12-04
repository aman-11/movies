<?php  
include('conctn.php');
$name=$phone=$email=$password='';
$error = array('name' =>'' ,'phone' =>'','email' =>'' ,'password' =>''  );
if(isset($_POST['submit']))
{
 if(empty($_POST['name'])){
    $error['name'] = 'A name is required <br />';
  }/* else{
    $name = $_POST['name'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
      $error['name'] =  'name must be letters and spaces only<br/>';
    }
  }
  */


if(empty($_POST['email'])){
    $error['email'] = 'An email is required <br />';
  }
  else
  {
    $email =($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error['email'] = "Invalid email format";
}
  }


if(empty($_POST['phone'])){
    $error['phone'] = 'A phone is required <br />';
  }
  
 
if(empty($_POST['password'])){
    $error['password'] = 'A password is required <br />';
  }

if(array_filter($error))
  {
		//	echo "terminted"; printing the error in form
		}
else{
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
		$sql="INSERT INTO admin_details(a_name,a_email,a_phone,a_password) VALUES('$name','$email','$phone','$password')";
		if(mysqli_query($conn, $sql)){
			header('Location:adminlogin.php');
			echo "done";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

}
}

?>




<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php include('template/header.php'); ?>


 <section class="container grey-text">
 	<h4 class="center"> Enter Your Details</h4>
 	<form class="white" method="POST">
 		<label>Name:</label>
 		<input type="text" name="name">
 		<div class="red-text"> <?php echo $error['name'] ?></div>	

        <label>Phone:</label>
 		<input type="text" name="phone" pattern="[789][0-9]{9}">
  		<div class="red-text"> <?php echo $error['phone'] ?></div>	

 		<label>Email:</label>
 		<input type="text" name="email">
 		<div class="red-text"> <?php echo $error['email'] ?></div>

 		<label>Password:</label>
 		<input type="password" name="password">
 		<div class="red-text"> <?php echo $error['password'] ?></div>

       <div class="center">
       <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
       </div>
 	</form>
    <div class="bottom">
      <h6 class="center">have an account? <a href="adminlogin.php">Login in</a>
    </h6>
    </div>

 </section>
<?php include('template/footer.php'); ?>

</body>
</html>