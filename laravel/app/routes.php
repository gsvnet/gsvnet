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
        'as' => 'post-login',
        'before' => array('csrf'),
        'uses' => 'UserController@postLogin'
    )
);

Route::get('login', array(
        'as' => 'get-login',
        'uses' => 'UserController@getLogin'
    )
);

Route::get('logout', array(
        'as' => 'get-logout',
        'before' => array('auth'),
        'uses' => 'UserController@getLogout'
    )
);

// Only logged in users can view the member list if they have permission
Route::group(array('prefix' => 'jaarbundel', 'before' => 'auth|can:viewMemberlist'), function()
{

    Route::get('/', [
        'as' => 'user-list',
        'uses' => 'UserController@showUsers'
    ]);

    Route::get('/gsver-{id}', [
        'as' => 'user-profile',
        'uses' => 'UserController@showUser'
    ])->where('id', '[0-9]+');
});

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

Route::get('activiteiten/{id}', [
    'as' => 'show_event',
    'uses' => 'EventController@showEvent'
]);

Route::get('albums/{id}', [
    'as'    => 'show_media',
    'uses'  => 'PhotoController@showPhotos'
])->where('id', '[0-9]+');



// TODO: check if user has album permissions
Route::group(array('prefix' => 'markadmin'), function()
{
    Route::resource('albums', 'Admin\AlbumController');
    Route::resource('albums.photo', 'Admin\PhotoController');
});

App::missing(function($exception)
{
    $data = array(
        'title' => 'Pagina niet gevonden - GSVnet',
        'description' => '',
        'keywords' => ''
    );

    return Response::view('errors.missing', $data, 404);
});
