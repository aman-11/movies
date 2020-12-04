<?php 
include('conctn.php');


   // print_r($array);
if(isset($_POST['submit']))
{
	

     $tid =$_POST['tid'];
     $mname = $_POST['mname'];
	$mtime = $_POST['mtime'];
	$mgenre = $_POST['mgenre'];
       
       //no of hall
    $query="SELECT tid,count(mid)as thall from mov_details where tid=$tid GROUP BY tid";
    
		$result = mysqli_query($conn, $query);
		$addc = mysqli_fetch_assoc($result);
          $total = $addc['thall'];   
    //echo $total;
    if($total<2)
    {

		$sql="INSERT INTO mov_details(tid,mname,mtime,mgenre) VALUES('$tid','$mname','$mtime','$mgenre')";
		if(mysqli_query($conn, $sql)){
			header('Location:movadmin.php');
			
			echo "done";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
    }
    //else{


    	//echo "not possible";
   // }

    else
    { ?>
    
        <script type='text/javascript'>
        alert('Only two halls.You cannot add movie!');
        </script>

  <?php }
} 
//table 
	  $sql= 'SELECT  mid, mname,mtime,mgenre,tname,tlocation from mov_details M,theatre_loc T WHERE M.tid=T.tid ' ;
    $result = mysqli_query($conn, $sql);
    $addc = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //delete
if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM mov_details WHERE mid = $id_to_delete";
		if(mysqli_query($conn, $sql)){
			header('Location: movadmin.php');
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
	<style type="text/css">

		#p3 a{
			color: black;
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
<div class="right-align">
  <a class="waves-effect waves-light btn pink darken-1 modal-trigger" href="#demo-modal">ADD MOVIE</a>
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
         	     	<label>Theatre Branch</label>
        <input type="text" name="tid" value="">

     	<label>Movie Name</label>
        <input type="text" name="mname" value="">


		<label> Movie Time</label>
		<input type="time" name="mtime" value="">	

	    <label> Movie Genre</label>
		<input type="text" name="mgenre" value="">	




    	<div class="center">
 		<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">

				
		</div>
	</form>
 </section>

    <div class="modal-footer">
      <a href="movadmin.php" class="modal-action modal-close waves-effect waves-red btn brown darken-3">Close</a>
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
          <th>THEATRE NAME</th>
          <th>THEATRE LOCATION</th>
          <th>MOVIE NAME</th>
          <th>MOVIE TIME</th>
          <th>MOVIE GENRE</th>
           <th>ACTION</th>
        </tr>
      </thead>
     <?php foreach($addc as $ind){ ?>
      <tbody>
        <tr>

          <td><?php echo htmlspecialchars($ind['tname']); ?></td>
          <td><?php echo htmlspecialchars($ind['tlocation']); ?></td>
         <td><?php echo htmlspecialchars($ind['mname']); ?></td>
          <td><?php echo htmlspecialchars($ind['mtime']); ?></td>
          <td><?php echo htmlspecialchars($ind['mgenre']); ?></td>


          <td>  <form action="" method="POST">
    				<input type="hidden" name="id_to_delete" value="<?php echo $ind['mid']; ?>" id="hid">
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