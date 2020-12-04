<?php 
include('conctn.php');
		
		  $sql= 'SELECT  cust_name,cust_phone,cust_password from cust_details' ;
    $result = mysqli_query($conn, $sql);
    $addc = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // free the $result from memory
//	
	// close connectionmysqli_free_result($result);
	//mysqli_close($conn);
   // print_r($addc);
	//}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>         
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<style type="text/css">
    #p4 a{
	color: black;
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



<!--table--->
			
<div class="container" style="background-color: #bbdefb;margin-top: 10px;width: 100%;">
    <table class="highlight" id="admintable">
      <thead>
        <tr>
          <th>NAME</th>
          <th>PHONE</th>
          <th>PASSWORD</th>
    
        </tr>
      </thead>
      <?php foreach($addc as $ind){ ?>
      <tbody>
        <tr>
          <td><?php echo htmlspecialchars($ind['cust_name']); ?></td>
          <td><?php echo htmlspecialchars($ind['cust_phone']); ?></td>
          <td><?php echo htmlspecialchars($ind['cust_password']); ?></td>
        </tr>
       
      </tbody>
      	<?php } ?>
    </table>   
  </div>
  
<?php include('template/footer.php'); ?>

</body>
</html>