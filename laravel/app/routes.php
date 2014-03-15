<?php
// We keep the home route name as some build in functions use the 'home' name
Route::get('/', ['as' => 'home',
    'uses' => 'HomeController@showIndex'
]);

// Login and logout routes
Route::get('login', 'SessionController@getLogin');
Route::post('login', 'SessionController@postLogin')->before('csrf');
Route::get('logout', 'SessionController@getLogout')->before('auth');

// Intern
Route::group(['prefix' => 'intern', 'before' => 'auth'], function() {
    // Profiles
    Route::get('profiel',             'UserController@showProfile');
    Route::get('profiel/bewerken',    'UserController@editProfile');
    Route::post('profiel/bewerken',   'UserController@updateProfile');

    // GSVdocs
    Route::group(['before' => 'has:member-or-former-member'], function() {
        Route::get('bestanden',      'FilesController@index');
        Route::get('bestanden/{id}', 'FilesController@show');
    });

    // Only logged in users can view the member list if they have permission
    Route::group(['before' => 'has:users.show'], function() {
        Route::get('jaarbundel',             'UserController@showUsers');
        Route::get('jaarbundel/gsver-{id}',  'UserController@showUser')->where('id', '[0-9]+');

    });
    // Shows photo corresponding to profile with id
    Route::get('jaarbundel/{id}/foto',   'MemberController@showPhoto')->before('');
});

// De GSV
Route::group(array('prefix' => 'de-gsv'), function() {
    Route::get('/',                 'AboutController@showAbout');

    Route::get('/pijlers',          'AboutController@showPillars');
    Route::get('/geschiedenis',     'AboutController@showHistory');

    Route::get('commissies',        'AboutController@showCommittees');
    Route::get('commissies/{id}',   'AboutController@showCommittee');

    Route::get('senaten',           'AboutController@showSenates');
    Route::get('senaten/{senaat}',  'AboutController@showSenate');

    Route::get('contact',           'AboutController@showContact');
});

// Register
Route::get('registreer',    'RegisterController@create');
Route::post('registreer',   'RegisterController@store');

// Word lid
Route::get('word-lid',      'MemberController@index')->before('canBecomeMember');
Route::post('word-lid',     'MemberController@store');

// Albums
Route::get('albums',         'PhotoController@showAlbums');
Route::get('albums/{album}', 'PhotoController@showPhotos');

// Get photo images
Route::group(array('prefix' => 'albums/{album}/photo/{photo}'), function() {
    Route::get('/',      'PhotoController@showPhoto');
    Route::get('/wide',  'PhotoController@showPhotoWide');
    Route::get('/small', 'PhotoController@showPhotoSmall');
});

// Events
Route::get('activiteiten',                 'EventController@showIndex');
Route::get('activiteiten/bekijk-{id}',     'EventController@showEvent');
// Hier filter je of de opgegeven jaar en datum goed zijn
Route::get('activiteiten/{year}/{month?}', 'EventController@showMonth')->before('checkDate');

Route::group(['prefix' => 'wachtwoord-vergeten'], function() {
    Route::get('herinner', 'RemindersController@getRemind');
    Route::post('herinner', 'RemindersController@postRemind');
    Route::get('reset/{token}', 'RemindersController@getReset');
    Route::post('reset', 'RemindersController@postReset');
});


// TODO: check if user has album permissions
Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'before' => 'auth|has:member-or-former-member'
    ], function() {

    Route::get('/', 'AdminController@index');
    // events, albums/{photo}, files
    Route::resource('events',       'EventController');
    Route::resource('albums',       'AlbumController',  ['except' => ['create']]);
    Route::resource('albums.photo', 'PhotoController',  ['except' => ['index', 'create']]);
    Route::resource('files',        'FilesController');

    // Only administrators (web committee members) can manage  committees and users
    Route::group(['before' => 'has:admin'], function() {

        // Commissies
        Route::resource('commissies',   'CommitteeController', ['except' => ['create']]);
        // Hier nog een route voor ajax calls naar users db
        Route::post('commissies/{committee}/members',            'Committees\MembersController@store');
        Route::delete('commissies/{committee}/members/{member}', 'Committees\MembersController@destroy');

        // Senaten
        Route::resource('senaten',   'SenateController');
        // Hier nog een route voor ajax calls naar users db
        Route::post('senaten/{senate}/members',            'Senates\MembersController@store');
        Route::delete('senaten/{senate}/members/{member}', 'Senates\MembersController@destroy');

        // Gebruikers
        Route::group(['prefix' => 'gebruikers'], function() {
            Route::resource('/',      'UsersController');

            Route::post('{user}/activeren', 'UsersController@activate');
            Route::post('{user}/accepteer-lid',   'UsersController@accept');

            Route::get('/gasten',     'UsersController@showGuests');
            Route::get('/potentiaal', 'UsersController@showPotentials');
            Route::get('/leden',      'UsersController@showMembers');
            Route::get('/oud-leden',  'UsersController@showFormerMembers');
        });
    });
});

// Forum
Route::group(['before' => ['auth', 'approved']], function() {
    // Edit rotues
    Route::get('forum/bewerk-onderwerp/{threadId}',  'ForumThreadsController@getEditThread');
    Route::post('forum/bewerk-onderwerp/{threadId}', 'ForumThreadsController@postEditThread');
    Route::get('forum/bewerk-reactie/{replyId}',     'ForumRepliesController@getEditReply');
    Route::post('forum/bewerk-reactie/{replyId}',    'ForumRepliesController@postEditReply');

    // Delete routes
    Route::get('forum/verwijder-reactie/{replyId}',       'ForumRepliesController@getDelete');
    Route::delete('forum/verwijder-reactie/{replyId}',    'ForumRepliesController@postDelete');
    Route::get('forum/verwijder-onderwerp/{threadId}',    'ForumThreadsController@getDelete');
    Route::delete('forum/verwijder-onderwerp/{threadId}', 'ForumThreadsController@postDelete');

    // Create routes
    Route::get('forum/nieuw-onderwerp',  'ForumThreadsController@getCreateThread');
    Route::post('forum/nieuw-onderwerp', 'ForumThreadsController@postCreateThread');
    Route::post('forum/{slug}',          'ForumRepliesController@postCreateReply');
});


// Forum index, search, show comment, show thread
Route::get('forum',        'ForumThreadsController@getIndex');
Route::get('forum/search', 'ForumThreadsController@getSearch');

// Make sure non members can't show private topics
Route::get('forum/{slug}/reactie/{commentId}', 'ForumRepliesController@getReplyRedirect')
    ->before('threads.show');
Route::get('forum/{slug}', 'ForumThreadsController@getShowThread')
    ->before('threads.show');
