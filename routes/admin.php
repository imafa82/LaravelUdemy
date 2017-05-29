<?php

Route::get('/', function(){
    return "Hello admin";
});


Route::get('/dashboard', function(){
    return "Hello admin questa è la tua dashboard";
});