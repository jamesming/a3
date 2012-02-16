<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
<?php     	$this->load->view('header/common_css.php');  ?>
<style>
body{
	 background:#E2E2E2;
}
#logo{
width:134px;
margin:0px auto;
padding: 21px 0px 10px;	
}

#box_section{
margin-top: 20px;
}

		#box_section  .middle{
		min-height:298px;
		}


					#box_section div.one_third_column{
					    margin-top:50px;
					}
		
								#box_section  div.one_third_column .middle div#box_inside_header{
								    color: gray;
								    font-size: 19px;
								    font-weight: bold;
								    height: 28px;
								    padding-left: 0px;
								    padding-top: 12px
								}





										div#signup_image{
									    background-image: url(<?php  echo base_url()   ?>images/submit.png);
									    background-position: center center;
									  	background-repeat: no-repeat;
									    color: white;
									    cursor: pointer;
									    font-size: 17px;
									    font-weight: bold;
									    height: 45px;
									    padding-top: 18px;
									    text-align: center;
									    width: 129px;
									    margin-left:55px;
										}



</style>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
</head>

<html>

<body>

	
<div id='top_body'  class='  clearfix' >

							

								<div   class=' container_inside   margin_top' >
									
										<div id='box_section'  class='float_left' >
											
											
												<div class='one_third_column'  >
													
													
													<div  class=' rounded_bg' >
														<div class="top">
															<div class="sub_top">&nbsp;</div>
														</div>
													  <div class="middle">
													  	
																<div id='logo' >
																	SPORTCARD LOGO
															
																</div>
																<div  class='wrapper '   style='margin:0px 0px 0px 30px;'  >	
																	

																		
																		<div id='box_inside_header' class=' header_style' >
																									Log In	<span  class='or_redirect ' >&nbsp;(or <a href='<?php  echo base_url()   ?>index.php/home/register'>Sign Up</a>)</span>							
																		</div>
																																					  	
																																					  	
																		<div    id='box_inside'  class="clearfix ">
																																									
																		<form id='form0' name='form0' action='<?php echo base_url()    ?>index.php/home/login' method='post'>
																								
																							<div class='user_info_inner_box float_left' >
																									
									
								
				<div   id='email_wrapper'  class=' input_wrapper' >
							<div  class='input_label_header' >
								Email
							</div>
							<div  class='input_background input_250 ' >
								<input name="email" id="email" type="" value=""  >
							</div>
							
							<div  class='error_message' >
									
							</div>	
										
				</div>
									
				<div   id='password_wrapper'   class=' input_wrapper'>
							<div  class='input_label_header' >
								Password
							</div>
							<div  class='input_background input_250 ' >
								<input name="password" id="password" type="password" value=""  >
							</div>
							
							<div  class='error_message' >

							</div>	
										
				</div>																							



				
				
				<div  class='clearfix'   style='margin:20px 0px 20px 0px;'  >
					<div id='signup_image'>
						Sign In
					</div>
				</div>
				
																													
																							</div>
																								
																		</form>
																		
																		
																		
																</div>
						







		
																	
																</div> <!-- END WRAPPER  -->
															
															
														</div>
														<div class="bottom"><div class="sub_bottom">&nbsp;</div></div>
													</div>							
													
												</div>
												
												
												
			
									
									
										</div>
										
										
										

										
										
										
									
										
								</div>
							


					
				</div>




</body>


<script type="text/javascript" language="Javascript">
$(document).ready(function() {
	
	
		$('#logo').click(function(event) {			
						document.location.href='<?php echo  base_url();   ?>';
		});	
	
	
		$('#signup_image').click(function(event) {
			$('#form0').submit();
		});		
		
		$('input').click(function(event) {
			$('.error_message').text('');
		});		
	
		$('.one_third_column').css({'margin-left':get_margin_left_for( $('.one_third_column'), moveLeftFromCenter = 0)})


		<?php if( isset($validation)   ){?>
			
				$('#<?php echo $validation['key']    ?>').parent().parent().children('div.error_message').text('<?php echo $validation['message']    ?>')
				
		<?php } ?>

		
		<?php
		
			if( isset($post_array)){
					 foreach($post_array as  $key => $value ){?>
						
							$('#<?php echo  $key   ?>').val('<?php echo $value    ?>');
						
					<?php } 
			};
			
		?>




});		

half_width_of_browser_window = $(window).width() /2 ;

function get_margin_left_for( dom_obj, moveLeftFromCenter ){
	
		half_width_of_profile_picture_outer_container =  dom_obj.width()/2;
		
		margin_left_for_centering_dom_obj = half_width_of_browser_window - half_width_of_profile_picture_outer_container;
		
		return margin_left_for_centering_dom_obj - moveLeftFromCenter;
	
}

</script>
</html>

