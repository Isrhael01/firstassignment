<?php
function collatzSeq($n){
	$x = $n;
	$numHighest = $n;
	$count = 0;
	$iterationArr = array();
	
	for($i = $x; $i > 1; ){
		if($x % 2 == 0){
			$x = $x / 2;
		}else{
			$x = ($x * 3) + 1;
		}
		$iterationArr[] = $x;
		
		$i = $x;
		if($numHighest < $x) {
			$numHighest = $x;
		}
		$count = $count + 1;
	}
	return $iterationArr;
}
?>
