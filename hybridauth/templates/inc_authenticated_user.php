<?php     $widgetURL= BASEURL."content/plugins/hybridauth/widget/";
$image= BASEURL."content/plugins/hybridauth/templates/arrow.gif";
?>


		<table width="450" border="0" cellpadding="2" cellspacing="2">
			  <tr>
			<td valign="top" align="left">
				<img src="<?php echo $image?>" align="texttop" style="margin-top:-5px; width:30px;" >
			
			
				<!-- 
					LINK TO THE WIDGET 
						return_to: call back this page after authenticatin the user
						ts: nocache
				--> 
                                <?php  
        $widgetURL= BASEURL."content/plugins/hybridauth/widget/";?>
       <a href="<?php echo $widgetURL; ?>?_ts=<?php echo time(); ?>&return_to=/index.php?page=login"  class='widget_link' title="HybridAuth Social Sign On Widget">Sign in with your Social ID (Facebook, Twitter, LinkedIn, etc...)</a>
			</td>
		  </tr>
		</table> 
		<hr>
<!-- CODE REQUIRED BY THE WIDGET -->
	<link media="screen" rel="stylesheet" href="<?php echo $widgetURL; ?>css/colorbox.css" />
	<script src="<?php echo $widgetURL; ?>js/jquery.colorbox.js"></script> 
	<script>
	$(document).ready(function(){
	$(".widget_link").colorbox({iframe:true, innerWidth:430, innerHeight:222});
	}); 
	</script>
	<!-- /WIDGET -->
	
