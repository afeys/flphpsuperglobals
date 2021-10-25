<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(dirname(__FILE__) . '/FrontEnd.php');
require_once(dirname(__FILE__) . '/Server.php');
require_once(dirname(__FILE__) . '/Session.php');
