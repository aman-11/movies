<?php
include('conctn.php');
$name = $phone = $password='';//var
$errors = array('name' => '', 'phone' => '','password' => '');//errorvar
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

	if(empty($_POST['phone'])){
    $errors['phone'] = 'A phone no is required <br />';
  }

	if(empty($_POST['password'])){
    $errors['password'] = 'A password is required <br />';
  }
	if(array_filter($errors))
  {
			echo "terminted";
		}
		else{
			//echo "enter into database";
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$phone = mysqli_real_escape_string($conn, $_POST['phone']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$sql = "INSERT INTO cust_details(cust_name,cust_phone,cust_password) VALUES('$name','$phone','$password')";
			if(mysqli_query($conn, $sql)){
			header('Location:custlogin.php');
			echo "done";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		}
}
	?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'template/header.php';  ?>
<section class="container grey-text">
		<h4 class="center">Enter your details</h4>
		<form class="white" action="" method="POST">
      <label>Name</label>
      <input type="text" name="name" value="">
			<div class="red-text"><?php echo $errors['name']; ?></div>


			<label>Phone</label>
			<input type="text" name="phone" value="" pattern="[789][0-9]{9}">
			<div class="red-text"><?php echo $errors['phone']; ?></div>



			<label>password</label>
			<input type="password" name="password" value="">
			<div class="red-text"><?php echo $errors['password']; ?></div>


			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
		<div class="bottom">
      <h6 class="center">have an account? <a href="custlogin.php">Login in</a>
    </h6>
    </div>
	</section>
</section>
<?php include 'template/footer.php'; ?>
</html>
