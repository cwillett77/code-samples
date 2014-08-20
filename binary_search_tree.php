<?
function tree(array $data, &$tree = array(), $level = 0) {
    // init
    if (!isset($tree[$level])) $tree[$level] = array();

    foreach ($data as $key => $value) {
        // if value is an array, push the key and recurse through the array
        if (is_array($value)) {
            $tree[$level][] = $key;
            tree($value, $tree, $level+1);
        }

        // otherwise, push the value
        else {
            $tree[$level][] = $value;
        }
    }
}

$binary_tree = array(1 => array(2 => array(4,5),4=>array(5,6)));
tree($binary_tree, $output);
var_dump($output);