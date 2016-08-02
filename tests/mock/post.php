<?php
if(strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
    die('Allow only POST method');
}

var_dump($_POST);
