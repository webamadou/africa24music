<?php
//function direct_download() {
/*	global $wpdb;
	$table_name = $wpdb->prefix ."uploaded_file";
	$id = $_GET['id'];
	$resultats = $wpdb->get_row(
	    $wpdb->prepare(
	        "SELECT * FROM $table_name WHERE id_uploaded_clip = %d",$id)
	);
	$path = $resultats->svr_file_link;*/
	$file = $_GET['file'];
	$dayfolder = $_GET['date'];
	//$path = 'http://localhost/videos/' . $date . '/' . $file;
	if(!empty($_GET['file'])) {
		$path = "videos/" . $dayfolder . "/" . $file;
		header ("Content-type: application/octet-stream");
		header ("Content-disposition: attachment; filename=\"$file\"");
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-Length: ' . filesize($path));
		readfile($path);
		exit;
	}else {
		echo "The file does not exit";
	}
	/*
	header('Expires: 0');
	ob_clean();
	*/
//}

?>