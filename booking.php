<?php 
	
include('conctn.php');
$cid=$_GET['id'];
$que = "SELECT cust_name  FROM cust_details  WHERE cid = $cid";
		$result = mysqli_query($conn, $que);
		$addc = mysqli_fetch_assoc($result);
		$name=$addc['cust_name'];
if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "SELECT cust_name ,cust_password,cust_phone FROM cust_details  WHERE cid = $id";
		$result = mysqli_query($conn, $sql);

		$addc = mysqli_fetch_assoc($result);
       //   print_r($addc);

	}
	//echo $id;
		  $sql= 'SELECT  mid, mname,mtime,mgenre,tname,tlocation from mov_details M,theatre_loc T WHERE M.tid=T.tid  ' ;
    $mov = mysqli_query($conn, $sql);
    $movlist = mysqli_fetch_all($mov, MYSQLI_ASSOC);

    //print_r($movlist);



 ?>



	 <!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  	<style type="text/css">

  	
  	</style>
  </head>
  <body>
    <?php include 'template/header.php'; ?>

	 <nav>
    <div class="nav-wrapper blue lighten-2 " style="width:100%;">
    	<span class="left-align" style="margin-left: 35px;letter-spacing: 1.9px; "  > <?php echo "Hello! ".strtoupper($name); ?></span>
      <ul class="right hide-on-medium-and-down">
        <li><a href="custbook.php?id=<?php echo $cid; ?> " class="btn green z-depth-2">tickets</a></li>
        <li><a href="custlogin.php" class="btn green z-depth-2">logout</a></li>

        	</ul>
        </div>
      </nav>
 	
 	<h4 class="center grey-text"> Movie</h4>

	<div class="container">
		<div class="row">

			<?php foreach($movlist as $ind){ ?>

				<div class="col s6 md3" >
					<div class="card z-depth-0"id="p1">
						<div class="card-content center" style="border:1.5px solid black">
							
						<h6>Theatre Name:<?php echo $ind['tname']; ?></h6>
						<div>Location:<?php echo $ind['tlocation']; ?></div>
              	        <div>Movie Name:<?php echo $ind['mname']; ?></div>
                	    <div>Time: <?php echo $ind['mtime']; ?></div>
						</div>
						<div class="card-action center-align"style="border-bottom:1.5px solid black;border-left:1.5px solid black;border-right:1.5px solid black">
							<a class="brand-text" href="ticket.php?mid=<?php echo $ind['mid'] ?>&cid=<?php echo $id ?>">BOOK</a>
						</div>
					</div>
				</div>

			<?php } ?>

   
		</div>
	</div>
    <?php include 'template/footer.php'; ?>

  </body>
</html>
