// Invoice.java
// A Class for creating invoices for a store

public class Invoice {
	
	private String partNumber;
	private String description;
	private int quantity;
	private double price;

	public Invoice ( String pPartNumber, String pDescription, 
			int pQuantity, double pPrice )
	{
		partNumber = pPartNumber;
		description = pDescription;
		quantity = pQuantity;
		price = pPrice;
	}
	
	public String getPartNumber()
	{
		return partNumber;
	}
	
	public void setPartNumber( String pPartNumber )
	{
		partNumber = pPartNumber;
	}
	
	public String getDescription()
	{
		return description;
	}
	
	public void setDescription( String pDescription )
	{
		description = pDescription;
	}
	
	public int getQuantity()
	{
		return quantity;
	}
	
	public void setQuantity( int pQuantity )
	{
		quantity = pQuantity;
	}
	
	public double getPrice()
	{
		return price;
	}
	
	public void setPrice( double pPrice )
	{
		price = pPrice;
	}
	
	public double getInvoiceAmount()
	{
		if( quantity < 0 )
			quantity = 0;
		if( price < 0.0 )
			price = 0.0;
		return quantity * price;
	}
	
}
