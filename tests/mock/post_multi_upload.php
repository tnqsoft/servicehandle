<?php
define('DS', DIRECTORY_SEPARATOR);

if(strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
    die('Allow only POST method');
}

for($i=0; $i < count($_FILES["files"]['name']); $i++) {
    $filename = basename($_FILES["files"]["name"][$i]);
    $desfile = 'upload'.DS.$filename;

    if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $desfile)) {
        echo "The file ". $filename. " has been uploaded.<br/>";
    } else {
        echo "Sorry, there was an error uploading your file $filename.";
    }
}

var_dump($_POST);
