<?php 
/**
 * PhpLite FrameWork
 * 
 * @author Paul Schur p.a.sch@gmx.de
 */

/*
|-------------------------------------
| Register the autoloader
|-------------------------------------
| Läd den Autoloader, der nur die Klassen läd, die du auch brauchst.
*/
require __DIR__.'/../vendor/autoload.php';

/*
|-------------------------------------
| Bootstrap the Application
|-------------------------------------
| Bootstrap the application and da action from the framework.
*/
require __DIR__.'/../bootstrap/app.php';

/*
|-------------------------------------
| Run the app
|-------------------------------------
| Handle Request and Response
*/
$app = Application::run();