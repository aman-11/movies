<?php 
include('conctn.php');
//if(isset($_GET['id'])){

		//$id = mysqli_real_escape_string($conn, $_GET['id']);
		//echo $id;
		
		  $sql= 'SELECT  aid, a_name,a_phone,a_email,a_password from admin_details' ;
    $result = mysqli_query($conn, $sql);
    $addc = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // free the $result from memory
//	
	// close connectionmysqli_free_result($result);
	//mysqli_close($conn);
   // print_r($addc);
	//}
//modal form
$name=$phone=$email=$password='';
$error = array('name' =>'' ,'phone' =>'','email' =>'' ,'password' =>''  );
//echo "modal valid enter";
if(isset($_POST['submit']))
{
 if(empty($_POST['name'])){
    $error['name'] = 'A name is required <br />';
  } else{
    $name = $_POST['name'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
      $error['name'] =  'name must be letters and spaces only<br/>';
    }
  }
  


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
  	//header('Location:#demo-modal');
		}
else{
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
		$sql="INSERT INTO admin_details(a_name,a_email,a_phone,a_password) VALUES('$name','$email','$phone','$password')";
		if(mysqli_query($conn, $sql)){
			header('Location:adminpanel.php');
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
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>         
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<style type="text/css">
    #p1 a{
	color: black;
       }

	.right-align a{
		border-radius: 10%;
	}	

	</style>


</head>
<body>
<?php include('template/header.php'); ?>
<nav class="navadmin">
	<div class="nav-wrapper blue lighten-3" style="width: 100%;">
	<ul class="left hide-on-small-down">
		<li id="p1"><a href="adminpanel.php " class="btn green z-depth-2">Admin</a> </li>
		<li id="p6"><a href="branchadmin.php" class="btn green z-depth-2">Branch</a> </li>
		<li id="p2"><a href="empadmin.php" class="btn green z-depth-2">Employee</a></li>
		<li id="p3"><a href="movadmin.php" class="btn green z-depth-2">Movie</a></li>
  		<li id="p4"><a href="custadmin.php" class="btn green z-depth-2">Customer</a></li>
  		<li id="p5"><a href="bookadmin.php" class="btn green z-depth-2">Bookings</a></li>

	</ul>
	<ul class="right hide-on-small-down">
		<li ><a href="adminlogin.php" class="btn brand z-depth-0">Logout</a></li>
	</ul>
	</div>
</nav>

<div class="container" id="modal">
 
<!-- Modal Trigger -->
<div class="right-align " style="margin-top: 8px;ṣ">
  <a class="waves-effect waves-light btn pink darken-1 modal-trigger" href="#demo-modal">ADD ADMIN</a>
 </div>
 

  <!-- Modal Structure -->
  <div id="demo-modal" class="modal">
    <!--<div class="modal-content">
     <h4>A Demo of small modal</h4>
      <p>Content of the modal goes here. Place marketing text or other information here.
      </p>
 
    </div>-->
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

 </section>

    <div class="modal-footer">
      <a href="adminpanel.php" class="modal-action modal-close waves-effect waves-red btn brown darken-3">Close</a>
    </div>
  </div>

 
<script>
$(document).ready(function(){
    $('.modal').modal();
  })
;
</script>

<!--table--->
			
<div class="container" style="background-color: #bbdefb;margin-top: 10px;width: 100%;">
    <table class="highlight" id="admintable">
      <thead>
        <tr>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>PHONE</th>
          <th>PASSWORD</th>
    
        </tr>
      </thead>
      <?php foreach($addc as $ind){ ?>
      <tbody>
        <tr>
          <td><?php echo htmlspecialchars($ind['a_name']); ?></td>
          <td><?php echo htmlspecialchars($ind['a_email']); ?></td>
          <td><?php echo htmlspecialchars($ind['a_phone']); ?></td>
          <td><?php echo htmlspecialchars($ind['a_password']); ?></td>
        </tr>
       
      </tbody>
      	<?php } ?>
    </table>   
  </div>
  
<?php include('template/footer.php'); ?>

</body>
</html>