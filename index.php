<?php
include './functions.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COLLATZ CONJECTURE</title>
</head>
<body>
<h1>COLLATZ CONJECTURE </h1><hr />
<div>
	<form method="GET" action="./">
		<input type="number" name="x" />
		<input type="submit" name="sendValue" value="Execute" />
	</form>
	
	<?php
		if(isset($_GET["sendValue"])){
			$n = $_GET["x"];
			$iterArr = collatzSeq($n);
			
			foreach($iterArr as $ind){
				echo $ind.", ";
			}
			
			$maxNum = max($iterArr);
			$numIter = count($iterArr) - 1;
			
			echo "<br> Max. Number is: ".$maxNum;
			echo "<br> Number of Iteration is: ".$numIter;
		}
	?>
</div>
</body>
</html>
