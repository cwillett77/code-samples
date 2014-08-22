<? 
function insertion_sort(&$sortables) {
    
    if(!is_array($sortables)) return;
    
    for($x = 1; $x < sizeof($sortables); $x++) {
        
        $curr_val = $sortables[$x];
        $y = $x - 1;
        
        while ($y >= 0 && ($curr_val < $sortables[$y]) ) {
            $sortables[$y + 1] = $sortables[$y];
            $y--;
        }
        $sortables[$y + 1] = $curr_val;
    }
    
}

function bucket_sort(&$arr) {

    $size = sizeof($arr);
    
    foreach($arr as $a)
        echo $a ." ";
    echo "\n\n";
        
    // initialize buckets
    $bucket = array();
    for($row = 0; $row < $size; $row++)
        $bucket[$row]= array();
    
    
    foreach($arr as $a) {
        $slot = ceil($a / 10);
        $bucket[$slot][] = $a;           
    }
    
    $y = 0;
    $final_arr = array();
    for($x = 1; $x <= $size; $x++) {
 
         if(!empty($bucket[$x]))
            insertion_sort($bucket[$x]);
        
        foreach($bucket[$x] as $b) 
            $final_arr[$y++] = $b;
    }
    
    foreach($final_arr as $a)
        echo $a ." ";
    echo "\n\n";

}

$arr = array();
for($x = 0; $x < 10; $x++)
    $arr[] = rand(1, 99);
     
bucket_sort($arr);
