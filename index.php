<?php

$path = getcwd();

$latest_ctime = 0;
$latest_filename = '';
$latest_filepath = '';
$d = dir($path);
$log = '<strong>Log Start: </strong>' . microtime() ;

while (false !== ($entry = $d->read())) {
    $filepath = "{$path}/{$entry}";
    // could do also other checks than just checking whether the entry is a file
    if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
        $latest_ctime = filectime($filepath);
        $latest_filename = $entry;
        $latest_filepath = $filepath;

    }
    if (is_file($filepath) && $latest_filepath != $filepath  && !strpos($filepath, "php") && !strpos($filepath, "htaccess")) {
        $log .= "<br>Deleted: <code>$filepath</code>";
        unlink($filepath);
    }
}
?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div>
                <img src="<? echo $latest_filename; ?>" style="width: 100%;"/>
            </div>
            <div>
                <strong>Image Details: </strong><? print_r(getimagesize($latest_filepath)); ?>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Details...</h3>
            <p><strong>File Name: </strong><? echo  $latest_filename; ?></p>
            <p><strong>File Time: </strong><? echo  $latest_ctime; ?></p>
            <p style="word-wrap: break-word;"><strong>File Path: </strong><? echo  $latest_filepath; ?></p>
            <h3>Logs <button type="button" class="btn btn-info" id="btnLogs">View</button></h3>
            <div class="collapse" id="logs" style="word-break: break-all;">
                <? echo $log ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#btnLogs").click(function(){
            $("#logs").collapse('toggle');
        });
    });
</script>
</body>
</html>

