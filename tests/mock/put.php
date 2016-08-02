<?php
if(strtolower($_SERVER['REQUEST_METHOD']) !== 'put') {
    die('Allow only PUT method');
}

$inputJSON = file_get_contents('php://input');
$input = json_decode( $inputJSON, TRUE );
var_dump($input);die;
