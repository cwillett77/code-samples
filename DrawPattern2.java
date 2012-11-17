// DrawPattern2.java
// Using drawLine draw 15 lines starting from 0,0 - 250,0 
// to 250,0 - 250,250, repeating in each corner, creating a spiral pattern

import java.awt.Graphics;
import javax.swing.JPanel;

public class DrawPattern2 extends JPanel {
	
	public static final long serialVersionUID = 0;
	
	// draws an X from the corners of the panel
	public void paintComponent( Graphics g )
	{
		
		// call paintComponent to ensure the panel displays correctly
		super.paintComponent( g );
		
		int width = getWidth(); // total width
		int height = getHeight(); // total height
		
		int widthStep = width / 15;
		int heightStep = height / 15;
		
		int x = 0;
		int y = 0;
		int x2 = 0;
		int y2 = height;
		
		for( int i = 0; i < 16; ++i ) {
			x2 += widthStep;
			y += heightStep;
			g.drawLine( x, y, x2, y2 );
		}
		
		x = 0;
		y = height;
		x2 = width;
		y2 = height;
		
		for( int i = 0; i < 16; ++i ) {
			x += widthStep;
			y2 -= heightStep;
			g.drawLine( x, y, x2, y2 );
		}	
		
		x = width;
		y = height;
		x2 = width;
		y2 = 0;
		
		for( int i = 0; i < 16; ++i ) {
			x2 -= widthStep;
			y -= heightStep;
			g.drawLine( x, y, x2, y2 );
		}	
		
		x = width;
		y = 0;
		x2 = 0;
		y2 = 0;
		
		for( int i = 0; i < 16; ++i ) {
			x -= widthStep;
			y2 += heightStep;
			g.drawLine( x, y, x2, y2 );
		}	
		
	} // end method paintComponent
} // end class DrawPanel
