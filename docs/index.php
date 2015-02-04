<?php
chdir("../server");
require_once('system/includes.php');
Header("Content-Type: text/html; charset=utf-8");
Header('Content-Type: application/json');
Header( "HTTP/1.1 301 Moved Permanently" );
Header( "Location:".SERVER_DOCS_PATH );
?>