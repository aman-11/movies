<?php 
include('conctn.php');
$cid=$_GET['id'];
$que = "SELECT cust_name  FROM cust_details  WHERE cid = $cid";
    $res = mysqli_query($conn, $que);
    $add = mysqli_fetch_assoc($res);
    $name=$add['cust_name'];

 $sql="CALL `custbook`('$cid')";
    $result = mysqli_query($conn, $sql);

    $addc = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //print_r($addc);
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>         
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<style type="text/css">
    #p5 a{
	color: black;
       }

	

	</style>


</head>
<body>
<?php include('template/header.php'); ?>
 
      <nav>
    <div class="nav-wrapper blue lighten-2 " style="width:100%;">
      <span class="left-align" style="margin-left: 35px;letter-spacing: 1.9px; "  > <?php echo "Hello! ".strtoupper($name); ?></span>
      <ul class="right hide-on-medium-and-down">
             <li  ><a href="booking.php?id=<?php echo $cid; ?> " class="btn green z-depth-2">home</a></li>

        <li><a href="custbook.php?id=<?php echo $cid; ?> " class="btn green z-depth-2">tickets</a></li>
        <li><a href="custlogin.php" class="btn green z-depth-2">logout</a></li>

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
          <th>THEATRE</th>
          <th>THEATRE LOCATION</th>
          <th>MOVIE</th>
          <th>TIMING</th>
          <th>SEAT</th>
          <th>PRICE</th>
          <th>DATE OF BOOKING</th>    
        </tr>
      </thead>
      <?php foreach($addc as $ind){ ?>
      <tbody>
        <tr>
          <td><?php echo htmlspecialchars($ind['cname']); ?></td>
          <td><?php echo htmlspecialchars($ind['cust_phone']); ?></td>
          <td><?php echo htmlspecialchars($ind['tname']); ?></td>
          <td><?php echo htmlspecialchars($ind['tlocation']); ?></td>
          <td><?php echo htmlspecialchars($ind['mname']); ?></td>
          <td><?php echo htmlspecialchars($ind['ctime']); ?></td>
          <td><?php echo htmlspecialchars($ind['cseat']); ?></td>
          <td><?php echo htmlspecialchars($ind['cprice']); ?></td>
          <td><?php echo htmlspecialchars($ind['tob']); ?></td>

        </tr>
       
      </tbody>
      	<?php } ?>
    </table>   
  </div>
  
<?php include('template/footer.php'); ?>

</body>
</html>