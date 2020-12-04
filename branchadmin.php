<?php 
include('conctn.php');

$sql= 'SELECT  tid, tname,tlocation,tseat from theatre_loc' ;
    $result = mysqli_query($conn, $sql);
    $addc = mysqli_fetch_all($result, MYSQLI_ASSOC); 


$name=$location=$id='';

$error = array('name' =>'' ,'location' =>'','id' =>'' );
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
  


if(empty($_POST['location'])){
    $error['location'] = 'An location is required <br />';
  }


if(empty($_POST['id'])){
    $error['id'] = 'A id is required <br />';
  }
 

if(array_filter($error))
  {
		//	echo "terminted"; printing the error in form
  	//header('Location:#demo-modal');
		}
else{
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $location = mysqli_real_escape_string($conn, $_POST['location']);
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$seat = mysqli_real_escape_string($conn, $_POST['seat']);


	echo $name.$email.$gender.$salary;
		$sql="INSERT INTO theatre_loc(tid,tname,tlocation,tseat) VALUES('$id','$name','$location','$seat')";
		if(mysqli_query($conn, $sql)){
			header('Location:branchadmin.php');
			echo "done";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

}
} 
//delete
if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM theatre_loc WHERE tid = $id_to_delete";
		if(mysqli_query($conn, $sql)){
			header('Location: branchadmin.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
	}


    ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<style >
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
 <nav class="navadmin">
	<div class="nav-wrapper blue lighten-3" style="width: 100%;">
	<ul class="left hide-on-small-down">
		<li id="p1"><a href="adminpanel.php" class="btn green z-depth-2">Admin</a> </li>
		<li id="p2"><a href="branchadmin.php" class="btn green z-depth-2">Branch</a> </li>
		<li id="p3"><a href="empadmin.php" class="btn green z-depth-2">Employee</a></li>
		<li id="p4"><a href="movadmin.php" class="btn green z-depth-2">Movie</a></li>
  		<li id="p5"><a href="custadmin.php" class="btn green z-depth-2">Customer</a></li>
  		<li id="p6"><a href="bookadmin.php" class="btn green z-depth-2">Bookings</a></li>

	</ul>
	<ul class="right hide-on-small-down">
		<li ><a href="adminlogin.php" class="btn brand z-depth-0">Logout</a></li>
	</ul>
	</div>
</nav>

<div class="container" id="modal">
 
<!-- Modal Trigger -->
<div class="right-align">
  <a class="waves-effect waves-light btn pink darken-1 modal-trigger" href="#demo-modal">ADD BRANCH</a>
 </div>
 

  <!-- Modal Structure -->
  <div id="demo-modal" class="modal">
 <section class="container grey-text">
		<h4 class="center">Enter Branch Details</h4>
	<form class="white" action="" method="POST">
         <div class="line">

         <label>Theatre ID</label>
        <input type="text" name="id" value="">
        	<div class="red-text"> <?php echo $error['id'] ?></div>	

     	<label>Theatre Name</label>
        <input type="text" name="name" value="">
       	<div class="red-text"> <?php echo $error['name'] ?></div>	


		<label> Theatre Location</label>
		<input type="text" name="location" value="">	
		<div class="red-text"> <?php echo $error['location'] ?></div>

		<label> Theatre Seats</label>
		<input type="text" name="seat" value="">	

	    

    	<div class="center">
 		<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">

				
		</div>
	</form>
 </section>

    <div class="modal-footer">
      <a href="branchadmin.php" class="modal-action modal-close waves-effect waves-red btn brown darken-3">Close</a>
    </div>
  </div>

<script>
$(document).ready(function(){
    $('.modal').modal();
  })
;
</script>
<div class="container" style="background-color: #bbdefb;margin-top: 10px;width: 100%;">
    <table class="highlight" id="admintable">
      <thead>
        <tr>
          <th>BRANCH ID</th>
          <th>BRANCH NAME</th>
          <th>BRANCH LOCATION</th>
          <th>NO OF SEATS</th>
           <th>ACTION</th>

    
        </tr>
      </thead>
      <?php foreach($addc as $ind){ ?>
      <tbody>
        <tr>
          <td><?php echo htmlspecialchars($ind['tid']); ?></td>
          <td><?php echo htmlspecialchars($ind['tname']); ?></td>
          <td><?php echo htmlspecialchars($ind['tlocation']); ?></td>
           <td><?php echo htmlspecialchars($ind['tseat']); ?></td>


          <td>  <form action="" method="POST">
    				<input type="hidden" name="id_to_delete" value="<?php echo $ind['tid']; ?>" id="hid">
    				<input type="submit" name="delete" value="Delete" class="btn red z-depth-0">
    			</form></td>
        </tr>
       
      </tbody>
      	<?php } ?>
    </table>   
  </div>

  <?php include('template/footer.php'); ?>
</body>
</html>