<?php
if(strtolower($_SERVER['REQUEST_METHOD']) !== 'delete') {
    die('Allow only DELETE method');
}

var_dump($_GET);
