<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	
   public function __construct(){
        parent::__construct();
        
        
        if( $this->input->get('logout') ){

							$this->session->sess_create();

        };
        
        
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
		$select_what =  'name, code';
		$where_array = array('name' => 'Vegur');
		$font = $this->my_database_model->select_from_table( $table = 'fonts', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = -1);
		$this->load->view('home/index_view', array( 'font' => $font ));
	}
	
	



	/**
	 * login
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/login
	 * @access public
	 */

	public function login(){
		
		if( $this->input->post() ){
			
			$this->load->library('custom');
			
			$validation = $this->custom->login_process($post_array = $this->input->post());
			
			if( $validation['is'] == 'true'	){
				
					$newdata = array('user_id' => $validation['id'] );						
						
					$this->session->set_userdata($newdata);
					
					redirect('/main/index/');
								
			}else{
				
					$this->load->view('home/login_view',
					array(
						'validation'=> $validation,
						'post_array'=> $this->input->post()
					)
					);		
								
			};
			
		}else{
				$this->load->view('home/login_view');			
		};
		

	}
	
	
	/**
	 * logout
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/logout
	 * @access public
	 */

	public function logout(){	
		
		$this->session->sess_create();	
		
		redirect('/home/login');
		
	}
	
	
	
	/**
	 * register
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/register
	 * @access public
	 */
	 
	public function register(){
		
		if( $this->input->post() ){
			
			$this->load->library('custom');
			
			$validation = $this->custom->register_process($post_array = $this->input->post());
			
			if( $validation['is'] == 'true'	){
				
					redirect('/home/login');	
								
			}else{
				
					$this->load->view('home/register_view', 
						array(
						'validation' => $validation	,
						'post_array'=>$this->input->post()
						)
					);		
								
			};
			
		}else{
				$this->load->view('home/register_view');			
		};


	}
	
	



	/**
	 * validate_account
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/validate_account
	 * @access public
	 */
	 
	public function validate_account(){
		
		
		
		$set_what_array = array(
								'activate' => 1
								);			
						
		$this->my_database_model->update_table( $table = 'users', $primary_key = $this->uri->segment(3), $set_what_array );

		

		$select_what =  'fullname';
		
		$where_array = array('id' => $this->uri->segment(3));

		$user = $this->my_database_model->select_from_table( 
			$table = 'users', 
			$select_what, 
			$where_array, 
			$use_order = false, 
			$order_field = 'id', 
			$order_direction = 'desc', 
			$limit = -1, 
			$use_join = FALSE, 
			$join_array = array()
		);

		$this->load->view('home/validate_account_view', array('user' => $user,'site_id' => $this->site_id, 'deal_id' => $this->deal_id ));







	}










	/**
	 * create_or_update_with_facebook
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @access public
	 */

		private function create_or_update_with_facebook( $userInfo ){
			
			$facebook_user = $userInfo['id'];
			$first_name = $userInfo['first_name'];
			$last_name = $userInfo['last_name'];
			$email = $userInfo['email'];

			
			$table = 'users';
			
		  $where_array = array('facebook_user' => $facebook_user);
	
		  if( $this->my_database_model->check_if_exist($where_array, $table)){
		  	
		  			$this->my_database_model->update_table_where(
						$table = 'users', 
						$where_array = array('facebook_user' => $facebook_user), 
						$set_what_array = array('last_login' =>  date('Y-m-d H:i:s'))
						);
						
						$select_what =  '*';
						
						$where_array = array(
						'facebook_user' => $facebook_user
						);
						
						$users_temp_array = $this->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);

						$users_temp_array = $this->tools->object_to_array($users_temp_array);

						foreach( $users_temp_array[0]  as  $key => $value){
							$users[$key] = $value;
						}
						
						$users['facebook_user'] = $facebook_user;

			}else{
				
				
						$table = 'users';
						
					  $where_array = array('email' => $email);
				
					  if( $this->my_database_model->check_if_exist($where_array, $table)){
					  	
					  	
					  			$this->my_database_model->update_table_where(
									$table = 'users', 
									$where_array = array('email' => $email), 
									$set_what_array = array(
										'last_login' =>  date('Y-m-d H:i:s'),
										'facebook_user' => $facebook_user
										)
									);
									
									$select_what =  '*';
									
									$where_array = array(
										'email' => $email
									);
									
									$users_temp_array = $this->my_database_model->select_from_table( $table = 'users', $select_what, $where_array, $use_order = FALSE, $order_field = '', $order_direction = 'desc', $limit = 1);

									$users_temp_array = $this->tools->object_to_array($users_temp_array);
	
									foreach( $users_temp_array[0]  as  $key => $value){
										$users[$key] = $value;
									}
									
									$users['facebook_user'] = $facebook_user;

					  	
					  }else{
					  	
									$users = array();
								
									$insert_what = array(
									                        'email' =>  $email,
									                        'first_name' =>   $first_name,
									                        'last_name' =>   $last_name,
																					'facebook_user' => $facebook_user,
									                        'last_login' =>  date('Y-m-d H:i:s')
									                );
									
									$users['id'] = $this->my_database_model->insert_table(
																	$table = 'users', 
																	$insert_what
																	); 	
																	
									$users['isAdmin'] = 0;	
									$users['email'] = $email;
									$users['first_name'] = $first_name;
									$users['last_name'] = $last_name;
									$users['facebook_user'] = $facebook_user;

					  }
				
				
			}
			
			
			return $users;
			
			
		}




	/**
	 * facebook
	 * {@source }
	 * @package BackEnd
	 * @author James Ming <jamesming@gmail.com>
	 * @path /index.php/home/facebook
	 * @access public
	 */

	public function facebook(){
		
		
		$this->load->model('my_facebook_model');
		
		$loginUrl = $this->my_facebook_model->loginUrl;
		
		

		if ( $this->input->get('from_logout') == 1 ){
			?>
			<script type="text/javascript" language="Javascript">
				window.parent.$('#logo').click();
			</script>
			<?php     
		};
		
		
		$facebook_user = $this->my_facebook_model->user;
		
		echo '<pre>';print_r(  $facebook_user  );echo '</pre>';  
		echo '<pre>';print_r($_SESSION);echo '</pre>';  
		
		
		if ( $facebook_user ){

			$userInfo   = $this->my_facebook_model->facebook->api("/".$this->my_facebook_model->user);

			$users = $this->create_or_update_with_facebook( $userInfo );
			
			$newdata = array(
		                   'email'  => $users['email'],
		                   'user_id'     => $users['id'],
		                   'isAdmin'     =>  $users['isAdmin'],
		                   'logged_in' => TRUE
		               );						
				
			$this->session->set_userdata($newdata);

		}else{
			
			$userInfo   = array();

		}
	
	

		$this->load->view('home/facebook_view',
			array(
			'loginUrl' => $loginUrl,
			'userInfo' => $userInfo
			)
		);
		
		
     

		
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

	
function create_table(){
$table = 'page_views';
$this->my_database_model->create_generic_table($table );

$fields_array = array(
                      'user_id' => array(
                                               'type' => 'int(11)'
                                    ),
                      'ip_address' => array(
                                               'type' => 'varchar(255)'
                                    ),
                      'county' => array(
                                               'type' => 'varchar(255)'
                                    ),
                      'city' => array(
                                               'type' => 'varchar(255)'
                                    ),
                      'state' => array(
                                               'type' => 'varchar(255)'
                                    )
              ); 
              
              
              
$this->my_database_model->add_column_to_table_if_exist(
	$table, 
	$fields_array
);
   


}
	



}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */