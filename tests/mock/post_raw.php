<?php
if(strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
    die('Allow only POST method');
}

$inputJSON = file_get_contents('php://input');
$input = json_decode( $inputJSON, TRUE );
var_dump($input);die;
