<?php

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
        'uses' => 'SessionController@postLogin'
    )
);

Route::get('login', array(
        'as' => 'get-login',
        'uses' => 'SessionController@getLogin'
    )
);

Route::get('logout', array(
        'as' => 'get-logout',
        'before' => array('auth'),
        'uses' => 'SessionController@getLogout'
    )
);

Route::group(array('prefix' => 'jaarbundel', 'before' => 'auth|can:viewMemberlist'), function()
{

    Route::get('/', [
        'as' => 'user-list',
        'uses' => 'UserController@showUsers'
    ]);

    Route::get('/gsver-{id}', [
        'as' => 'user-profile',
        'users' => 'UserController@showUser'
    ]);
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

Route::get('albums/{album}', [
    'as'    => 'show_media',
    'uses'  => 'PhotoController@showPhotos'
]);

Route::get('activiteiten', [
    'as' => 'activiteiten',
    'uses' => 'EventController@showIndex'
]);

Route::get('activiteiten/{id}', [
    'as' => 'show_event',
    'uses' => 'EventController@showEvent'
]);


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
