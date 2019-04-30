<?php
/*$zip = new ZipArchive;
$res = $zip->open('wordpress-4.6-fr_FR.zip');
// assuming file.zip is in the same directory as the executing script.
*/
$file = 'wordpress-4.6-fr_FR.zip';

// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
  // extract it to the path we determined above
  $zip->extractTo($path);
  $zip->close();
  echo "WOOT! $file extracted to $path";
} else {
  echo "Doh! I couldn't open $file";
}