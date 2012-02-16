<style>
<?php if( $website_data['submenu_item'] == 'slideshow'){?>
	
			#slide_boxes{
			width:235px;	
			}
				.slide_box_tab{
				padding-top:5px;
				float:left;
				border:1px dotted gray;
				width:30px;
				height:25px;
				margin-right:15px;
				text-align:center;
				color:gray;
				cursor:pointer;	
				}

<?php 

		$website_data['menu_item'] = 'slideshow';
		
		} 

?>

#picture_div{
	background:#F8F6F6;
	
	<?php if( isset($website_data['picture'][0]->id)  ){?>
		
  background-image: url(<?php echo base_url();    ?>uploads/pictures/<?php  echo $website_data['user_id']   ?>/<?php echo $website_data['picture'][0]->id; ?>/image.png?random=<?php  echo rand(5,123123)   ?>);
 
	<?php } ?>
 
  
  background-repeat: no-repeat;
  width: <?php  echo $website_data['picture_width']   ?>px;
  height: <?php  echo $website_data['picture_height']   ?>px;
  border:1px dashed gray;
  text-align:center;
  font-weight:bold;
  font-size:30px;
  color:darkgray;
  margin-top:20px;
  margin-bottom:20px;
}

#click_to_upload{
display:none;
width:150px;	
margin:110px auto 0px auto;
background:white;
filter:alpha(opacity=50);    /* ie  */
-moz-opacity:0.50;    /* old mozilla browser like netscape  */
-khtml-opacity: 0.50;    /* for really really old safari */
opacity: 0.50;    /* css standard, currently it works in most modern browsers like firefox,  */
}

#dialog{
display:none;	
}
		#dialog table#submit_jcrop_table{
			margin:14px; display:none
		}
		
				#dialog div#submit{
						text-align:center;
						font-size:18px;
						background:orange;
						color:white;
						width:100px
				}
				
		#dialog iframe#iframe_src_for_image{
			padding: 5px; 
			border: 1px solid lightgray;
			width:350px;
			height:50px;
			margin-top:13px;
			margin-left:5px;
		}	
		
		
</style>															
<div id="dialog" title="Upload Picture"     > 

		<table id='submit_jcrop_table' width='100%'    >
			<tr>
				<td width='55%' align=right>Crop image then&nbsp;&nbsp;</td>
				<td>
					<div id='submit' class='rounded_border cursor_pointer'    >
						submit
					</div>	
				</td>
			</tr>
		</table>

		<iframe id="iframe_src_for_image" frameborder="0" scrolling=no src=""  >
			
		    <p>Your browser does not support iframes.</p>
		    
		</iframe>			


</div>




<script type="text/javascript" language="Javascript">
	
tab_order = 0;
	
$(document).ready(function() {
	
				$('#picture_div').each(function(event) {
							$(this).css({'margin-left':(($(this).parent().width()/2) - ($(this).width()/2))-10})	
				});	
				
				
				<?php if( $website_data['submenu_item'] == 'slideshow' ){?>
					
				$('#slide_boxes').each(function(event) {
							$(this).css({'margin-left':(($(this).parent().width()/2) - ($(this).width()/2))})	
				});	
				
				$('#slide_boxes div[order="1"]').css({background:'orange'})
				
				$('#slide_boxes div').each(function(e) {
					
							$(this).click(function(event) {	
								
								tab_order = $(this).attr('order');
								
								$('#slide_boxes div').css({background:'none'})
								
								$('.spot_filled').css({background:'yellow'})
								
								$(this).css({background:'orange'})
								
										if( $(this).attr('picture_id') != 0){
											
												image_location ='url(<?php echo base_url()    ?>uploads/pictures/<?php  echo $website_data['user_id']   ?>/' + $(this).attr('picture_id') +  '/image.png?random=' + Math.floor(Math.random()*999999999) + ')';
																				
										}else{
												
												image_location ='url("")';
									
										};
										
								$('#picture_div')
										.attr('picture_id', $(this).attr('picture_id'))
										.attr('order', $(this).attr('order'))	
										.css({'background-image':image_location});
										
								if( $(this).attr('picture_id') != 0){		
									
										$('#picture_div').mouseover(function() {
												$(this).children().show();
										}).mouseout(function(){
												$(this).children().hide();
										}).children().html('Click to Change Picture')	
																		
								}else{
										
										$('#picture_div').unbind('mouseover').unbind('mouseout').children().show().html('Click to Upload Picture')
							
								};											
											
																			
										
							});	
				});	
						
				<?php } ?>
				

				$('#submit').click(function(event) {  // THIS IS FOR SUBMITTING JCROP
					document.getElementsByTagName('iframe')[0].contentWindow.submitCropForm();
				});

				$('#picture_div').css({cursor:'pointer'}).click(function(event) {
					open_dialogue_upload_image(
					 $(this).attr('picture_id'),
					 $(this).attr('order')
					);
				})
				
				
		<?php if( count($website_data['picture']) == 0 ){?>
			
			.children().show().html('Click to Upload Picture')
					
		<?php }else{?>
			
			.mouseover(function() {
					$(this).children().show();
			}).mouseout(function(){
					$(this).children().hide();
			}).children().html('Click to Change Picture')
			
			
		<?php } ?>


});		




