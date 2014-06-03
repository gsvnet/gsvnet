<?php
// We keep the home route name as some build in functions use the 'home' name
Route::get('/', ['as' => 'home',
    'uses' => 'HomeController@showIndex'
]);

// Route::get('/mail', function(){
//     echo 'mail verzenden';
//     Mail::send('emails.testmail', [], function($message)
//     {
//         $message->to('iemairgroi1j2@aoeigjaeorijgaorj-aegaegerg.nl', 'Harmen Stoppels')->subject('Testmail! Dit is om alles te testen');
//         $message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', 'cga81');
//     });
// });

// Login and logout routes
Route::get('inloggen', 'SessionController@getLogin')->before('guest');
Route::post('inloggen', 'SessionController@postLogin')->before('csrf');
Route::get('uitloggen', 'SessionController@getLogout')->before('auth');

// Intern
Route::group(['prefix' => 'intern', 'before' => 'auth'], function() {
    // Profiles
    Route::get('profiel',             'UserController@showProfile');
    Route::get('profiel/bewerken',    'UserController@editProfile');
    Route::post('profiel/bewerken',   'UserController@updateProfile');

    // GSVdocs
    Route::get('bestanden', 'FilesController@index')->before('has:docs.show');

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
Route::get('registreer',            'RegisterController@create');
Route::post('registreer',           'RegisterController@store')->before('csrf');

// Word lid
Route::group(array('prefix' => 'word-lid'), function() {
    Route::get('/',                     'MemberController@index');
    Route::get('/veel-gestelde-vragen', 'MemberController@faq');
    Route::get('inschrijven',  'MemberController@becomeMember')->before('canBecomeMember');
    Route::post('inschrijven', 'MemberController@store')->before('csrf');
});

// Albums
Route::get('albums',         'PhotoController@showAlbums');
Route::get('albums/{slug}',  'PhotoController@showPhotos');
// Events
Route::get('activiteiten',                       'EventController@showIndex');
Route::get('activiteiten/{year}/{month?}',       'EventController@showMonth')->before('checkDate');
Route::get('activiteiten/{year}/{month}/{slug}', 'EventController@showEvent')->before('checkDate');

Route::group(['prefix' => 'wachtwoord-vergeten'], function() {
    Route::get('herinner', 'RemindersController@getRemind');
    Route::post('herinner', 'RemindersController@postRemind');
    Route::get('reset/{token}', 'RemindersController@getReset');
    Route::post('reset', 'RemindersController@postReset');
});

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
            Route::post('/{user}/activeren', 'UsersController@activate');
            Route::post('/{user}/accepteer-lid', 'UsersController@accept');

            Route::get('/gasten',     'UsersController@showGuests');
            Route::get('/novieten', 'UsersController@showPotentials');
            Route::get('/leden',      'UsersController@showMembers');
            Route::get('/oud-leden',  'UsersController@showFormerMembers');
        });

        Route::resource('/gebruikers',      'UsersController');
    });
});

// Forum
Route::group(['prefix' => 'forum', 'before' => ['auth', 'approved']], function() {
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
});


// Forum index, search, show comment, show thread
Route::get('forum',        'ForumThreadsController@getIndex');
Route::get('forum/zoek', 'ForumThreadsController@getSearch');

// Make sure non members can't show private topics
Route::get('forum/{slug}/reactie/{commentId}', 'ForumRepliesController@getReplyRedirect')
    ->before('threads.show');
Route::get('forum/{slug}', 'ForumThreadsController@getShowThread')
    ->before('threads.show');