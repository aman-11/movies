<?php  
include('conctn.php');

	//	$cid = 1;
	 	$mid = 3;
        $query="SELECT cseat from ticket where mid=$mid";
		$res = mysqli_query($conn, $query);
		$seat = mysqli_fetch_all($res,MYSQLI_ASSOC);
         print_r($seat);
	   // echo   $seat[1]['cseat'];
         $que="SELECT mid,count(cseat) as bseat from ticket T where T.mid=$mid group by mid";
         $ans = mysqli_query($conn, $que);
		$tot= mysqli_fetch_assoc($ans);//,MYSQLI_ASSOC);
		$total_book=$tot['bseat'];
		echo "<br>"."total no of seat booked=
		".$total_book;
		$a=array();
		for($i=0;$i<$total_book;$i++)
			{
				$a[$i]=$seat[$i]['cseat'];
			}
		/*	echo "<br>";
		for($i=0;$i<$total_book;$i++)
			{
				 echo $a[$i];
			}*/
	    $b= array(1,2,3,4,5,6,7,8,9,10);
	  /*  echo "<br>";
	    foreach ($b as$val) {
	    	# code..
	    	echo $val."\t";
	    }*/
	    $c=array();
	  //   echo "<br>";
	   $c=array_merge($a,$b);
	//   print_r($c);//merged array	   
	//     echo "<br>";
	     sort($c);
	 //    echo "<br>";
	 //    print_r($c);//sorted in asc
	     $size=($total_book+10);
	     $c[$total_book+10]='';
	    $seat=array();//remaining seats
	    $n=0;
	    for($i=0;$i<$size;$i++)
	    {
	    	if($c[$i]==$c[($i+1)])
	    	{
	    		$i++;
	    	}
	    	else
	    	{
	    		$seat[$n]=$c[$i];
	    			$n++;
	    	}
	    
	    }
	
			echo "<br> Remaining seats to book";
			foreach ($seat as$val) {
	    	# code..
	    	echo $val."\t";
	    }

?>