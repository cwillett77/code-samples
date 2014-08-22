<?
// 0,1,1,2,3,5,8,13
function fib($size) {

	$first = 0;
	$second = 1;
	
	for($x=0; $x <= $size - 1; $x++) {
		if( $x<2 ) echo $x."\n";
		else {
			$total = $first + $second;
			$first = $second;
			$second = $total;
			echo $total."\n";
		}
	
	}

}

fib(20);
