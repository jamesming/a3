<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is found in library section of the codeigniter application directory
 *
 */


/**
 * Useful common functions. 
 * @autoloaded YES
 * @path \system\application\libraries\Tools.php
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @copyright 2010 Prospace LLC
 * @version 1.0
 * 
 */
class Tools {

private $CI;

function Tools(){
	
	$this->CI =& get_instance();	
	
}

	
/**
 * Function to determine if browser is Safari
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @return bool   */ 
	
	function browserIsSafari(){
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
		(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false))
			return TRUE;
		else
			return FALSE;
	}


	
	
/**
 * Function to determine if browser is Internet Explorer
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @return bool   */ 
	
	function browserIsExplorer(){
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
		(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
			return TRUE;
		else
			return FALSE;
	}
	
/**
 * Function to determine if browser is Internet Firefox
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @return bool   */ 
	
	function browserIsFireFox(){
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
		(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false))
			return TRUE;
		else
			return FALSE;
	}
	
/**
 * Function to determine if browser is Chrome
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @return bool   */  
	
	function browserIschrome(){
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
		(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false))
			return TRUE;
		else
			return FALSE;
	}
	
	
/**
 * Function to determine if browser is IPad
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @return bool   */  	
	
	
	function browserIsIPad(){
		if (isset($_SERVER['HTTP_USER_AGENT']) && 
		(strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false))
			return TRUE;
		else
			return FALSE;
	}	

/**
 * This function generates random alpha-numerical characters
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @param string $length number of characters that will be generated
 * @return string $randstr   */ 
 
	function generateRandStr($length){
	  $randstr = "";
	  for($i=0; $i<$length; $i++){
	     $randnum = mt_rand(0,61);
	     if($randnum < 10){
	        $randstr .= chr($randnum+48);
	     }else if($randnum < 36){
	        $randstr .= chr($randnum+55);
	     }else{
	        $randstr .= chr($randnum+61);
	     }
	  }
	  return $randstr;
	} 	
	


/**
 * Delete a file or recursively delete a directory
 *
 * {@source }
 * @package BackEnd
 * @param string $directory_path Path to file or directory
 */
 
function recursiveDelete($directory_path){
    if(is_file($directory_path)){
        return @unlink($directory_path);
    }
    elseif(is_dir($directory_path)){
        $scan = glob(rtrim($directory_path,'/').'/*');
        foreach($scan as $index=>$path){
            $this->recursiveDelete($path);
        }
        return @rmdir($directory_path);
    }

}

/**
 * resize_this
 *
 * {@source }
 * @package BackEnd
 * @param string $full_path
 * @param string $width 
 * @param string $height 
 */
 
function resize_this($full_path, $width, $height){
	
					$config['image_library'] = 'gd2';
					$config['source_image']	= $full_path;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	= $width;
					$config['height']	= $height;
					
					$this->CI->image_lib->initialize($config); 
					
					$this->CI->image_lib->resize();
			
					$this->CI->image_lib->clear();
 
}

/**
 * crop_and_name_it 
 *
 * {@source }
 * @package BackEnd
 * @param string $appended_suffix
 * @param string $full_path 
 * @param string $dir_path 
 * @param string $width 
 * @param string $height 
 * @param string $x_axis 
 * @param string $y_axis 
 * @return string 
 */
 
function crop_and_name_it($new_name = 'cropped.png', $full_path, $dir_path, $width = 300, $height = 300, $x_axis = 0, $y_axis = 0){

					$config['image_library'] = 'gd2';
					$config['source_image']	= $full_path;
					$config['new_image'] = $dir_path . $new_name;
					$config['thumb_marker']	= '';
					$config['maintain_ratio'] = FALSE;
					$config['width']	= $width;
					$config['height']	= $height;
					$config['x_axis'] = $x_axis;
					$config['y_axis'] = $y_axis;
					
					$this->CI->image_lib->initialize($config); 
					
					$this->CI->image_lib->crop();
			
					$this->CI->image_lib->clear();
					
					return $new_name;
					
}


/**
 * clone_and_resize_append_name_of PNG image
 *
 * {@source }
 * @package BackEnd
 * @param string $appended_suffix
 * @param string $full_path 
 * @param string $width 
 * @param string $height 
 * @return string 
 */
 
function clone_and_resize_append_name_of($appended_suffix, $full_path, $width, $height){
	
					$config['image_library'] = 'gd2';
					$config['source_image']	= $full_path;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	= $width;
					$config['height']	= $height;
					
					$config['thumb_marker']	= $appended_suffix;
					
					$this->CI->image_lib->initialize($config); 
					
					$this->CI->image_lib->resize();
			
					$this->CI->image_lib->clear();
					
					return 'image' . $appended_suffix . '.png';
 
}



