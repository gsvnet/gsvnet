<?php

// We keep the home route name as some build in functions use the 'home' name
Route::get('/', ['as' => 'home',
    'uses' => 'HomeController@showIndex'
]);

// Login and logout routes
Route::get('inloggen', ['middleware' => 'guest', 'uses' => 'SessionController@getLogin']);
Route::post('inloggen', ['middleware' => 'guest', 'uses' => 'SessionController@postLogin']);
Route::get('uitloggen', ['middleware' => 'auth', 'uses' => 'SessionController@getLogout']);

// Intern
Route::group(['prefix' => 'intern', 'middleware' => 'auth'], function() {
    // Profiles
    Route::get('profiel',             'UserController@showProfile');
    Route::get('profiel/bewerken',    'UserController@editProfile');
    Route::post('profiel/bewerken',   'UserController@updateProfile');

    // GSVdocs
    Route::get('bestanden', 'FilesController@index')->before('has:docs.show');

    // Ads
    Route::get('sponsorprogramma', 'HomeController@sponsorProgram')->before('has:sponsor-program.show');

    // Only logged in users can view the member list if they have permission
    Route::group(['before' => 'has:users.show'], function() {
        Route::get('jaarbundel',       'UserController@showUsers');
        Route::get('jaarbundel/{id}',  'UserController@showUser')->where('id', '[0-9]+');
    });
});

Route::group(['prefix' => 'uploads'], function() {
    Route::get('bestanden/{id}', 'FilesController@show')->before('has:docs.show');
    // Shows photo corresponding to photo id
    Route::get('fotos/{id}/{type?}', 'PhotoController@showPhoto')->before('photos.show');
    // Shows photo corresponding to profile with id
    Route::get('gebruikers/{id}/{type?}', 'MemberController@showPhoto');
});

// De GSV
Route::group(array('prefix' => 'de-gsv'), function() {
    Route::get('/', 'AboutController@showAbout');

    Route::get('/pijlers', 'AboutController@showPillars');
    Route::get('/geschiedenis', 'AboutController@showHistory');

    Route::get('commissies', 'AboutController@showCommittees');
    Route::get('commissies/{id}', 'AboutController@showCommittee');

    Route::get('senaten', 'AboutController@showSenates');
    Route::get('senaten/{senaat}', 'AboutController@showSenate');

    Route::get('contact', 'AboutController@showContact');
    Route::get('oud-leden', 'AboutController@showFormerMembers');
});

// Register
Route::get('registreer', 'RegisterController@create');
Route::post('registreer', 'RegisterController@store');

// Word lid
Route::group(['prefix' => 'word-lid'], function() {
    Route::get('/', 'MemberController@index');
    Route::get('/veel-gestelde-vragen', 'MemberController@faq');
    Route::get('inschrijven',  'MemberController@becomeMember')->before('canBecomeMember');
    Route::post('inschrijven', 'MemberController@store');
});

// Albums
Route::get('albums', 'PhotoController@showAlbums');
Route::get('albums/{slug}', 'PhotoController@showPhotos');
// Events
Route::get('activiteiten', 'EventController@showIndex');
Route::get('activiteiten/{year}/{month?}', 'EventController@showMonth')->before('checkDate');
Route::get('activiteiten/{year}/{month}/{slug}', 'EventController@showEvent')->before('checkDate');

