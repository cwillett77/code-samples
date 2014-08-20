<? // insertion sort
function insertion_sort(&$array) {
    
    if(!is_array($array)) return;
    
    for($x = 1; $x < sizeof($array); $x++) {
    
        $right_num = $array[$x];
        $left_index = $x - 1;
        while($x >= 0 && $right_num < $array[$left_index]) {
            $array[$left_index + 1] = $array[$left_index];
            $left_index--;
        }
        $array[$left_index + 1] = $right_num;
    }
    
    return $array;
}

for($x = 0; $x < 10; $x++)
    $arr[] = rand(1, 100);

foreach($arr as $a)
    echo $a ." ";
echo "\n\n";

insertion_sort($arr);

foreach($arr as $a)
    echo $a ." ";
echo "\n\n";