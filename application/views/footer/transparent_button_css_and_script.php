<style>
.transparent_button{
border-right:0px solid darkgray;
border-bottom:0px solid darkgray;
width:70px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
cursor:pointer;
}
.top_transparent_button{
	background:green;
	height:31px;
	width:100%;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}
.bottom_transparent_button{
	height:50%;
	background:white;
	filter:alpha(opacity=25);    /* ie  */
	-moz-opacity:0.25;    /* old mozilla browser like netscape  */
	-khtml-opacity: 0.25;    /* for really really old safari */
	opacity: 0.25;    /* css standard, currently it works in most modern browsers like firefox,  */
}
.middle_transparent_button{
    color: white;
    font-size: 14px;
    font-weight: bold;
    margin-top: -10px ;
    float:left;
}
</style>
<script type="text/javascript" language="Javascript">
$(document).ready(function() {	
//	$('.middle_transparent_button').css({'margin-left':($('.transparent_button').width()-$('.middle_transparent_button').width())/2+'px'})
//


//		$('.top_transparent_button').each(function(event) {
//					
//					height_of_transparent_top = $(this).height();
//			
//					$(this).mouseover(function() {
//											
//							$(this).css({
//								'padding-top':$(this).children('.bottom_transparent_button').height(),
//								height:$(this).children('.bottom_transparent_button').height()
//								})
//							$(this).children('.bottom_transparent_button').css({
//								height:$(this).height()
//								})	
//								
//							$(this).children('.middle_transparent_button').css({'margin-top':'-25px'}) 
//			
//											
//					}).mouseout(function(){
//							
//							$(this).css({
//								'padding-top':'0px',
//								height:height_of_transparent_top
//								})
//							$(this).children('.bottom_transparent_button').css({
//								height:'50%'
//								})	
//				
//							$(this).children('.middle_transparent_button').css({'margin-top':'-10px'}) 
//			
//					});
//					
//		});	





});	
</script>

<!--  		
				<div   class='transparent_button'  >
						<div  class='top_transparent_button ' >
							<div  class='bottom_transparent_button' >
					
							</div>
								<div  class='middle_transparent_button' >
									Submit
								</div>
						</div>					
				</div>
-->									