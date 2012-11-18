// InvoiceTest.java
// Class to test Invoice Class, which will create
// an invoice for a customer's purchase (just the total)

public class InvoiceTest {	
	
	public static void main(String[] args) {
		
		Invoice invoice = new Invoice ( "2345", "Ladder", 3, 49.99 );
		
		System.out.printf( "You ordered %s %s(s) - (part #%s)\n", 
				invoice.getQuantity(), invoice.getDescription(), invoice.getPartNumber() );
		System.out.printf( "Your invoice total is: %s", invoice.getInvoiceAmount() );

	}

}
