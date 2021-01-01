<?php

if (file_exists(__DIR__."/config/MAINTENACE")) {
    \System\View\View::file(__DIR__.'/errors/503.php');
    die();
}