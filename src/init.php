<?php
if (file_exists('../debugger/Debug.php')) { // Include Debugger
    define('DEBUG', true);
    include_once('../debugger/Debug.php');
    //include_once('app/debugger/debugger.php');
}
