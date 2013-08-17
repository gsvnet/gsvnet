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

/*
// Login and logout routes
 */
Route::post('login', array(
        'as' => 'post_login',
        'before' => array('csrf'),
        'uses' => 'LoginController@post_login'
    )
);

Route::get('logout', array(
        'as' => 'get_logout',
        'before' => array('auth'),
        'uses' => 'LoginController@get_logout'
    )
);


Route::group(array('prefix' => 'de-gsv'), function()
{

    Route::get('/', [
            'as' => 'about',
            'uses' => 'AboutController@showAbout'
        ]
    );
});

Route::get('albums', [
    'as' => 'albums',
    'uses' => 'PhotoController@showAlbums'
]);

Route::get('albums/{id}', [
    'as' => 'show_media',
    'uses' => 'PhotoController@showPhotos'
])->where('id', '[0-9]+');

Route::get('activiteiten', [
    'as' => 'activiteiten',
    'uses' => 'EventController@showIndex'
]);