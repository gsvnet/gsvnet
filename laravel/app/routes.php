<?php
// We keep the home route name as some build in functions use the 'home' name
Route::get('/', ['as' => 'home',
    'uses' => 'HomeController@showIndex'
]);

// Login and logout routes
Route::get('login', 'SessionController@getLogin');
Route::post('login', 'SessionController@postLogin')
    ->before('csrf');
Route::get('logout', 'SessionController@getLogout')
    ->before('auth');

// Intern
Route::group(['prefix' => 'intern', 'before' => 'auth'], function() {
    // Profiles
    Route::get('profiel', 'UserController@showProfile');
    Route::get('profiel/edit', 'UserController@editProfile');
    // GsSVdocs
    Route::get('bestanden', 'FilesController@index');
    Route::get('bestanden/{id}', 'FilesController@show');
    // Only logged in users can view the member list if they have permission
    Route::group(array('prefix' => 'jaarbundel', 'before' => 'can:viewMemberlist'), function() {
        Route::get('/', 'UserController@showUsers');

        Route::get('/gsver-{id}', 'UserController@showUser')
            ->where('id', '[0-9]+');
    });
});

// De GSV
Route::group(array('prefix' => 'de-gsv'), function() {
    Route::get('/', 'AboutController@showAbout');

    Route::get('commissies', 'AboutController@showCommittees');
    Route::get('commissies/{id}', 'AboutController@showCommittee');

    Route::get('senaten', 'AboutController@showSenates');
    Route::get('senaten/{senaat}', 'AboutController@showSenate');

    Route::get('contact', 'AboutController@showContact');
});

// Word lid
// Hier moet een check komen dat je niet al gejoined bent, want de pagina heeft gene zin voor dat soort mensen
Route::get('word-lid', 'HomeController@wordLid');
// Only users which are logged in, but have not yet joined our little club, may post to this form
Route::post('word-lid', 'UserController@postWordLid')
    ->before('auth|usertype:visitor');

Route::post('register', 'UserController@postRegister');

// Albums
Route::get('albums', 'PhotoController@showAlbums');
Route::get('albums/{album}', 'PhotoController@showPhotos');

// Get photo images
// TODO: verander alle referenties naar dez route.
Route::group(array('prefix' => 'albums/{album}/photo/{photo}'), function() {
    Route::get('/', 'PhotoController@showPhoto');
    Route::get('/wide', 'PhotoController@showPhotoWide');
    Route::get('/small', 'PhotoController@showPhotoSmall');
});

// Events
Route::get('activiteiten', 'EventController@showIndex');
Route::get('activiteiten/bekijk-{id}', 'EventController@showEvent');
Route::get('activiteiten/{year}/{month?}', 'EventController@showMonth');

// TODO: check if user has album permissions
Route::group(array('prefix' => 'markadmin'), function() {
    Route::get('/', 'Admin\AdminController@index');

    Route::resource('events', 'Admin\EventController');


    Route::resource('albums', 'Admin\AlbumController',
        ['except' => ['create']]);
    Route::resource('albums.photo', 'Admin\PhotoController',
        ['except' => ['index', 'create']]);

    Route::resource('files', 'Admin\FilesController');

    Route::resource('commissies', 'Admin\CommitteeController',
        ['except' => ['create']]);

    // Hier nog een route voor ajax calls naar users db
    Route::post('commissies/{committee}/',
        'Admin\Committees\MembersController@store');
    Route::delete('commissies/{committee}/members/{member}',
        'Admin\Committees\MembersController@destroy');

    Route::resource('gebruikers', 'Admin\UsersController');
});
