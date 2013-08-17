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

/*
// Login and logout routes
 */
Route::post('login', array(
        'as' => 'post_login',
        'before' => array('csrf'),
        'uses' => 'UserController@post_login'
    )
);

Route::get('login', array(
        'as' => 'get_login',
        'uses' => 'UserController@get_login'
    )
);

Route::get('logout', array(
        'as' => 'get_logout',
        'before' => array('auth'),
        'uses' => 'UserController@get_logout'
    )
);


Route::group(array('prefix' => 'de-gsv'), function()
{

    Route::get('/', [
            'as' => 'about',
            'uses' => 'AboutController@showAbout'
        ]
    );

    Route::get('commissies', [
            'as' => 'about_committees',
            'uses' => 'AboutController@showCommittees'
        ]
    );

    Route::get('commissies/{id}', [
            'as' => 'show_committee',
            'uses' => 'AboutController@showCommittee'
        ]
    );
});

Route::get('word-lid', [
        'as' => 'word-lid',
        'uses' => 'HomeController@wordLid'
    ]
);

Route::get('albums', [
    'as'    => 'albums',
    'uses'  => 'PhotoController@showAlbums'
]);

Route::get('albums/{id}', [
    'as'    => 'show_media',
    'uses'  => 'PhotoController@showPhotos'
])->where('id', '[0-9]+');

Route::get('activiteiten', [
    'as' => 'activiteiten',
    'uses' => 'EventController@showIndex'
]);

Route::get('albums/{id}', [
    'as'    => 'show_media',
    'uses'  => 'PhotoController@showPhotos'
])->where('id', '[0-9]+');