/**
 * Rotates a file according to direction passed
 *
 * {@source }
 * @package BackEnd
 * @param string $directory_path Path to file or directory
 */
 
function rotate($full_path, $rotation){
	

			$config['image_library'] = 'gd2';
			$config['source_image']	= $full_path;
			
			if( $rotation == 'right'){
				$config['rotation_angle'] = '270';
			}else{
				$config['rotation_angle'] = '90';
			};
			
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->rotate();
			$this->CI->image_lib->clear();

}
	

/**
 * Sets up directory structure for uploading image file
 *
 * {@source }
 * @package BackEnd
 * @uses Unit_test::test_tools_set_directory_for_upload()
 * @param array $path_array
 */
 
function set_directory_for_upload ($path_array ){
	
	$path = 'uploads';
	
	foreach( $path_array as $directory ){
	
		$path .= '/' . $directory;
		
		if( is_dir($path) == FALSE){		
			mkdir($path, 0700);
		};
		
	}
  
  return $path;
}


/**
 * Gets missing width or height based on original size and on new width or height
 *
 * {@source }
 * @package BackEnd
 * @param string $what
 * @param int $based_on_new
 * @param int $orig_width
 * @param int $orig_height
 * @return int $whats_missing
 */
 
function get_new_size_of ($what = 'width', $based_on_new, $orig_width, $orig_height ){

	if( $what == 'width'){
		

			
			$ratio = $orig_width / $orig_height;			
			
			$whats_missing = $based_on_new * $ratio;		
			
	}elseif( $what == 'height'){
		

			$ratio =  $orig_height / $orig_width ;			
			
			
			$whats_missing = $based_on_new * $ratio;		
			
	};


	return round($whats_missing);

}


/**
 * Gets missing width or height based on original size and on new width or height
 *
 * {@source }
 * @package BackEnd
 * @param string $new_file_name
 * @param string $orig_file_name
 * @return bool
 */
 
function copy_file( $orig_file_name, $new_file_name ){

	// TAKEN FROM http://stackoverflow.com/questions/226894/
	// how-do-you-copy-a-file-in-php-without-overwriting-an-existing-file
	//
	// The PHP copy function blindly copies over existing files.  We don't wish
	// this to happen, so we have to perform the copy a bit differently.  The
	// only safe way to ensure we don't overwrite an existing file is to call
	// fopen in create-only mode (mode 'x').  If it succeeds, the file did not
	// exist before, and we've successfully created it, meaning we own the
	// file.  After that, we can safely copy over our own file.

	if ($file = @fopen($new_file_name, 'x')) {
	    // We've successfully created a file, so it's ours.  We'll close
	    // our handle.
	    if (!@fclose($file)) {
	        // There was some problem with our file handle.
	        return false;
	    }
	
	    // Now we copy over the file we created.
	    if (!@copy($orig_file_name, $new_file_name)) {
	        // The copy failed, even though we own the file, so we'll clean
	        // up by itrying to remove the file and report failure.
	        unlink($new_file_name);
	        return false;
	    }
	
	    return true;
	}

}



/**
 * rename_directories_in_right_order
 *
 * {@source }
 * @package BackEnd
 * @return bool
 */
 
function rename_directories_in_right_order( $dir_path ){

		$results = scandir($dir_path);
		
		foreach ($results as $result) {
		    if ($result === '.' or $result === '..') continue;
		    if (is_dir($dir_path . '/' . $result)) {
		        $folders[]=$result;
		    }
		}
		

		foreach ($folders as $key => $folder) {
				
				rename($dir_path . '/' . $folder, $dir_path . '/'  . 'temp_' . ( $key + 1));
				
		}		
		
		foreach ($folders as $key => $folder) {
				
				rename($dir_path . '/'  . 'temp_' . ( $key + 1), $dir_path . '/'  .  ( $key + 1));
				
		}		

}

/**
 * Time between two dates
 *
 * {@source }
 * @package BackEnd
 * @return array
 */
 

function date_time_diff($start, $end, $date_only = true)  // $start and $end as timestamps
{
    if ($start < $end) {
        list($end, $start) = array($start, $end);
    }
    $result = array('years' => 0, 'months' => 0, 'days' => 0);
    if (!$date_only) {
        $result = array_merge($result, array('hours' => 0, 'minutes' => 0, 'seconds' => 0));
    }
    foreach ($result as $period => $value) {
        while (($start = strtotime('-1 ' . $period, $start)) >= $end) {
            $result[$period]++;
        }
        $start = strtotime('+1 ' . $period, $start);
    }
    return $result;
}




