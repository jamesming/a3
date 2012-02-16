
<script type="text/javascript" language="Javascript">
	
					$(document).ready(function() { 
						
						if(  window.parent.document.getElementById('top_edit_frame')  &&  window.parent.top_edit_frame.$('#switch').val() == 0){  // EDIT MODE
					  	
					  	$('.wysiwyg_div_link').css({cursor:'pointer', background:'lightyellow'}).fancyZoom().click(function(event) {
					  		
					  		if( window.parent.bottom_edit_frame.document.getElementById('dialog') ){
					  				window.parent.bottom_edit_frame.$( "#dialog" ).dialog('close')
					  		}
					  		window.parent.bottom_edit_frame.$("#embed_video").css({visibility:'hidden'});
								$("#div_id_to_edit").val($(this).attr('id'));
								$("#iframe_content_text").attr('src','<?php echo base_url();    ?>index.php/dashboard/wysiwyg');
							});
					  	
						}else{
							
							$('.wysiwyg_div_link:not(#full_name, #title)').css({background:'ivory', border:'3px solid <?php echo $contents[0]->header_background_color;    ?>'});
							
						};
						
	
					});  // END $(document).ready(function()


</script>

<div id="wysiwyg_div"  style='
			<?php if( $this->tools->browserIsExplorer()){?>
				height:580px;
			<?php }else{?>
				height:560px;
			<?php };?>display:none'  >
	<iframe id="iframe_content_text" scrolling="no"  style="
		width:650px;
	<?php if( $this->tools->browserIsExplorer()){?>
		height:557px;
	<?php }else{?>
		height:555px;
	<?php };?>
		margin: 0; 
		padding: 0; 
		border: 0px solid black;
		" 
		frameborder="0" src=""  >
		
	    <p>Your browser does not support iframes.</p>
	    
	</iframe>
</div>		

<input id="div_id_to_edit" type="hidden" value="">