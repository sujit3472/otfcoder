<?php
use Illuminate\Http\File;

/**
 * Function to store the file in temporary
 *
 * @param $str_path : storage path
 *
 * @param $file : input file
 */
function store_file($str_path, $file, $str_host = null)
{
    $int_size       = get_max_upload_file_size(bytes_to_mb($file->getClientSize()));
    $str_file_name  = generate_safe_filename($file->getClientOriginalName());
    ## store file 
    $str_file_path  = Storage::putFileAs('public/'.$str_path, new File($file),$str_file_name);
    return $str_file_name;
}

/**

 * Get maximum file upload size allowed on server in MegaBytes(MB)
 *
 * @link http://www.kavoir.com/2010/02/php-get-the-file-uploading-limit-max-file-size-allowed-to-upload.html
 *
 * @param integer $int_user_sepcific_max_size User specific size to consider while calculation max size.
 * @return int $max_upload_size Maximum file upload size on server
 */
function get_max_upload_file_size( $int_user_sepcific_max_size = 0 ) {
    $arr_all_sizes   = array();
    $arr_all_sizes[] = (int)(ini_get('upload_max_filesize'));
    $arr_all_sizes[] = (int)(ini_get('post_max_size'));
    $arr_all_sizes[] = (int)(ini_get('memory_limit'));
    if($int_user_sepcific_max_size > 0)
        $arr_all_sizes[] = $int_user_sepcific_max_size;
    $max_upload_size = min($arr_all_sizes);
    return $max_upload_size;
}

/**
 *Function to generate the unique filename
 */ 
 function generate_safe_filename($str_file_name)
 {
    // Clean the file name to make it safe to save by removing any special characters & whitespaces
    $str_filename = preg_replace('/[^A-Za-z0-9\-._]/', '', $str_file_name);
    // Append timestamp to each file name to make it unique
    $path_parts = pathinfo($str_filename);
    // Shorten file name to 200 character length max
    $path_parts['filename'] = (strlen($path_parts['filename']) > 200) ? substr($path_parts['filename'], 0,200): $path_parts['filename'];
    //$str_filename = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
    $micro_time     = time(true);
    $micro_time     =   str_replace(".", "", $micro_time);
    $str_filename = $path_parts['filename'].'_'.$micro_time.'.'.$path_parts['extension'];
    
    return $str_filename;
}
/**
 * Convert bytes to MB
 *
 * @param integer bytes Size in bytes to convert
 * @return int|float
 */
function bytes_to_mb($bytes, $precision = 2)
{
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    return round($bytes / $megabyte, $precision);
}
