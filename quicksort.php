<?
function quicksort($array) {
	
	if(count($array) < 2) return $array;
 
    $left = $right = array();
    
    reset($array);
    $pivot_key = key($array);
    $pivot = array_shift($array);
    
    echo "pivot_key: ".$pivot_key.", pivot: ".$pivot."\n";
 
    foreach($array as $k => $v) {
        if($v < $pivot) {
            $left[$k] = $v;
            echo "left - k: {$k}, v: {$v}\n";
        } else {
            $right[$k] = $v;
            echo "right - k: {$k}, v: {$v}\n";
        }
    }
 
    return array_merge(quicksort($left), array($pivot_key => $pivot), quicksort($right));
}

$sorted = quicksort(array(70,50,60));

var_dump($sorted);
