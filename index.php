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
        echo "<br>Deleting: $filepath";
        unlink($filepath);
    }


}

//print_r(gd_info());
//echo $filepath;
//echo "<p>";
//print_r(getimagesize($filepath));

echo "<p>Lastest Image:</p><img src=\"$latest_filename\" />";

echo  $latest_filename;

// Show all information, defaults to INFO_ALL
//phpinfo();

?>