<?php

use System\Http\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Hier kannst du routes für deine Web-App anlegen.
|
*/

Route::get('/', function(){
    return 'Hallo <a href="/user/demo">Zu demo</a>';
});

Route::get('/user/{user}', function($user = null){
    return 'Cool';
    return 'Hallo '.$user;
});