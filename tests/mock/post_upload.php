<?php
define('DS', DIRECTORY_SEPARATOR);

if(strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
    die('Allow only POST method');
}

$filename = basename($_FILES["file"]["name"]);
$desfile = 'upload'.DS.$filename;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $desfile)) {
    echo "The file ". $filename. " has been uploaded.<br/>";
    var_dump($_POST);
} else {
    echo "Sorry, there was an error uploading your file $filename.";
}
