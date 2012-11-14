// DuplicatesElimination.java
// Will remove duplicates from a list of user input first names
// and then allow the user to search for one
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Collection;
import java.util.Set;
import java.util.HashSet;
import java.util.Scanner;

public class DupElimination {

	public static void main(String[] args) {
		
		List< String > names = new ArrayList< String >();
		String input;
		Scanner scanner = new Scanner( System.in );
		
		System.out.println( "Enter a list of names, when you are done type 'done'.");
		System.out.println( "Enter a first name: "); // prompt user for input
		
		input = scanner.nextLine();
		
		while( !input.equalsIgnoreCase("done") )
		{ 
			//System.out.println( input );
			names.add( input );
			
			System.out.println( "Enter a first name: "); // prompt user for input
			input = scanner.nextLine();
		}
				
		printNonDuplicates ( names );
		
		Collections.sort( names );
		
		for ( String value : names )
			System.out.printf( "%s ", value );
		System.out.println();
		
		System.out.println( "Please enter a name you'd like to search for: ");
		String searchTerm = scanner.nextLine();
		
		search( names, searchTerm );

	}
	
	private static void search( List< String > list, String key )
	{
		int result = 0;
		
		System.out.printf( "\nSearching for: %s\n", key );
		result = Collections.binarySearch( list, key );
		
		if( result >= 0 )
			System.out.printf( "Found at index: %d\n", result );
		else 
			System.out.printf( "Not Found (%d)\n", result );
	}
	
	private static void printNonDuplicates( Collection< String > values )
	{
		Set< String > set = new HashSet< String >( values );
		
		System.out.println( "\nNonduplicates are: " );
		
		// generate output for each key in map
		for ( String value : set )
			System.out.printf( "%s ", value );
		
		System.out.println();
	}

}
