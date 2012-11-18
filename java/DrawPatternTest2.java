// DrawPatternTest2.java
// Application to display a DrawPattern2.
import javax.swing.JFrame;

public class DrawPatternTest2 {

	public static void main(String[] args) 
	{
		// create a panel that contains our drawing
		DrawPattern2 panel = new DrawPattern2();
		
		// create a new frame to hold the panel
		JFrame application = new JFrame();
		
		// set the frame to exit when it's closed
		application.setDefaultCloseOperation( JFrame.EXIT_ON_CLOSE );
		
		application.add( panel ); // add the panel to the frame
		application.setSize( 250, 250 ); // set the size of the frame
		application.setVisible( true ); // make the frame visible

	} //end main

} //end class DrawPanelTest
