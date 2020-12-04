<?php  
include('conctn.php');


		$cid = $_GET['cid'];
		$mid = $_GET['mid'];
		//echo "cid=".$cid;
		//echo "mid=".$mid;
		$sql="SELECT mtime from mov_details where mid=$mid";
		$result = mysqli_query($conn, $sql);

		$addc = mysqli_fetch_assoc($result);
         // print_r($addc);
          $time = $addc['mtime'];
        //  echo $time;
      /* $query="SELECT cseat from ticket where mid=$mid";
		$res = mysqli_query($conn, $query);
		$seat = mysqli_fetch_all($res,MYSQLI_ASSOC);
         print_r($seat);*/
         $curr_date=date("Y-m-d");
       //  echo "<br> SYSTEM DATE=".$curr_date;

         $next_date=date("Y-m-d",strtotime($curr_date.'+ 1 days')); 
       //  echo "<br>".$next_date; 

          $name=$seat=$date='';
          $errors = array('name' => '', 'seat' =>'','date'=>'');//errorvar
     include('seatlogic.php');

          if (isset($_POST['submit'])) {
          	# code...
          	if(empty($_POST['name'])){
            $errors['name'] = 'A name is required <br />';
            } 
          	if(empty($_POST['seat'])){
            $errors['seat'] = 'A seat is required <br />';
            } 
          	if(empty($_POST['date'])){
            $errors['date'] = 'A date is required <br />';
            } 
            
            if(array_filter($errors))
            {
            	//print error in form
            }
            else{
            	$name = $_POST['name'];
			    $seatno =$_POST['seat'];
			    $date=$_POST['date'];
			   /* echo $name.$seat;
			    echo $date;*/
			   // echo $seatno;
			/*   if($date==$next_date)
			    {
			    	 	echo "check seat now";

			    	// 	goto seat_check;
			    	 	/*	$sql = "INSERT INTO ticket(cid,mid,cname,cseat,cdate,ctime) VALUES('$cid','$mid','$name','$seatno','$date','$time')";
            	if(mysqli_query($conn, $sql)){
				header('Location:booking.php?id='.$cid);
            		echo "done insert";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			    }
			    else{?>
        <script type='text/javascript'>
        alert('Tickets not available on this date. \nTry next day tickets.!');
        </script>
        <?php } 
           
        //	seat_check:for


            }//if no error enter "else" to insert
          }//end of isset submit*/
 		foreach ($seat as $seatAvail) {
 			if(($date==$next_date)&&($seatno==$seatAvail)){
 				$sql = "INSERT INTO ticket(cid,mid,cname,cseat,cdate,ctime) VALUES('$cid','$mid','$name','$seatno','$date','$time')";

            	if(mysqli_query($conn, $sql)){
				header('Location:booking.php?id='.$cid);
            	//	echo "done insert";
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


 			}
 			else{

 				if(($date!=$next_date)||($seatno!=$seatAvail)) {$errors['date']='please enter the valid date';
 			    $errors['seat']='please enter the available seats';}

 				/*else if($seatno!=$seatAvail) $errors['seat']='please enter the available seats';
 				else{
					$errors['seat']='please enter the available seats';
 				}*/

 			}
 		}//end foreach
            }//if no error enter "else" to insert
          }//end of isset submit


?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  	<link rel="stylesheet" type="text/css" href="css/seat.css">
    <style type="text/css">
    .seatimg{
      /*width: 100px;
      margin: 40px auto -30px;
      display: block;
      position: relative;
      top: -30px;
      margin-left: 200px;*/
    }
    </style>
  </head>
  <body>
    <?php include 'template/header.php'; ?>
	 <div class="seat_img">
	 	<img src="seat.png" class="seatimg">
	 </div>
 	
<section class="container grey-text">
		<h4 class="center">Book Ticket</h4>
	<form class="white" action=""  method="POST">
         <div class="line">

     	<label>Name</label>
        <input type="text" name="name" value="">  	
		<div class="red-text">  <?php echo $errors['name']; ?> </div>


		<label>Seat</label>
		<input type="number" name="seat" value="" min="1" max="10">	
		<div class="red-text">  <?php echo $errors['seat']; ?> </div>
		<div class="green-text"> 
			<?php 
			echo "Seats available are:";	
			foreach ($seat as$val) {
	    	echo $val."\t";
	        } ?> 
	    </div>

		
        <label>Date</label>
        <input type="date" name="date" value="">
   		<div class="red-text">  <?php echo $errors['date']; ?> </div>

        <label>price</label>
        <input type="text" name="price" value="Rs180.00" readonly="Rs180.00">


    	<div class="center">
 		<input type="submit" name="submit" value="Book" class="btn brand z-depth-0">
 		<input type="submit" name="cancel" value="Cancel" class="btn red z-depth-0">
				
		</div>
	</form>
	<?php 
		if(isset($_POST['cancel']))
		{
			header('location:booking.php?id='.$cid);
		}

	 ?>
 </section>


    <?php include 'template/footer.php'; ?>

  </body>
</html>