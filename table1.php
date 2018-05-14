<html>
<head>
<title>Table 1 Data</title>
<style>
table {
	width: 400px; 
    border-collapse: collapse;
}
table, td, th {
	border: 1px solid #000;	
	text-align: left;
}
th {
	font-weight: bold;
}
</style>
</head>
<body>

<?php

		//DB CONNECTION
		$row_id = 1; 
		
		$con = mysqli_connect("localhost", "nadiaker_phptest_usr", "r=?6!$*0NP!*", "nadiaker_phptest");
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{

			/* LOOP THROUGH DB (sort records by date to group dated data together)
			GRAB DATE FIRST & SEARCH TERM: */ 	
			$loop_termNdate = mysqli_query($con, "select * from seorankings ORDER BY date DESC") or die (mysqli_error($con));
			
			echo "<table>";
			echo "<tr><th>id</th><th>date</th><th>egine</th><th>searchTerm</th><th>ranking</th></tr>";
			

			while ($row_termNdate = mysqli_fetch_array($loop_termNdate)){				
				
						
					echo "<tr><td>".$row_id."</td><td>".$row_termNdate['date']."</td><td>".$row_termNdate['engine']."</td><td>".$row_termNdate['searchTerm']."</td><td>".$row_termNdate['ranking']."</td></tr>";
					
				$row_id++;
				
			}//end row loop
			
			echo "</table>";
			
		}//end db connection check if. 		
		mysqli_close($con);
	

?>

</body>
</html>