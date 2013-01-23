<?php
/**
 * Theme:  	  silverOrchid
 * Theme URL: http://gazpo.com/2012/04/silverorchid 
 * Created:   April 2012
 * Author:    Sami Ch.
 * URL: 	  http://gazpo.com
 * 
 **/
 ?>
 
</div> <!-- content container -->
 
<div id="gazpo-footer">
	<div class="wrap">
		<div class="widgets_area">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer') ) ?>
		</div>
		
		<div class="info">
		<a href="http://www.teilin.net/">teilin.net</a> leverer teknologien bak <a href="http://www.utstyrsfreak.com/">U T S T Y R S F R E A K</a>. Bloggen skrives av © <a href="http://www.utstyrsfreak.com/">Utstyrsfreak</a> og er underlagt <a href="http://www.lovdata.no/all/nl-19610512-002.html">Lov om opphavsrett til åndsverk.</a> Det betyr at du ikke kan kopiere tekst, bilder eller annet innhold uten tillatelse. Forfatter er selv ansvarlig for innhold. Henvendelser kan rettes til <a href="mailto:post@utstyrsfreak.com">post@utstyrsfreak.com</a>. 
		</div>
	</div>	
</div><!-- /footer -->
</div><!-- /wrapper -->
<?php  
$gazpo_settings = get_option( 'gazpo_options');
	if ( isset($gazpo_settings['gazpo_tracking_code']) && ($gazpo_settings['gazpo_tracking_code']!="") ){
			echo(stripslashes ($gazpo_settings['gazpo_tracking_code']));
} 
?>
<?php wp_footer(); ?>
</body>
</html>
<!-- Theme by gazpo.com -->