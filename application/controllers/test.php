<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	
   public function __construct(){
        parent::__construct();

   }


	function html5player(){
	?>
	
	<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
	<script src="http://vjs.zencdn.net/c/video.js"></script>
	<video id="my_video_1" class="video-js vjs-default-skin" controls
	  preload="auto" width="640" height="264" poster="my_video_poster.png"
	  data-setup="{}">
	  <source src="<?php  echo base_url()   ?>images/pongo.mp4" type='video/mp4'>
	</video>
	
	<?php     
		
	}


	function palorama(){

		$objects = $this->CI->my_database_model->select_from_table( 
			$table = 'users_objects', 
			$select_what = 'id, rate',    
			$where_array = array(
				'user_id' => $this->user_id
			), 
			$use_order = TRUE, 
			$order_field = 'user_id', 
			$order_direction = 'asc', 
			$limit = -1
			);		

		foreach( $objects  as  $key => $object){
			
				if( $object->rate <= 2){  // IF USER LIKES OR REALLY LIKES
					
						$users_object = $this->CI->my_database_model->select_from_table( 
							$table = 'users_objects', 
							$select_what = 'user_id',    
							$where_array = array(
								'object_id' => $object->id,
								'rate <=' => 2,
							), 
							$use_order = TRUE, 
							$order_field = 'user_id', 
							$order_direction = 'asc', 
							$limit = -1
							);					
							
				}elseif( $object->rate  >= 3 && $object->rate != 5){  // IF USER DISLIKES OR HATES, IGNORING NO OPINION
					
						$users_object = $this->CI->my_database_model->select_from_table( 
							$table = 'users_objects', 
							$select_what = 'user_id',    
							$where_array = array(
								'object_id' => $object->id,
								'rate >=' => 3,
							), 
							$use_order = TRUE, 
							$order_field = 'user_id', 
							$order_direction = 'asc', 
							$limit = -1
							);						
					
				};

				foreach( $users_object  as  $user){
					$users_set[] = $user->user_id;
				};
				
				$user_sets[$key] = $users_set;
				
				if( isset( $user_sets[$key - 1] ) ){
					
						$user_sets[$key] = $this->custom->intersect_array(
							$user_sets[$key],
							$user_sets[$key - 1]
						);					
						
				};

		}

		echo '<pre>';print_r( $user_sets[$key]  );echo '</pre>';  exit;  
		
	}
	
	/*  NEW FORMULA */
	
	function palorama2(){
		
		$objects = $this->CI->my_database_model->select_from_table( 
			$table = 'users_objects', 
			$select_what = 'id, rate',    
			$where_array = array(
				'user_id' => $this->user_id
			), 
			$use_order = TRUE, 
			$order_field = 'user_id', 
			$order_direction = 'asc', 
			$limit = -1
			);		

			foreach( $objects  as  $object){
				
				$array_of_users_objects[] = $object[0]->id;

			}


		$users_preferences =  $this->my_database_model->select_from_table( 
			$table = 'users_objects', 
			$select_what = 'user_id, object_id, rate',    
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'user_id, object_id', 
			$order_direction = 'asc', 
			$limit = -1, 
			$use_join = FALSE, 
			$join_array = array(), 
			$group_by_array = array(),
			$or_where_array = array(),
			$use_wherein = TRUE,
			$where_in = array(
				'object_id' => $array_of_users_objects
				)			
			);
			
		$users_preferences = $this->CI->tools->object_to_array($users_preferences);
			
		$previous_id = -1;

		foreach( $users_preferences  as $users_preference){
			
			$count++;
			
			if( $users_preference['user_id'] == $previous_id || $previous_id == -1){

					foreach( $users_preference  as  $field => $value){
		 
						 	if( $field == 'object_id'){
						 			$array[$field] = $value;
							}else{
									$objects[] = $value;
							};
						
					}

			}else{

					$array['objects'] = $objects;	
					unset($objects);			
					$users_preference[$object_types[  $previous_id  ]] = $array;					
			
					foreach( $users_preference  as  $field => $value){
		 
						 	if( $field != 'object_id'){
						 			$array[$field] = $value;
							}else{
									$objects[] = $value;
							};
						
					}					

			};
			
			$previous_id = $users_preference['user_id'];			

		}
		
		if( $count ==  count($users_preferences) ){

						$array['objects'] = ( isset($objects ) ? $objects :array());				
						$users['objects'] = $array;
	
		};
		
		//$users[] = $users[ ???  ]; 
		
		
		foreach( $users  as  $user){
			
			foreach( $user['objects']  as  $object){
				
				if( $object['rate'] > 0){
					
				}else{
					
				};
				
			}
			
		}

		
	}

	function mytest(){
		
		
				$this->user_id = 1;
				$this->thumbnail_size_width  = '181';
				$this->thumbnail_size_height = '120';
				$this->thumbnail_panel_width = '755';	
				$this->top_direction_arrow = '62';			
		
?>

<script type="text/javascript" 
        src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
 
  google.load("jquery", "1.6.4");
 	// google.load("jqueryui", "1.8.16");

</script>
<script type="text/javascript" language="Javascript">
$(document).ready(function() { 
	
});
</script>
<form 
	id='form_image' 
	method='POST' 
	enctype='multipart/form-data' 
	action='<?php echo base_url();    ?>index.php/home/upload'
	>
	<input  id='image_type_id' name="image_type_id"  type="" value="0">
	<input  id='image_id' name="image_id"  type="" value="">
	<input  id='li_index' name="li_index"  type="" value="-1">
	<input type="file"  id='Filedata' name="Filedata"  value="" >
	<input id="submit_button" type="submit" value="submit">
</form>	
<?php     
	}


	public function index(){
		$select_what =  '*';
		
		$where_array = array('id !=' => 16);

		$fonts = $this->my_database_model->select_from_table(
			$table = 'fonts', 
			$select_what, 
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'id', 
			$order_direction = 'asc', 
			$limit = 10
			);

		
		$users = $this->query->get_users(
			'users',
			$where_array = array(
				'users.id' => $this->user_id
			)	
		);
		


		$data = array(
			'users' => $users,
			'fonts' => $fonts,
			'thumbnail_size_width' => $this->thumbnail_size_width,
			'thumbnail_size_height' => $this->thumbnail_size_height,
			'thumbnail_panel_width' => $this->thumbnail_panel_width,
			'thumbnail_panel_width' => $this->thumbnail_panel_width,
			'top_direction_arrow' => $this->top_direction_arrow,
			'user_id' => $this->user_id
		);

		$this->load->view('test/index_view',
					array('data' => $data));	
		
	}
	
	
	public function jtest(){
		
     ?>
<style>  
.jcarousel-skin-tango .jcarousel-container {
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
   border-radius: 10px;
    background: #F0F6F9;
    border: 1px solid #346F97;
}

.jcarousel-skin-tango .jcarousel-direction-rtl {
	direction: rtl;
}

.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 245px;
    padding: 20px 40px;
}

