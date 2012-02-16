<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Query Library 
 * @autoloaded YES
 * @path \system\application\libraries\Query.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * 
 */
 
 
 
class Query {

	private $CI;	// CodeIgniter instance
	
	
	function query(){
		
		$this->CI =& get_instance();	
		
	}

	function get_users( $table, $where_array ){
		

		$join_array = array(
									'images' => 'images.user_id = users.id'
									);
		
		$users_raw = $this->CI->my_database_model->select_from_table( 
			$table = 'users', 
			$select_what = 'image_type_id ,images.id as image_id, users.id as user_id, users.*',    
			$where_array, 
			$use_order = TRUE, 
			$order_field = 'image_type_id, images.created', 
			$order_direction = 'asc', 
			$limit = -1, 
			$use_join = TRUE, 
			$join_array
			);
			
		$users_raw = $this->CI->tools->object_to_array($users_raw);


		if( count($users_raw) == 0 ){
			
				$users_raw = $this->CI->my_database_model->select_from_table( 
					$table = 'users', 
					$select_what = 'users.id as user_id, users.*',    
					$where_array, 
					$use_order = FALSE, 
					$order_field = '', 
					$order_direction = 'asc', 
					$limit = -1
					);
					
					$users = $this->CI->tools->object_to_array($users_raw);

				return $users;		
			
		};

		$count=0;

		$previous_id = -1;
			
		$image_types = array(
			0 => 'backgrounds',
			1 => 'pictures',
			2 => 'videos',
		);
		

		foreach( $users_raw  as $key =>  $user){
			$count++;
			if( $user['image_type_id'] == $previous_id || $previous_id == -1){

					foreach( $user  as  $field => $value){
		 
						 	if( $field != 'image_id'){
						 			$array[$field] = $value;
							}else{
									$images[] = $value;
							};
						
					}
					
					
					

			}else{

					$array['images'] = $images;	
					unset($images);			
					$users[$image_types[  $previous_id  ]] = $array;					
			
					foreach( $user  as  $field => $value){
		 
						 	if( $field != 'image_id'){
						 			$array[$field] = $value;
							}else{
									$images[] = $value;
							};
						
					}					



			};
			
			$previous_id = $user['image_type_id'];			

		}
		
		if( $count ==  count($users_raw) ){

						$array['images'] = ( isset($images ) ? $images :array());				
						$users[$image_types[   $previous_id  ]] = $array;
	
		};
		
		$users[] = $users[  $image_types[  $previous_id  ] ];  // IE: $users['backgrounds']

		return $users;
		
	}

	function insert($post_array){

		$set_what_array = $this->get_set_what_array_by_parsing_post_parameter($post_array);
		
		$this->add_column_if_not_exist($set_what_array, $post_array['table']);		
		
		return $this->CI->my_database_model->insert_table(
									$post_array['table'], 
									$insert_what = $set_what_array
									); 					

	}

	function update($post_array){

		$set_what_array = $this->get_set_what_array_by_parsing_post_parameter($post_array);
		
		$this->add_column_if_not_exist($set_what_array, $post_array['table']);

		return $this->CI->my_database_model->update_table_where(
					$post_array['table'], 
					$where_array = array('id'=>$post_array['id']),
					$set_what_array = $set_what_array
					);	
	}
	
	function get_set_what_array_by_parsing_post_parameter($post_array){
		
		
			$fields = explode('&', $post_array['set_what']);
			foreach($fields as $field){
				$field_key_value = explode("=",$field);
				$key = urldecode($field_key_value[0]);
				$value = urldecode($field_key_value[1]);
				//eval("$$key = \"$value\";");
				$set_what_array[$key] = $value;
			};	  

			return $set_what_array;
				
	}
	
	
	function add_column_if_not_exist($set_what_array, $table){
		
			foreach( $set_what_array  as  $key => $value){
				$fields_array = array(
							$key => array('type' => 'varchar(255)')                                          
            	); 

				$this->CI->my_database_model->add_column_to_table_if_exist(
					$table, 
					$fields_array
				);    					
			};
 	
		
	}
	
}


/* End of file Tool.php */ 
/* Location: \system\application\libraries\Query.php */
