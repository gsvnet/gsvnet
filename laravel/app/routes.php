<?php
Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@showIndex'
    ]
);

// Login and logout routes
Route::post('login', 'SessionController@postLogin')->before('csrf');
Route::get('login', 'SessionController@getLogin');
Route::get('logout', 'SessionController@getLogout')
    ->before('auth');

// Intern
Route::group(['prefix' => 'intern', 'before' => 'auth'], function() {
    Route::get('profiel', 'UserController@showProfile');
    Route::get('profiel/edit', 'UserController@editProfile');

    Route::resource('bestanden', 'FilesController');
    // Only logged in users can view the member list if they have permission
    Route::group(array('prefix' => 'jaarbundel', 'before' => 'can:viewMemberlist'), function()
    {
        Route::get('/', 'UserController@showUsers');

        Route::get('/gsver-{id}', 'UserController@showUser')
            ->where('id', '[0-9]+');
    });
});

// De GSV
Route::group(array('prefix' => 'de-gsv'), function()
{
    Route::get('/', 'AboutController@showAbout');

    Route::get('commissies', 'AboutController@showCommittees');
    Route::get('commissies/{id}', 'AboutController@showCommittee');

    Route::get('senaten', 'AboutController@showSenates');
    Route::get('senaten/{senaat}', 'AboutController@showSenate');

    Route::get('contact', 'AboutController@showContact');
});

// Word lid
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

// Albums
Route::get('albums', 'PhotoController@showAlbums');
Route::get('albums/{album}', 'PhotoController@showPhotos');

// Events
Route::get('activiteiten', 'EventController@showIndex');
Route::get('activiteiten/bekijk-{id}', 'EventController@showEvent');
Route::get('activiteiten/{year}/{month?}', 'EventController@showMonth');


// TODO: check if user has album permissions
Route::group(array('prefix' => 'markadmin'), function()
{
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
