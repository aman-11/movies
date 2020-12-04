<?php 
include('conctn.php');
$email=$password='';
$error = array('email' =>'','password' =>'' );
if(isset($_POST['submit']))
{
	if (empty($_POST['email'])) {
	 $error['email'] = 'A email is required <br />';
	}
	else
  {
    $email =($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error['email'] = "Invalid email format";
}
  }
	if (empty($_POST['password'])) {
	 $error['password'] = 'A password is required <br />';
	}
if(array_filter($error))
  {
			echo "terminted";
		}
		else{
			
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			$sql= "SELECT  aid, a_email ,a_password from admin_details where a_email='$email' and a_password='$password'";
            $result = mysqli_query($conn, $sql);
            $addc = mysqli_fetch_assoc($result);//, MYSQLI_ASSOC);
           // print_r($addc);
        if(mysqli_query($conn, $sql))
			{
				//echo "ready to head";
				/*foreach($addc as $check)
				{
				if(($email==$check['a_email'])&&($password==$check['a_password']))
				{
                  // print_r($check["cid"]);
 				 
                         
			         header('Location:adminpanel.php?id='.$check["aid"] );
				}
				}*/
			//
				if($addc)
				{
					header('Location:adminpanel.php?id='.$addc["aid"] );
				}
			else{

?>
    
        <script type='text/javascript'>
        alert('Invalid username and password!');
        </script>

  <?php

			}
			} 
			else {
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
<section class="conatiner grey-text">
	<h3 class="center">Admin Login</h3>
<form class="white" action="" method="POST">
	<label>Email:</label>
	<input type="text" name="email">
	 		<div class="red-text"> <?php echo $error['email'] ?></div>



    <label>Password:</label>
	<input type="Password" name="password">
	 		<div class="red-text"> <?php echo $error['password'] ?></div>

      
      <div class="center">
	<input type="submit" name="submit" value="Login" class="btn brand z-depth-0">
	</div>

</form>
<div class="bottom">
      <h6 class="center">don't have an account? <a href="adminsign.php">Sign in</a>
    </h6>
    </div>
</section>

<?php include('template/footer.php'); ?>
</body>
</html>