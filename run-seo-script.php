<html>
<head>
<title>SEO Script</title>
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
	//if RUNSEO TRUE, RUN SCRIPT:
	if($_GET['runseo'] == "1"){ 
	
		//DB CONNECTION
		$con = mysqli_connect("localhost", "nadiaker_phptest_usr", "r=?6!$*0NP!*", "nadiaker_phptest");
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{

			/* LOOP THROUGH DB (sort records by date to group dated data together)
			GRAB DATE FIRST & SEARCH TERM: */ 	
			$loop_termNdate = mysqli_query($con, "SELECT date, searchTerm FROM seorankings GROUP BY searchTerm ORDER BY date DESC") or die (mysqli_error($con));
			
			echo "<table>";
			echo "<tr><th>id</th><th>date</th><th>searchTerm</th><th>visibility</th></tr>";
			
			//row id / counter: 
			$row_id = 1;		
			while ($row_termNdate = mysqli_fetch_array($loop_termNdate)){
				
				//GLOBAL Google, Yahoo & Bing Rankings (start & set rank at zero). 
				$gR = 0; $yR = 0; $bR = 0;
				// default score. 
				$score = 0;
				
				$collectionDate = $row_termNdate['date'];
				$searchTerm = $row_termNdate['searchTerm'];


				$loop_rankings = mysqli_query($con, "SELECT * FROM seorankings WHERE date = '".$collectionDate."' AND searchTerm = '".$searchTerm."';") or die (mysqli_error($con));
			
				while ($row_rankings = mysqli_fetch_array($loop_rankings)){
				
					//populate each ranking per engine. 
					switch ($row_rankings['engine']) {
					case "google":
						$gR = $row_rankings['ranking'];
						break;
					case "yahoo":
						$yR = $row_rankings['ranking'];
						break;
					case "bing":
						$bR = $row_rankings['ranking'];
						break;
					}//end switch				
				}//end row2 loop	
				
				//Continue only if all 3 engines have results (Records with a ranking of zero should be excluded) ???
				//if(($gR > 0) && ($yR > 0) && ($bR > 0)){
				
					$score = calculateSEOScore($gR, $yR, $bR);
					//If SEO Score greater than 0, display. 
					if($score > 0){							
					echo "<tr><td>".$row_id."</td><td>".$collectionDate."</td><td>".$searchTerm."</td><td>".$score."</td></tr>";
					}
					$row_id++;
				//}//if all 3 engines have rankings!
				
				
			}//end row loop
			
			echo "</table>";
			
		}//end db connection check if. 		
		mysqli_close($con);
	
	}else{	
		echo "Sorry, you can't run this script today!";
	}//end check query string
?>




</body>
</html>
<?php 
function calculateSEOScore($gR, $yR, $bR) {
	$rankingPoint = 31;
	$maxScore = 600;
	$percentage = 100;
	$result = 0; //default.
	
	$g_calcString = 0;
	$y_calcString = 0;
	$b_calcString = 0;
	
	//Google Calculation:
	if($gR > 0){
		$g_calcString = ($rankingPoint - $gR) * 17; 
	}
	//Yahoo Calculation:
	if($yR > 0){
		$y_calcString = ($rankingPoint - $yR) * 2;
	}
	//Bing Calculation:
	if($bR > 0){
		$b_calcString = ($rankingPoint - $bR);
	}
	
	//Full Score Calculation:
	$result = ($g_calcString + $y_calcString + $b_calcString) / $maxScore * $percentage;
	
	//ROUND RESULTS TO NEAREST 1 decimal.
	$result_rounded = (round($result, 1));
	
	return $result_rounded;
}
?>