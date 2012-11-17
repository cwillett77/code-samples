// DrawPattern.java
// Using drawLine draw 15 lines from 0,0 to endpoints that span
// from lower left corner to upper right corner.

import java.awt.Graphics;
import javax.swing.JPanel;

public class DrawPattern extends JPanel {
	
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
		
		int y = height;
		int x = 0;
		
		for( int i = 0; i < 16; ++i ) {
			y -= heightStep;
			x += widthStep;
			g.drawLine( 0, 0, x, y );
		}
		
		y = 0;
		x = 0;
		
		for( int i = 0; i < 16; ++i ) {
			y += heightStep;
			x += widthStep;
			g.drawLine( 0, height, x, y );
		}
		
		y = height;
		x = 0;
		
		for( int i = 0; i < 16; ++i ) {
			y -= heightStep;
			x += widthStep;
			g.drawLine( width, height, x, y );
		}
		
		y = 0;
		x = 0;
		
		for( int i = 0; i < 16; ++i ) {
			y += heightStep;
			x += widthStep;
			g.drawLine( width, 0, x, y );
		}
			
		
		
	} // end method paintComponent
} // end class DrawPanel

