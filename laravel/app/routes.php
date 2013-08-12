<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@showIndex'
    ]
);

Route::get('word-lid', [
        'as' => 'word-lid',
        'uses' => 'HomeController@wordLid'
    ]
);

Route::group(array('prefix' => 'de-gsv'), function()
{

    Route::get('/', [
            'as' => 'about',
            'uses' => 'AboutController@showAbout'
        ]
    );
});