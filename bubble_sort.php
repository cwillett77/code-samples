<? // Bubble sort

$arr = array();
$size = 10;

for($x = 0; $x < $size; $x++)
    $arr[] = rand(1, 100);

foreach($arr as $a)
    echo $a ." ";
echo "\n\n";



while($sorted == 0) {
    $first = 0;
    $next = 1;
    $sorted = 1;
    while ($next < $size) {
        if($arr[$first] > $arr[$next]) {
            $temp = $arr[$next];
            $arr[$next] = $arr[$first];
            $arr[$first] = $temp;
            $sorted = 0;
        } 
        $first = $next;
        $next++;            
    }
    $size--;
}
foreach($arr as $a)
    echo $a ." ";
echo "\n\n";
