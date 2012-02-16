<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes extends CI_Controller {
	
	
   public function __construct(){
   	
        parent::__construct();
        
        $this->load->library('custom');
        
        if(  isset( $this->session->userdata['user_id'] )  ){
        	
        	$this->users = $this->custom->get_users( $this->session->userdata['user_id'] );
        	
					$this->getWebsiteData();
					
					

        }else{
        	
					
	        	
	      };
   }
   

   public function index(){

   				$this->users = $this->custom->get_users_from_profile_url( 
   					$profile_url = $this->uri->segment(1) 
   				);
   				
   				if( count($this->users) == 0)exit;
  
        	$this->name = $this->users[0]->full_name; 
        	
					$this->getWebsiteData();

					$this->load->library('curl');
					$geo_location =  $this->curl->simple_get('http://api.ipinfodb.com/v3/ip-city/?key=a644434b1b3c5ccc56d42931601df57c3ca668e40cb5bcc81be426e87ca10f51&ip=' . $_SERVER['REMOTE_ADDR']);
												
					$geo_array = explode(';',$geo_location);
	
						$this->custom->insert_page_views( 
							array(
								'ip_address' => $geo_array[2],
								'country' => $geo_array[4],
								'state' => $geo_array[5],
								'city' => $geo_array[6],
								'user_id' => $this->users[0]->id
								)
						 );
   	

   				$this->name = $this->users[0]->full_name;

							switch ( $this->users[0]->template_id ) {
								
							   			case '1':
							    		$this->bluejean(); 
							        break;
							        
							   			case '2':
							    		$this->brownbag(); 
							        break;
							        
							   			case '3':
							    		$this->ransom(); 
							        break;
							        
							   			case '4':
							    		$this->sideways(); 
							        break;	
							        
							   			case '5':
							    		$this->cardboard(); 
							        break;		
							        
							   			case '7':
							    		$this->classic(); 
							        break;							        
							        
							}

   }
   

	/**
	 * getWebsiteData
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access private
	 **/ 
   private function getWebsiteData(){
   	
   				if( $this->input->get('tab') == ''){
   					$this->website_data['tab'] = 'home';
   				}else{
	   				$this->website_data['tab'] = $this->input->get('tab');
   				};
   	
   	      $this->website_data['users'] = $this->users;
        	
					$this->website_data['photos'] = $this->custom->getPhotos( $user_id = $this->users[0]->id);

					$this->website_data['reels'] = $this->custom->getreels( $user_id = $this->users[0]->id);

						$pictures['home'] = $this->custom->getPicture( $user_id = $this->users[0]->id,  'home');
						$pictures['slideshow'] = $this->custom->getPicture( $user_id = $this->users[0]->id,  'slideshow');
						$pictures['bio'] = $this->custom->getPicture( $user_id = $this->users[0]->id,  'bio');
						$pictures['press'] = $this->custom->getPicture( $user_id = $this->users[0]->id,  'press');
						$pictures['links'] = $this->custom->getPicture( $user_id = $this->users[0]->id,  'links');
						$pictures['contact'] = $this->custom->getPicture( $user_id = $this->users[0]->id,  'contact');						
					
					$this->website_data['picture'] = $pictures;
					
					$this->website_data['social_icons'] = $this->custom->get_social( $this->users[0]->id );

					$this->website_data['menus']['home'] = 'Home';

					if( $this->website_data['users'][0]->bio_checkbox == 1){
							$this->website_data['menus']['bio'] = 'Bio';
					};
					if( $this->website_data['users'][0]->photos_checkbox == 1){
							$this->website_data['menus']['photos'] = 'Gallery';
					};
					if( $this->website_data['users'][0]->reels_checkbox == 1){
							$this->website_data['menus']['reels'] = 'Video';
					};
					if( $this->website_data['users'][0]->resume_checkbox == 1){
							$this->website_data['menus']['resume'] = 'Resume';
					};		
					if( $this->website_data['users'][0]->press_checkbox == 1){
							$this->website_data['menus']['press'] = 'Press';
					};
					if( $this->website_data['users'][0]->links_checkbox == 1){
							$this->website_data['menus']['links'] = 'Links';
					};		
					$this->website_data['menus']['contact'] = 'Contact';
					
					
					


   }
   
   
   
   
 
	 
	 
	/**
	 * classic
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/bluejean
	 * @access public
	 **/ 


	public function classic(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'Vegur');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$select_what =  'name, code';
		
		$where_array = array('name' => 'Journal');

		$font_2 = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
	
		$font[] = $font_2[0];
		
	
	
		$this->load->view('themes/basic/classic/index_view', 
		array(
			'font' => $font,
			'website_data'  => $this->website_data
		 ));
		
	}	
	 
	 
   
   
	
	/**
	 * bluejean
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/bluejean
	 * @access public
	 **/ 


	public function bluejean(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'Special_Elite');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$select_what =  'name, code';
		
		$where_array = array('name' => 'Special_Elite');

		$font_2 = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
	
		$font[] = $font_2[0];

			
		$this->load->view('themes/bluejean_view', 
		array(
			'font' => $font,
			'website_data'  => $this->website_data
		 ));
		
	}	


	public function brownbag(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'Special_Elite');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$select_what =  'name, code';
		
		$where_array = array('name' => 'Special_Elite');

		$font_2 = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
	
		$font[] = $font_2[0];
		$this->load->view('themes/brownbag_view', 
		array(
			'font' => $font,
			'website_data'  => $this->website_data   )
		
		);
		
	}
	  

	/**
	 * cardboard
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/cardboard
	 * @access public
	 **/ 
	

	
	
	public function cardboard(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'ArmyChalk');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$this->load->view('themes/cardboard_view', 
		array(
			'font' => $font,
			'website_data'  => $this->website_data    )
		);
	}
		
	
	/**
	 * award
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/award
	 * @access public
	 **/ 
	

	
	
	public function award(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'Vegur');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$select_what =  'name, code';
		
		$where_array = array('name' => 'Cantarell');

		$font_2 = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
	
		$font[] = $font_2[0];
		$this->load->view('themes/award_view', array( 'font' => $font, 'name' => $this->name  ));
		
	}
			
	/**
	 * ransom
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/ransom
	 * @access public
	 **/ 
	

	
	
	public function ransom(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'Impact_Label');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$select_what =  'name, code';
		
		$where_array = array('name' => '28_Days_Later');

		$font_2 = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
	
		$font[] = $font_2[0];



		$this->load->view('themes/premium/topdown/ransom/ransom_view', 
				array(
					'font' => $font,
					'website_data'  => $this->website_data    )
				);
	}	
	
	
	/**
	 * sideways
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/sideways
	 * @access public
	 **/ 
		
	public function sideways(){
		
		$select_what =  'name, code';
		
		$where_array = array('name' => 'Vegur');

		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);

		$select_what =  'name, code';
		
		$where_array = array('name' => 'Journal');

		$font_2 = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
	
		$font[] = $font_2[0];
		
		$this->load->view('themes/sideways_view', 
		array(
			'font' => $font,
			'website_data'  => $this->website_data   )
		);
		
	}
			
	/**
	 * brownbag
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/brownbag
	 * @access public
	 **/ 


	




	
	/**
	 * view_resume_top_to_bottom
	 * 
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/theme/view_resume
	 * @access public
	 */
	 
	 public function view_resume_top_to_bottom(){
	 
	 	$this->load->library('custom');
	 	
	 	$resumes = $this->custom->getresume( $this->input->get('user_id') );
	 	
	 	$this->load->view('themes/media/view_resume_top_to_bottom_view', array(
	 	'resume_entries' => $this->custom->get_resume_entries( $resume_id = $resumes[0]->id )
	 	));
	 }
	 
	 
	 
	 


	/**
	 * view_resume_side_to_side
	 * 
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/theme/view_resume
	 * @access public
	 */
	 
	 public function view_resume_side_to_side(){
	 	
	 	
	 	$this->load->library('custom');
	 	
	 	$resumes = $this->custom->getresume( $this->input->get('user_id') );
	 	
	 	$this->load->view('themes/media/view_resume_side_to_side_view', array(
	 	'resume_entries' => $this->custom->get_resume_entries( $resume_id = $resumes[0]->id )
	 	));
	 }
	 
	 
	/**
	 * insert_comment
	 * 
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/insert_comment
	 * @access public
	 */
	 
	 public function insert_comment(){	 
	 	
	 		$this->load->library('custom');	 	
			echo $this->custom->insert_comment_into_users_table( $this->input->post() );
	 
	 }	 
	 
	 
	
	 
	 
	/**
	 * test
	 * 
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/test
	 * @access public
	 */
	 
	 function test(){
	 	
	 $table = 'options';
	 $this->my_database_model->	create_generic_table($table );
	 	
		$fields_array = array(
		                        'deal_id' => array(
		                                                 'type' => 'int(11)'
		                                      ),
		                        'name' => array(
		                                                 'type' => 'varchar(255)'
		                                      )
		                ); 
		                
		                
		                
			$this->my_database_model->add_column_to_table_if_exist(
				$table, 
				$fields_array
			);



	 }
	 
 
	/**
	 * iframe_youtube
	 *
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/themes/iframe_youtube
	 * @access public
	 **/    
   
		public function iframe_youtube(){
		
			$this->load->library('custom');	
					
			$reels = $this->custom->getreel( $reel_id = $this->input->get('reel_id'));
			
			$width_of_file = 425;
			$height_of_file = 349;
	
			$new_width  = '600';
			$new_height  =  $this->tools->get_new_size_of (
				$what = 'height',
			 	$based_on_new = $new_width, 
			 	$orig_width = $width_of_file, 
			 	$orig_height = $height_of_file 
			 );
	
	
		?>
		<body    >
			<div   style='width:<?php echo $new_width    ?>px;height:<?php echo $new_height    ?>px;background:red'  >
						<?php     
						
							echo
							 $this->tools->create_iframe_html_from_youtube_video_id(
							 $reels[0]->youtube_video_id,
							 $width = $new_width,
							 $height= $new_height
							 );
							 
						?>				
			</div>
		</body>
		<?php  
		
			
		}    
   
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */