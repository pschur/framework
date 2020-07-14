<?php

use Phplite\Router\Route;

Route::get('/', function(){
    echo "Herzlich Willkommen";
});

Route::get('cloud/{user}', function(){
    echo "ps";
});

Route::any('/home', 'HomeConroller@index');

Route::prefix('admin', function(){
    Route::get('dashboard', "Admin@dashboard");
    Route::get('user/{id}/edit', "Admin@user");
    Route::get('admins', "Admin@admins");
    
    Route::prefix('owner', function(){
        Route::middleware('Admin|Owner', function(){
            Route::get('dashboard', "Admin@dashboard");
            Route::get('user', "Admin@user");
            Route::get('admins', "Admin@admins");
        });
    });
});


