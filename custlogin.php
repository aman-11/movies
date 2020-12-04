<?php 
include('conctn.php');
$name = $password ='';//var
$errors = array('name' => '', 'password' =>'');//errorvar
if(isset($_POST['submit']))
{
	if(empty($_POST['name'])){
    $errors['name'] = 'A name is required <br />';
  } else{
    $name = $_POST['name'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
      $errors['name'] =  'name must be letters and spaces only<br/>';
    }
  }
	if(empty($_POST['password'])){
    $errors['password'] = 'A password is required <br />';
  }
	if(array_filter($errors))
  {
			echo "terminted";
		}
		else{
			
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			$sql= "SELECT  cid, cust_name ,cust_password from cust_details where cust_name='$name' and cust_password='$password'";
            $result = mysqli_query($conn, $sql);
            $addc = mysqli_fetch_assoc($result);//, MYSQLI_ASSOC);
           // print_r($addc);
            //echo $addc['cid'];
			if(mysqli_query($conn, $sql))
			{
				//echo "ready to head";
				/*foreach($addc as $check)
				{
				if(($name==$check['cust_name'])&&($password==$check['cust_password']))
				{
                  // print_r($check["cid"]);
 				 
                         
			         header('Location:booking.php?id='.$check["cid"] );
				}
				}*/
			if($addc)
			header('Location:booking.php?id='.$addc["cid"] );	

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
<html lang="en" dir="ltr">

<?php include 'template/header.php';  ?>
<section class="container grey-text">
		<h3 class="center">login</h3>
		<form class="white" action="" method="POST">


			<label>name</label>
			<input type="text" name="name" value="">
            			<div class="red-text"><?php echo $errors['name']; ?></div>


			<label>password</label>
			<input type="password" name="password" value="">
						<div class="red-text"><?php echo $errors['password']; ?></div>


			<div class="center">
				<input type="submit" name="submit" value="login" class="btn brand z-depth-0">
			</div>
		</form>
    <div class="bottom">
      <h6 class="center">don't have an account? <a href="custsign.php">Sign in</a>
    </h6>
    </div>
	</section>

<?php include 'template/footer.php'; ?>
</html>
