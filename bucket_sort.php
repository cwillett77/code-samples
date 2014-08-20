<? // Bucket sort

$arr = array();
$size = 10;

for($x = 0; $x < $size; $x++)
    $arr[] = rand(1, 100);

foreach($arr as $a)
    echo $a ." ";
echo "\n\n";


for($x = 1; $x < 4; $x++) {
    
    $bucket = array();
    for($row = 0; $row < $size; $row++)
        $bucket[$row]= array();
       
    foreach($arr as $a) {
        
        $slot = (strlen($a) > 1) ? substr($a, -($x), 1) : 0;
        $single_digit = (!is_null($slot)) ? $slot : 0;
        $bucket[$single_digit][] = $a;           
        
    }
    $arr = array();
    foreach($bucket as $row) {
        foreach($row as $number) {
            $arr[] = $number;
        }
    }
}
foreach($arr as $a)
    echo $a ." ";
echo "\n\n";
