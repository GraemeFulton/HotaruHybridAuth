<?php     $widgetURL= BASEURL."content/plugins/hybridauth/widget/";?>

<script src="<?php echo $widgetURL; ?>js/jquery.min.js"></script> 

	<center>
		<table width="380" border="0" cellpadding="2" cellspacing="2">
			  <tr>
			<td valign="top" align="right">
				<img src="arrow.gif" align="texttop" style="margin-top:-5px;" >
			
				<!-- 
					LINK TO THE WIDGET 
						return_to: call back this page after authenticatin the user
						ts: nocache
				--> 
                                <?php  
        $widgetURL= BASEURL."content/plugins/hybridauth/widget/";?>
       <a href="<?php echo $widgetURL; ?>?_ts=<?php echo time(); ?>&return_to=/index.php?page=register"  class='widget_link' title="HybridAuth Social Sign On Widget">Or sign-in with another identity provider</a>
			</td>
		  </tr>
		</table> 
		
	</center> 
<!-- CODE REQUIRED BY THE WIDGET -->
	<link media="screen" rel="stylesheet" href="<?php echo $widgetURL; ?>css/colorbox.css" />
	<script src="<?php echo $widgetURL; ?>js/jquery.colorbox.js"></script> 
	<script>
	$(document).ready(function(){
	$(".widget_link").colorbox({iframe:true, innerWidth:430, innerHeight:222});
	}); 
	</script>
	<!-- /WIDGET -->