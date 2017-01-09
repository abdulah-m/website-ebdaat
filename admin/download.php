<?php
function output_file($filename, $name, $mime_types='')
{
  // Check file premission
 if(!is_readable($filename)) 
 die('File not found!');
 $filesize = filesize($filename);
 $name = rawurldecode($name);
 
 /* Figure out the MIME type | Check in array */
 $known_mime_types=array(
    "htm" => "text/html",
 	"txt" => "text/plain",
 	"html" => "text/html",
 	"doc" => "application/msword",
	"xls" => "application/vnd.ms-excel",
	"exe" => "application/octet-stream",
	"zip" => "application/zip",
	"jpeg"=> "image/jpg",
	"jpg" =>  "image/jpg",
	"php" => "text/plain",
	"ppt" => "application/vnd.ms-powerpoint",
	"gif" => "image/gif",
	"png" => "image/png",
	"pdf" => "application/pdf"

 );
 
 if($mime_types==''){
	 $file_extension = strtolower(substr(strrchr($filename, "."),1));
	 if(array_key_exists($file_extension,$known_mime_types)){
		$mime_types=$known_mime_types[$file_extension];
	 } else {
		$mime_types="application/force-download";
	 };
 };
 
 @ob_end_clean(); 
 if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');
 
 header('Content-Type: ' . $mime_types);
 header('Content-Disposition: attachment; filename="'.$name.'"');
 header("Content-Transfer-Encoding: binary");
 header('Accept-Ranges: bytes');
 header("Cache-control: private");
 header('Pragma: private');
 header("Expires: Mon, 15 Jan 2014 08:30:00 IST");

 if(isset($_SERVER['HTTP_RANGE']))
 {
	list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
	list($range) = explode(",",$range,2);
	list($range, $range_end) = explode("-", $range);
	$range=intval($range);
	if(!$range_end) {
		$range_end=$filesize-1;
	} else {
		$range_end=intval($range_end);
	}

	$new_length = $range_end-$range+1;
	header("HTTP/1.1 206 Partial Content");
	header("Content-Length: $new_length");
	header("Content-Range: bytes $range-$range_end/$filesize");
 } else {
	$new_length=$filesize;
	header("Content-Length: ".$filesize);
 }

 $chunksize = 1*(1024*1024); 
 $bytes_send = 0;
 if ($filename = fopen($filename, 'r'))
 {
	if(isset($_SERVER['HTTP_RANGE']))
	fseek($filename, $range);
 
	while(!feof($filename) && (!connection_aborted()) && ($bytes_send<$new_length))
	{
		$buffer = fread($filename, $chunksize);
		print($buffer); 
		flush();
		$bytes_send += strlen($buffer);
	}
 fclose($filename);
 } else die('Error - can not open file.');
die();
}
set_time_limit(0);
$file_path='../uploads/'.$_REQUEST['filename'];
output_file($file_path, ''.$_REQUEST['filename'].'', 'text/plain');
?>