.jcarousel-skin-tango .jcarousel-container-vertical {
    width: 75px;
    height: 245px;
    padding: 40px 20px;
}

.jcarousel-skin-tango .jcarousel-clip {
    overflow: hidden;
}

.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width:  245px;
    height: 75px;
}

.jcarousel-skin-tango .jcarousel-clip-vertical {
    width:  75px;
    height: 245px;
}

.jcarousel-skin-tango .jcarousel-item {
    width: 75px;
    height: 75px;
}

.jcarousel-skin-tango .jcarousel-item-horizontal {
	margin-left: 0;
    margin-right: 10px;
}

.jcarousel-skin-tango .jcarousel-direction-rtl .jcarousel-item-horizontal {
	margin-left: 10px;
    margin-right: 0;
}

.jcarousel-skin-tango .jcarousel-item-vertical {
    margin-bottom: 10px;
}

.jcarousel-skin-tango .jcarousel-item-placeholder {
    background: #fff;
    color: #000;
}

/**
 *  Horizontal Buttons
 */
.jcarousel-skin-tango .jcarousel-next-horizontal {
    position: absolute;
    top: 43px;
    right: 5px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: transparent url(next-horizontal.png) no-repeat 0 0;
}

.jcarousel-skin-tango .jcarousel-direction-rtl .jcarousel-next-horizontal {
    left: 5px;
    right: auto;
    background-image: url(prev-horizontal.png);
}

