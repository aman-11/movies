<?php include('conctn.php');
	
		  $sql= 'SELECT  eid, ename,email,esalary,egender ,edoj,tname,tlocation from emp_details E,theatre_loc T WHERE E.tid=T.tid ' ;
    $result = mysqli_query($conn, $sql);
    $addc = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $trigque= 'SELECT  name,email,salary,gender ,start_date,end_date,tname,tlocation from emp_remove E,theatre_loc T WHERE E.tid=T.tid order by end_date desc' ;
    $trigres = mysqli_query($conn, $trigque);
    $trigarr = mysqli_fetch_all($trigres, MYSQLI_ASSOC);
   //print_r($addc);
    $name=$gender=$email=$salary='';

$error = array('name' =>'' ,'gender' =>'','email' =>'' ,'salary' =>''  );
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

if(empty($_POST['gender'])){
    $error['gender'] = 'A phone is required <br />';
  }
 
if(empty($_POST['salary'])){
    $error['salary'] = 'A password is required <br />';
  }

if(array_filter($error))
  {
		//	echo "terminted"; printing the error in form
  	//header('Location:#demo-modal');
		}
else{
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$salary = mysqli_real_escape_string($conn, $_POST['salary']);
		$branch = mysqli_real_escape_string($conn, $_POST['branch']);

	echo $name.$email.$gender.$salary;
		$sql="INSERT INTO emp_details(ename,email,egender,esalary,tid) VALUES('$name','$email','$gender','$salary','$branch')";
		if(mysqli_query($conn, $sql)){
			header('Location:empadmin.php');
			echo "done";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

}
} 
//delete
if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM emp_details WHERE eid = $id_to_delete";
		if(mysqli_query($conn, $sql)){
			header('Location: empadmin.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
	}
	?>
<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

<style>
.modal {
  left: 0;
  right: 0;
  background-color: #fafafa;
  padding: 0;
  max-height: 50%;
  width: 35%;
  will-change: top, opacity;
}
	#p2 a{
		
			color:black;
		}
	#modal{
			margin-top: 10px;
		}
	.right-align a{
		border-radius: 10%;
	}	
	#hid{
		visibility: hidden;
	}

</style>
 </head>

<body> 
	<?php include('template/header.php'); ?>
<?php include('template/anav.php'); ?>
<div class="container" id="modal">
 
<!-- Modal Trigger -->
<div class="right-align">
  <a class="waves-effect waves-light btn pink darken-1 modal-trigger" href="#demo-modal">ADD EMPLOYEE</a>
 </div>
 

  <!-- Modal Structure -->
  <div id="demo-modal" class="modal">
    <!--<div class="modal-content">
     <h4>A Demo of small modal</h4>
      <p>Content of the modal goes here. Place marketing text or other information here.
      </p>
 
    </div>-->
 <section class="container grey-text">
		<h4 class="center">Enter Employee Details</h4>
	<form class="white" action="" method="POST">
         <div class="line">

     	<label>Name</label>
        <input type="text" name="name" value="">
         		<div class="red-text"> <?php echo $error['name'] ?></div>	


		<label> Email</label>
		<input type="text" name="email" value="">	
		 		<div class="red-text"> <?php echo $error['email'] ?></div>	

	    <label> Branch</label>
		<input type="text" name="branch" value="">	
		 	<!--	<div class="red-text"> <?php echo $error['branch'] ?></div>	-->


		<label>salary</label>
		<input type="tel" name="salary" value="">	
		 		<div class="red-text"> <?php echo $error['salary'] ?></div>	

		
        <label>gender</label>
        <input type="text" name="gender" value="">
         		<div class="red-text"> <?php echo $error['gender'] ?></div>	


    	<div class="center">
 		<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">

				
		</div>
	</form>
 </section>

    <div class="modal-footer">
      <a href="empadmin.php" class="modal-action modal-close waves-effect waves-red btn brown darken-3">Close</a>
    </div>
  </div>

<script>
$(document).ready(function(){
    $('.modal').modal();
  })
;
</script>
<div class="container" style="background-color: #bbdefb;margin-top: 10px;width: 100%;">
	  	<h5 class="center green-text"> EMPLOYEE DETAILS</h5>

    <table class="highlight" id="admintable">
      <thead>
        <tr>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>SALARY</th>
          <th>GENDER</th>
          <th>DATE OF JOINING</th>
          <th>BRANCH NAME</th>
          <th>BRANCH LOCATION</th>
          <th>ACTION</th>
    
        </tr>
      </thead>
      <?php foreach($addc as $ind){ ?>
      <tbody >
        <tr>
          <td><?php echo htmlspecialchars($ind['ename']); ?></td>
          <td><?php echo htmlspecialchars($ind['email']); ?></td>
          <td><?php echo htmlspecialchars($ind['esalary']); ?></td>
          <td><?php echo htmlspecialchars($ind['egender']); ?></td>
          <td><?php echo htmlspecialchars($ind['edoj']); ?></td>
          <td><?php echo htmlspecialchars($ind['tname']); ?></td>
          <td><?php echo htmlspecialchars($ind['tlocation']); ?></td>


          <td>  <form action="" method="POST">
    				<input type="hidden" name="id_to_delete" value="<?php echo $ind['eid']; ?>" id="hid">
    				<input type="submit" name="delete" value="Delete" class="btn red z-depth-0">
    			</form></td>
        </tr>
       
      </tbody>
      	<?php } ?>
    </table>   
  </div>

  <div class="container" style="background-color: #bbdefb;margin-top: 10px;width: 100%;">
  	<h5 class="center red-text">REMOVED EMPLOYEE DETAILS</h5>
    <table class="highlight" id="admintable">
      <thead>
        <tr>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>SALARY</th>
          <th>GENDER</th>
          <th>DATE OF JOINING</th>
          <th>BRANCH NAME</th>
          <th>BRANCH LOCATION</th>
          <th>DATE OF RESIGNING</th>
    
        </tr>
      </thead>
      <?php foreach($trigarr as $ind){ ?>
      <tbody>
        <tr>
          <td><?php echo htmlspecialchars($ind['name']); ?></td>
          <td><?php echo htmlspecialchars($ind['email']); ?></td>
          <td><?php echo htmlspecialchars($ind['salary']); ?></td>
          <td><?php echo htmlspecialchars($ind['gender']); ?></td>
          <td><?php echo htmlspecialchars($ind['start_date']); ?></td>
          <td><?php echo htmlspecialchars($ind['tname']); ?></td>
          <td><?php echo htmlspecialchars($ind['tlocation']); ?></td>
          <td><?php echo htmlspecialchars($ind['end_date']); ?></td>

        </tr>
       
      </tbody>
      	<?php } ?>
    </table>   
  </div>
<?php include('template/footer.php'); ?>

</body>   
</html>
