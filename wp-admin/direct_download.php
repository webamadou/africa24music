<?php
//ob_start();
global $wpdb;
$table_name = $wpdb->prefix ."uploaded_file";
$id = $_GET['id'];

/*$resultats = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT * FROM $table_name WHERE id_uploaded_clip = %d",
        $id
    )
);*/
print_r($wpdb);
//$resultats = $wpdb->get_row("SELECT * from $table_name");

//$path = $resultats->svr_file_link;
//print_r($resultats);
//$file = $_GET['file'];
//$date = $_GET['date'];
//$path = 'http://localhost/videos/' . $date . '/' . $file;
/*$path = "videos/" . $date . "/" . $file;
header ("Content-type: application/octet-stream");
header ("Content-disposition: attachment; filename=\"$file\"");
header("Pragma: public");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Length: ' . filesize($path));
readfile($path);
exit;*/

//header('Content-Disposition: attachment; filename='.basename($path));
//header ('Content-disposition: attachment; filename='.$file.';');
/*header('Content-Transfer-Encoding: binary');
header('Content-Description: File Transfer');

header('Expires: 0');
*/
//ob_clean();
?>