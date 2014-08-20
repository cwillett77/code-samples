<?
// Recursive Merge Sort Function
function merge_sort( $arr ) {

    // if array is only one element, no need to sort it, just return it
    if ( sizeof ( $arr ) == 1 )
    	return $arr;
    	
    // slice off second half of array and stick it in $arr2
    $arr2 = array_splice( $arr, ( sizeof( $arr ) / 2 ) );
    
    // recursively merge, sort and return
    return merge( merge_sort( $arr ), merge_sort( $arr2 ) );
    
}

// Function to merge two arrays 
function merge( $arr1, $arr2 ) {
    
    // initialize  output array
    $output = array();
    
    // loop through the arrays until they are both empty
    while( !empty( $arr1 ) || !empty( $arr2 ) ) 
    	
    	// if one of the arrays is empty, insert the last value into $output
    	if ( empty( $arr1 ) || empty( $arr2 ) )
    		$output[] = ( empty( $arr2 ) ) ? array_shift( $arr1 ) : array_shift( $arr2 );
    		
    	// both arrays still have elements, so continue evaluating
    	else 
    		$output[] = ( $arr1[ 0 ] <= $arr2[ 0 ] ) ? array_shift( $arr1 ) : array_shift( $arr2 );
    
    // return the output array	
    return $output;
}

$output = merge_sort( array( 12, 59, 44, 1, 99, 13, 29 ) );
print_r($output); 
?>