Route::group(['prefix' => 'wachtwoord-vergeten'], function() {
    Route::get('herinner', 'RemindersController@getEmail');
    Route::post('herinner', 'RemindersController@postEmail');
    Route::get('reset/{token}', 'RemindersController@getReset');
    Route::post('reset', 'RemindersController@postReset');
});

Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth',
        'before' => 'has:member-or-former-member'
    ], function() {

    Route::get('/', 'AdminController@index');

    // events, albums/{photo}, files
    Route::resource('events',       'EventController');
    Route::resource('albums',       'AlbumController',  ['except' => ['create']]);
    Route::resource('albums.photo', 'PhotoController',  ['except' => ['index', 'create']]);
    Route::resource('files',        'FilesController');

    Route::get('/users/oudleden.csv', 'UsersController@exportFormerMembers');
    Route::get('/users/leden.csv', 'UsersController@exportMembers');

    // Committees
    Route::group(['before' => 'has:committees.manage'], function() {

        // Commissies
        Route::resource('commissies',   'CommitteeController', ['except' => ['create']]);

        // Hier nog een route voor ajax calls naar users db
        Route::resource('commissies/lidmaatschap', 'Committees\MembersController');
        // Route::post('commissies/{committee}/members',            'Committees\MembersController@store');
        // Route::delete('commissies/{committee}/members/{member}', 'Committees\MembersController@destroy');
    });

    // Users
    Route::group(['before' => 'has:users.show'], function() {
        Route::group(['prefix' => 'gebruikers'], function() {
            Route::post('/{user}/activeren', 'UsersController@activate');
            Route::post('/{user}/accepteer-lid', 'UsersController@accept');
            Route::post('/{user}/profiel/create', 'UsersController@storeProfile');
            Route::put('/{user}/profiel', 'UsersController@updateProfile');
            Route::delete('/{user}/profiel', 'UsersController@destroyProfile');

            Route::get('/gasten',     'UsersController@showGuests');
            Route::get('/novieten', 'UsersController@showPotentials');
            Route::get('/leden',      'UsersController@showMembers');
            Route::get('/oud-leden',  'UsersController@showFormerMembers');
        });

        Route::resource('gebruikers', 'UsersController');
        Route::resource('gebruikers.family', 'FamilyController');
    });

    // Senates
    Route::group(['before' => 'has:senates.manage'], function() {
        // Senaten
        Route::resource('senaten',   'SenateController');
        // Hier nog een route voor ajax calls naar users db
        Route::post('senaten/{senate}/members',            'Senates\MembersController@store');
        Route::delete('senaten/{senate}/members/{member}', 'Senates\MembersController@destroy');
    });
});

// Forum
Route::group(['prefix' => 'forum', 'middleware' => ['auth', 'approved']], function() {

    Route::get('stats', 'ForumThreadsController@statistics');

    Route::get('prullenbak', 'ForumThreadsController@getTrashed');

    // Edit routes
    Route::get('bewerk-onderwerp/{threadId}',  'ForumThreadsController@getEditThread');
    Route::post('bewerk-onderwerp/{threadId}', 'ForumThreadsController@postEditThread');
    Route::get('bewerk-reactie/{replyId}',     'ForumRepliesController@getEditReply');
    Route::post('bewerk-reactie/{replyId}',    'ForumRepliesController@postEditReply');

    // Delete routes
    Route::get('verwijder-reactie/{replyId}',       'ForumRepliesController@getDelete');
    Route::delete('verwijder-reactie/{replyId}',    'ForumRepliesController@postDelete');
    Route::get('verwijder-onderwerp/{threadId}',    'ForumThreadsController@getDelete');
    Route::delete('verwijder-onderwerp/{threadId}', 'ForumThreadsController@postDelete');

    // Create routes
    Route::get('nieuw-onderwerp',  'ForumThreadsController@getCreateThread');
    Route::post('nieuw-onderwerp', 'ForumThreadsController@postCreateThread');
    Route::post('{slug}',          'ForumRepliesController@postCreateReply');

    // Quotes
    Route::get('threads/quote/{threadId}', 'ForumApiController@quoteThread');
    Route::get('quote/{replyId}', 'ForumApiController@quoteReply');

    // Likes
    Route::post('replies/{id}/like', 'ForumApiController@likeReply');
    Route::delete('replies/{id}/like', 'ForumApiController@dislikeReply');
    Route::post('threads/{id}/like', 'ForumApiController@likeThread');
    Route::delete('threads/{id}/like', 'ForumApiController@dislikeThread');
});

Route::get('preview', ['middleware' => 'auth', 'uses' => 'ForumApiController@preview']);

Route::group(['prefix' => 'api', 'before' => 'has:member-or-former-member', 'middleware' => ['auth', 'approved']], function() {
    Route::get('search/members', 'ApiController@members');
});

// Forum index, search, show comment, show thread
Route::get('forum',      'ForumThreadsController@getIndex');
Route::get('forum/zoek', 'ForumThreadsController@getSearch');
Route::get('forum/{slug}', 'ForumThreadsController@getShowThread');