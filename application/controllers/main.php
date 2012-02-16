<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	
   public function __construct(){
        parent::__construct();

			
   }

	/**
	 * Index Page for this controller.
	 * 
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/index
	 * @access public
	 */
	 

	public function index(){
	

		$data = array(
		);
		

		$this->load->view('main/index_view',
					array('data' => $data));	    
	}
	
public function a3_insert(){
		
		$string = '';
		
		$count = 0;
		foreach( $this->input->get()  as  $key => $value){
			$count++;
			if( $count < count($this->input->get())){
					$string = ( $key != 'table' ? $string .  $key.'='.$value.'&':'' );
			}else{
					$string = ( $key != 'table' ? $string .  $key.'='.$value:'' );
			};
			
		}

		$post_array = array(
			'table' => $this->input->get('table'),
			'set_what' => $string
		);
		

		echo $this->query->insert( $post_array );
	}
	
	function a3_table_dump(){
  


		$select_what =  '*';
		$where_array = array();
		
		$dumps = $this->my_database_model->select_from_table( 
		$table = $this->uri->segment(3),
		$select_what, 
		$where_array, 
		$use_order = TRUE, 
		$order_field = 'created', 
		$order_direction = 'desc', 
		$limit = -1);
		
		
		
		echo "<pre>";print_r(  $dumps  );echo "</pre>";  exit;
	
		
	}

/**
 * create_table
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path /index.php/home/create_table
 * @access public
 **/ 

	
function t(){
$table = 'images';
$this->my_database_model->create_generic_table($table );


$fields_array = array(
                      'user_id' => array(
                                               'type' => 'int(11)'
                                    ),
                      'image_type_id' => array(
                                               'type' => 'int(11)'
                                    ),
//                      'county' => array(
//                                               'type' => 'varchar(255)'
//                                    ),
//                      'city' => array(
//                                               'type' => 'varchar(255)'
//                                    ),
//                      'state' => array(
//                                               'type' => 'varchar(255)'
//                                    )
              ); 
              
              
              
$this->my_database_model->add_column_to_table_if_exist(
	$table, 
	$fields_array
);
   


}
	



}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */