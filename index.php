<?php

$path = getcwd();

$latest_ctime = 0;
$latest_filename = '';
$latest_filepath = '';
$d = dir($path);
$log = '';

while (false !== ($entry = $d->read())) {
    $filepath = "{$path}/{$entry}";
    // could do also other checks than just checking whether the entry is a file
    if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
        $latest_ctime = filectime($filepath);
        $latest_filename = $entry;
        $latest_filepath = $filepath;

    }
    if (is_file($filepath) && $latest_filepath != $filepath  && !strpos($filepath, "php") && !strpos($filepath, "htaccess")) {
        $log .= "<p>Deleting: $filepath </p>";
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

?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
    <h2>Simple Collapsible</h2>
    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Simple collapsible</button>
    <div id="demo" class="collapse in">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </div>
</div>

</body>
</html>

