<script type="text/javascript" language="Javascript">
					$(document).ready(function() {

						$('.bottom_links').click(function(event) {
							redirect_bottom_link_to($(this));
						});		
						
						
						$('body').css({background:'url(<?php  echo base_url();   ?>images/textures/<?php echo $contents[0]->background_texture;    ?>) repeat'});			
						
						
						
					});
					
					function redirect_bottom_link_to(element){
						document.location.href='<?php echo  base_url();   ?>index.php/splash/' + element.attr('id');
					}
</script>

<style>
	div#splash_links{
		margin-top:30px;
		border:0px solid black;
	}
	div#splash_links ul{
		margin-left:auto;
		margin-right:auto;
		width:900px;
	}	
	div#splash_links li{
		border:0px solid white;
		list-style:none;
		float:left; 
		width:120px; 
		height:auto;
		font-weight:bold;
		cursor:pointer;
		text-align:center;
		color:#585858;
	}		
</style>


<div id='splash_links' class=' container'   style='padding-bottom:20px'  >
	
			<ul      >
				<li id='home'  class='bottom_links' >Home</li>		
				<li id='about_us'  class='bottom_links'  >About Us</li>						
				<li id='our_team'   class='bottom_links' >Our Team</li>
				<li id='terms'   class='bottom_links' >Terms</li>
				<li id='contact'   class='bottom_links' >Contact</li>
				<li id='features'   class='bottom_links' >Features</li>
				<li id='privacy'   class='bottom_links' >Privacy</li>
<!--				<li id='main'   class='bottom_links' >Main</li>-->
			</ul>			

</div>
	

<?php  
//	$this->load->view('footer/wysiwyg_jquery_with_iframe.php');   
//	$this->load->view('footer/fancy_zoom.php');   
//	$this->load->view('footer/growl_purr.php');
//	$this->load->view('footer/jquery_ui_for_dialog.php');
?>