function open_dialogue_upload_image( picture_id, order){


		$('#dialog table#submit_jcrop_table').css({display:'none'});
	
		if( picture_id == null){
			picture_id = 0;
		};
		
	
		$("#iframe_src_for_image")
		.css({width:'350px',height:'80px'})
		.attr('src','<?php echo base_url();    ?>index.php/main/upload_picture_form?menu_item=<?php echo $website_data['menu_item'] ?>&picture_id=' + picture_id + '&order=' + order);
			
		var width_of_dialog = 410;
		var left_coord = ($(window).width()/2 - width_of_dialog/2);

		$("#dialog" ).dialog({
			position:[left_coord,200],
			height: 160,
			zIndex: -10,
			width: width_of_dialog,
			resizable: false 
			})
						
};
						
function open_jcrop( picture_id ){ // called from inside iframe
	
	$("#iframe_src_for_image")
	.css({width:'940px',height:'420px'})
	.attr('src','<?php echo base_url();    ?>index.php/main/iframe_jcrop_form_for_picture?order=' + tab_order + '&menu_item=<?php echo $website_data['menu_item'] ?>&picture_id=' + picture_id + '&picture_width=<?php echo $website_data['picture_width']    ?>&picture_height=<?php echo $website_data['picture_height']    ?>');

	$( "#dialog" ).dialog({
		position:[6,10],
		height: 1150,
		height: 570,
		zIndex: -10,
		width: 990,
		resizable: false
		
		})	
		


};

function dialog_close(){
	$( "#dialog" ).dialog('close');
}


</script>
<?php
	$this->load->view('footer/jquery_ui_for_dialog.php');
?>
		<div  id='working_area'>	
			
			<?php if( $website_data['submenu_item'] == 'slideshow'){?>
			
						<div  id='slide_boxes'>
			
						<?php for( $i = 1 ; $i <= 5 ; $i++){?>

													<div picture_id=<?php 
										
															if( isset( $website_data['picture'][$i - 1] ) ){
																echo $website_data['picture'][$i - 1]->id;
															}else{
																echo 0;
															};
						
													?> class='slide_box_tab 
													
													<?php if( isset( $website_data['picture'][$i - 1] )){?>
													
													 	spot_filled  
													
													<?php } ?>' 
													
													order='<?php  echo $i   ?>'
													
													<?php if( isset( $website_data['picture'][$i - 1] )){?>
													
														style='background:yellow;'  
													
													<?php } ?>>
													
													<?php echo $i     ?>
													</div>
													
						<?php } ?>

						</div>
			
			<?php } ?>

			<div  id='picture_div' class='float_left '  order='1'  picture_id=<?php 
				
				if( count($website_data['picture']) > 0 ){
					echo $website_data['picture'][0]->id;
				}else{
					echo 0;
				};

				?>>
				
				<div  class='transparent_class '  id='click_to_upload'>
					
				</div>
				
			</div>
		</div>
		