.jcarousel-skin-tango .jcarousel-next-horizontal:hover,
.jcarousel-skin-tango .jcarousel-next-horizontal:focus {
    background-position: -32px 0;
}

.jcarousel-skin-tango .jcarousel-next-horizontal:active {
    background-position: -64px 0;
}

.jcarousel-skin-tango .jcarousel-next-disabled-horizontal,
.jcarousel-skin-tango .jcarousel-next-disabled-horizontal:hover,
.jcarousel-skin-tango .jcarousel-next-disabled-horizontal:focus,
.jcarousel-skin-tango .jcarousel-next-disabled-horizontal:active {
    cursor: default;
    background-position: -96px 0;
}

.jcarousel-skin-tango .jcarousel-prev-horizontal {
    position: absolute;
    top: 43px;
    left: 5px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: transparent url(prev-horizontal.png) no-repeat 0 0;
}

.jcarousel-skin-tango .jcarousel-direction-rtl .jcarousel-prev-horizontal {
    left: auto;
    right: 5px;
    background-image: url(next-horizontal.png);
}

.jcarousel-skin-tango .jcarousel-prev-horizontal:hover, 
.jcarousel-skin-tango .jcarousel-prev-horizontal:focus {
    background-position: -32px 0;
}

.jcarousel-skin-tango .jcarousel-prev-horizontal:active {
    background-position: -64px 0;
}

.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal,
.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal:hover,
.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal:focus,
.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal:active {
    cursor: default;
    background-position: -96px 0;
}

/**
 *  Vertical Buttons
 */
.jcarousel-skin-tango .jcarousel-next-vertical {
    position: absolute;
    bottom: 5px;
    left: 43px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: red;
}

.jcarousel-skin-tango .jcarousel-next-vertical:hover,
.jcarousel-skin-tango .jcarousel-next-vertical:focus {
    background-position: 0 -32px;
}

.jcarousel-skin-tango .jcarousel-next-vertical:active {
    background-position: 0 -64px;
}

.jcarousel-skin-tango .jcarousel-next-disabled-vertical,
.jcarousel-skin-tango .jcarousel-next-disabled-vertical:hover,
.jcarousel-skin-tango .jcarousel-next-disabled-vertical:focus,
.jcarousel-skin-tango .jcarousel-next-disabled-vertical:active {
    cursor: default;
    background-position: 0 -96px;
}

.jcarousel-skin-tango .jcarousel-prev-vertical {
    position: absolute;
    top: 5px;
    left: 43px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: blue;
}

.jcarousel-skin-tango .jcarousel-prev-vertical:hover,
.jcarousel-skin-tango .jcarousel-prev-vertical:focus {
    background-position: 0 -32px;
}

.jcarousel-skin-tango .jcarousel-prev-vertical:active {
    background-position: 0 -64px;
}

.jcarousel-skin-tango .jcarousel-prev-disabled-vertical,
.jcarousel-skin-tango .jcarousel-prev-disabled-vertical:hover,
.jcarousel-skin-tango .jcarousel-prev-disabled-vertical:focus,
.jcarousel-skin-tango .jcarousel-prev-disabled-vertical:active {
    cursor: default;
    background-position: 0 -96px;
}
</style>
	<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
	<script src="http://sorgalla.com/projects/jcarousel/lib/jquery.jcarousel.min.js"></script> 

