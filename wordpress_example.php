<?
// include header.php file
get_header(); 
?>
<div class="main">
	
	<? 
	// include the top nav file
	include("nav.php");
	?>   
	<div class="content">
	
		<div class="left_col">
		
			<div id="news">
			
				<div class="section_head"><a href="/news/" class="section_title">news</a></div>
				<?
				// declare a global counter variable (used outside of loop as well)
				global $x;
				// reset loop
				wp_reset_query();
				// initialize counter variable
				$x=1;
				// query database for posts in specific categories
				query_posts(array('category__in'=>array(1,3,6)));
				// show the current post
				show_the_loop($x);
				// reset the loop
				wp_reset_query();
				?>
			</div>
			<div id="photos">
				<div class="section_head"><a href="/photos/" class="section_title">photos</a></div>
				<?
				// query database for specific posts tagged with carousel
				query_posts("tag=carousel");
				// enter loop and display posts
				while (have_posts()) : the_post(); ?>
				  <div class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
					  <? the_content(__('Continue reading &raquo;')); ?>
					</div>
				</div>
				<?
				endwhile; 
				// reset loop
				wp_reset_query();
				?><br /><br />
			</div>
		</div>
		<!-- Beginning of right sidebar -->
		<div class="right_col">
			<div id="videos" style="text-align:right">
				<! -- YouTube video -->
				<div class="section_head video_head"><a href="/videos/" class="section_title">videos</a></div>
				<object width="395" height="220">
				<param name="movie" value="http://www.youtube.com/v/tRws8o9NW5s?fs=1&amp;hl=en_US"></param>
				<param name="allowFullScreen" value="true"></param>
				<param name="allowscriptaccess" value="always"></param>
				<embed src="http://www.youtube.com/v/tRws8o9NW5s?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" 
				allowscriptaccess="always" allowfullscreen="true" width="395" height="220"></embed></object><br><br>
				
				<a href="/videos">more videos...</a>
				
			</div>
			<!-- 300x250 sidebar ad -->
			<div class="ga_banner_300x250">
				<script type="text/javascript"><!--
				google_ad_client = "ca-pub-3375353024183405";
				/* 300 x 250 Sidebar */
				google_ad_slot = "9754491072";
				google_ad_width = 300;
				google_ad_height = 250;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
				<!--adsensestart-->
			</div>
			<div id="mp3s" style="text-align:right">
				<div class="section_head"><a href="videos.php" class="section_title">mp3s</a></div>
				<ul>
					<li>Band: <a href="http://cdbaby.com/cd/flexie">Flexie</a></li>
					<li><a href="/wp-content//mp3s/MyRider.mp3s">My Rider</a></li>
					<li><a href="/wp-content//mp3s/Hyacinth.mp3s">Hyacinth</a></li>
				</ul>
				<ul>
					<li>Band: <a href="http://chemicalburnmusic.com/">Chemical Burn</a></li>
					<li><a href="/wp-content/mp3s/WithinMe.m4a">Within Me</a></li>
					<li><a href="/wp-content/mp3s/Leech.m4a">Leech</a></li>
					<li><a href="/wp-content/mp3s/BetterOffDead.m4a">Better Off Dead</a></li>
				</ul>
				<ul>
					<li>Band: <a href="http://www.erikasimonian.com/twentynine.html">Erika Simonian</a></li>
					<li><a href="/wp-content/mp3s/NYC.m4a">NYC</a></li>
					<li><a href="/wp-content/mp3s/BetweentheLines.m4a">Between the Lines</a></li>
				</ul>
				<a href="/wp-content/mp3s/">more mp3s...</a>
			</div>
		</div>
		<div class="cb"></div>
	</div>
</div>
<?
// include footer file
get_footer(); 
?>