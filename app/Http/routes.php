<?php

Route::get('/',          [ 'as' => 'home',      'uses' => 'HomeController@index' ]);
Route::get('/changelog', [ 'as' => 'changelog', 'uses' => 'ChangelogController@index' ]);

Route::get('/docs/{slug}', [ 'as' => 'documentation', 'uses' => 'DocsController@index' ]);