<script type="text/javascript" language="Javascript">
	function carousel_callback( carousel, state) {
		
		    if (state != 'init')
		    return;

				//carousel.size( 0 )
				
				$('#reset-caro').click( function( evt ) {
					carousel.reset();
				});
				
				$('#go').click(function(event) {

						carousel.scroll(parseInt($('#see').val()),true);
				});	
				
				$('#add-to').click( function( evt ) {
				
					if( carousel.size() > -1 ){
						carousel.size( carousel.size() + 1)
					}else{
						carousel.size( 0 )
					};
					
					carousel.add(  (carousel.size()) , "<li>" + (carousel.size()) +"</li>");					
					
					$('#see2').val(carousel.size())
					

				  carousel.scroll(parseInt(carousel.size()),true);
				});
				
				$('#remove').click( function( evt ) {
	
					var li_array = new Array();

					var e = carousel.get(  $('#see').val() );

					theParent = e.parent()
					theChildren = e.parent().find("li");


	        var count = 0; 
	        $.each(theChildren,function(){
	        		if( $(this).attr('jcarouselindex') != $('#see').val() ){
	          	 	$(this).removeAttr("class").removeAttr("jcarouselindex");
	              li_array[count] = $(this); 	 
	              count++;       			
	        		}
	            
	        });
	        

	        carousel.reset();
					
          count = 1;

          $.each(li_array, function(key, value){

              if(value != null) {
                 	carousel.add(count,  value);
                  count++;
              }
          });
          

					carousel.size( li_array.length)          
          
					
					$('#see2').val(carousel.size())
					
					carousel.reload()
					

				});	

	}
	
	
	
	
	
	$(document).ready(function() {

	    $('#mycarousel').jcarousel( {
	        initCallback: carousel_callback,
	        
	    });
	    
   	    

	});	
</script>
  <a id="reset-caro" href="#">reset</a>

  <a id="add-to" href="#">add</a>  
  <a id="remove" href="#">remove</a> 
  <a id="go" href="#">go</a> 
  <input id="see" type="" value=""> 
  <input id="see2" type="" value=""> 

  <ul id="mycarousel" class="jcarousel-skin-tango">
    <li><img src="http://static.flickr.com/66/199481236_dc98b5abb3_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/75/199481072_b4a0d09597_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/57/199481087_33ae73a8de_s.jpg" width="75" height="75" alt="" /></li>
  	<li><img src="http://static.flickr.com/77/199481108_4359e6b971_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/58/199481143_3c148d9dd3_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/72/199481203_ad4cdcf109_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/58/199481218_264ce20da0_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/69/199481255_fdfe885f87_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/60/199480111_87d4cb3e38_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/70/229228324_08223b70fa_s.jpg" width="75" height="75" alt="" /></li>
  </ul>
     <?php   
	}
	

function x(){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us">
<head>
<title>jCarousel Examples</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<!--
<script type="text/javascript" src="http://sorgalla.com/projects/jcarousel/lib/jquery-1.4.2.min.js"></script>
-->
<script type="text/javascript" 
        src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
 
  google.load("jquery", "1.4.2");
 	

</script>
<script src="http://sorgalla.com/projects/jcarousel/lib/jquery.jcarousel.min.js"></script> 
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="http://sorgalla.com/projects/jcarousel/skins/tango/skin.css" />

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});

</script>

</head>
<body>
<div id="wrap">
  <h1>jCarousel</h1>
  <h2>Riding carousels with jQuery</h2>

  <h3>Simple carousel</h3>
  <p>
    This is the most simple usage of the carousel with no configuration options.
  </p>

  <ul id="mycarousel" class="jcarousel-skin-tango">
    <li><img src="http://static.flickr.com/66/199481236_dc98b5abb3_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/75/199481072_b4a0d09597_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/57/199481087_33ae73a8de_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/77/199481108_4359e6b971_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/58/199481143_3c148d9dd3_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/72/199481203_ad4cdcf109_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/58/199481218_264ce20da0_s.jpg" width="75" height="75" alt="" /></li>

    <li><img src="http://static.flickr.com/69/199481255_fdfe885f87_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/60/199480111_87d4cb3e38_s.jpg" width="75" height="75" alt="" /></li>
    <li><img src="http://static.flickr.com/70/229228324_08223b70fa_s.jpg" width="75" height="75" alt="" /></li>
  </ul>

</div>
</body>
</html>


<?php     
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/test.php */