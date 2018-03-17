<?php

$router->get('/', 'HomeController@index')->name('home');

$router->get('blog',        'BlogController@index')->name('blog');
$router->get('blog/{post}', 'BlogController@show' )->name('blog post');
