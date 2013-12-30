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

Route::group(['prefix' => 'intern', 'before' => 'auth'], function() {
    Route::get('profiel', 'UserController@showProfile');
    Route::get('profiel/edit', 'UserController@editProfile');

    Route::resource('bestanden', 'FilesController');
    // Only logged in users can view the member list if they have permission
    Route::group(array('prefix' => 'jaarbundel', 'before' => 'can:viewMemberlist'), function()
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

    Route::get('senaten', 'AboutController@showSenates');
    Route::get('senaten/{senaat}', 'AboutController@showSenate');

    Route::get('contact', 'AboutController@showContact');
});

Route::get('word-lid', [
        'as' => 'word-lid',
        'uses' => 'HomeController@wordLid'
    ]
);

Route::post('word-lid', [
        'as' => 'post-word-lid',
        'before' => 'auth|usertype:visitor',
        'uses' => 'UserController@postWordLid'
    ]
);

Route::post('register', array(
        'as' => 'post-register',
        'uses' => 'UserController@postRegister'
    )
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

Route::get('activiteiten/bekijk-{id}', [
    'as' => 'show_event',
    'uses' => 'EventController@showEvent'
]);

Route::get('activiteiten/{year}/{month?}', [
    'as' => 'show_event',
    'uses' => 'EventController@showMonth'
]);


// TODO: check if user has album permissions
Route::group(array('prefix' => 'markadmin'), function()
{
    Former::framework('TwitterBootstrap3');
    Route::get('/', 'Admin\AdminController@index');
    Route::resource('events', 'Admin\EventController');
    Route::resource('albums', 'Admin\AlbumController');
    Route::resource('albums.photo', 'Admin\PhotoController');

    Route::resource('files', 'Admin\FilesController');
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