/**
 * Onject to Array
 *
 * {@source }
 * @package BackEnd
 * @author James Ming <jamesming@gmail.com>
 * @path \system\application\libraries\Tools.php
 * @access public
 * @param object $data
 * @return array $result   
 */ 
 
 function object_to_array($data){
  if(is_array($data) || is_object($data)){
    $result = array(); 
    foreach($data as $key => $value)
    { 
      $result[$key] = $this->object_to_array($value); 
    }
    return $result;
  }
  return $data;
}


/**
 * extract_video_id_from_youtube_url
 *
 * {@source }
 * @package BackEnd
 * @return string
 */
 

function extract_video_id_from_youtube_url($youtubeurl) {
	
			if(strlen($youtubeurl)) {
				

					//** TAKEN FROM http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id
					parse_str( parse_url( $youtubeurl, PHP_URL_QUERY ), $my_array_of_vars );
					
					return ( count($my_array_of_vars )!=0 ?$my_array_of_vars['v'] :'error' );

			}

}

/**
 * get_thumbnail_from_youtube_video_id
 *
 * {@source }
 * @package BackEnd
 * @return string
 */
 
function get_thumbnail_from_youtube_video_id($video_id){

	$thumbnail_array[0] = "http://img.youtube.com/vi/";
	$thumbnail_array[1] = $video_id;
	$thumbnail_array[2] = "/0.jpg";
	return $thumbnail_array[0].$thumbnail_array[1].$thumbnail_array[2];
}


/**
 * create_iframe_html_from_youtube_video_id
 *
 * {@source }
 * @package BackEnd
 * @return string
 */

function create_iframe_html_from_youtube_video_id( $youtube_video_id, $width, $height){
	
	$iframe_array[0]="<iframe width='".$width."' height='".$height."' src='http://www.youtube.com/embed/";
	$iframe_array[1]=$youtube_video_id; 
	$iframe_array[2]="?autoplay=1' frameborder='0' allowfullscreen ></iframe>";
	
	return $iframe_array[0].$iframe_array[1].$iframe_array[2];
	
}

/**
 * show_thumbnail_of
 *
 * {@source }
 * @package BackEnd
 * @return string
 * Source: http://net.tutsplus.com/tutorials/php/oop-in-php/
 */

	function show_thumbnail_of($filename, $new_width) {  
	
	    // read the image file to a binary buffer  
	    $fp = fopen($filename, 'rb') or die("Image '$filename' not found!");  
	    $buf = '';  
	    while(!feof($fp))  
	        $buf .= fgets($fp, 4096);  
	
	    // create image  
	    $image = imagecreatefromstring($buf);  
	    
	    
			$info = getimagesize($filename);  
	        $width = $info[0];  
	        $height = $info[1];  
	        $mimetype = $info['mime'];
	        

			$new_height = $this->get_new_size_of ($what = 'height', $based_on_new = $new_width, $orig_width = $width, $orig_height = $height );
		
			$thumb = imagecreatetruecolor($new_width, $new_height);	
  
      imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);  

	
	    header("Content-type: {$mimetype}");  
	    switch($mimetype) {  
	        case 'image/jpeg': imagejpeg($thumb); break;  
	        case 'image/png': imagepng($thumb); break;  
	        case 'image/gif': imagegif($thumb); break;  
	    } 
	
			imagedestroy($thumb);
			imagedestroy($image);
	
	} 
	
	
	
	
	
/**
 * create_thumbnail_of
 *
 * {@source }
 * @package BackEnd
 * @return string
 * Source: http://net.tutsplus.com/tutorials/php/oop-in-php/
 */

	function create_thumbnail_of($filename, $new_width, $location) {  
	
	    // read the image file to a binary buffer  
	    $fp = fopen($filename, 'rb') or die("Image '$filename' not found!");  
	    $buf = '';  
	    while(!feof($fp))  
	        $buf .= fgets($fp, 4096);  
	
	    // create image  
	    $image = imagecreatefromstring($buf);  
	    
	    
			$info = getimagesize($filename);  
	        $width = $info[0];  
	        $height = $info[1];  
	        $mimetype = $info['mime'];
	        

			$new_height = $this->get_new_size_of ($what = 'height', $based_on_new = $new_width, $orig_width = $width, $orig_height = $height );
		
			$thumb = imagecreatetruecolor($new_width, $new_height);	
  
      imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);  

	
	    // header("Content-type: {$mimetype}");  
	    switch($mimetype) {  
	        case 'image/jpeg': imagejpeg($thumb, $location); break;  
	        case 'image/png': imagepng($thumb, $location); break;  
	        case 'image/gif': imagegif($thumb, $location); break;  
	    } 
	
			imagedestroy($thumb);
			imagedestroy($image);
	
	} 
	
	
	
}
/* End of file Tool.php */ 
/* Location: \system\application\libraries\Tools.php */
