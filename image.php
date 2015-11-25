<?php
$path = getcwd();

$latest_ctime = 0;
$latest_filename = '';
$latest_filepath = '';
$d = dir($path);
while (false !== ($entry = $d->read())) {
    $filepath = "{$path}/{$entry}";
    // could do also other checks than just checking whether the entry is a file
    if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
        $latest_ctime = filectime($filepath);
        $latest_filename = $entry;
        $latest_filepath = $filepath;

    }
    if (is_file($filepath) && $latest_filepath != $filepath  && !strpos($filepath, "php") && !strpos($filepath, "htaccess")) {
        unlink($filepath);
        //echo "<br>$filepath";
   }

}

$fp = fopen($latest_filename, 'rb');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: image/jpeg");
header("Content-Length: " . filesize($latest_filename));

fpassthru($fp);
exit;
?>