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
    Route::get('bestanden', 'FilesController@index');

    // Ads
    Route::get('sponsorprogramma', 'HomeController@sponsorProgram');

    // Only logged in users can view the member list if they have permission
    Route::get('jaarbundel',       'UserController@showUsers');
    Route::get('jaarbundel/{id}',  'UserController@showUser')->where('id', '[0-9]+');
    Route::get('jaarbundel/adressen', 'UserController@showAddresses');
});

Route::group(['prefix' => 'uploads'], function() {
    Route::get('bestanden/{id}', 'FilesController@show');
    // Shows photo corresponding to photo id
    Route::get('fotos/{id}/{type?}', 'PhotoController@showPhoto');
    // Shows photo corresponding to profile with id
    Route::get('gebruikers/{id}/{type?}', 'MemberController@showPhoto');
});

// De GSV
Route::group(['prefix' => 'de-gsv'], function() {
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
    Route::get('inschrijven',  'MemberController@becomeMember');
    Route::post('inschrijven', 'MemberController@store');
});

// Albums
Route::get('albums', 'PhotoController@showAlbums');
Route::get('albums/{slug}', 'PhotoController@showPhotos');
// Events
Route::get('activiteiten', 'EventController@showIndex');
Route::get('activiteiten/{year}/{month?}', 'EventController@showMonth')->middleware('checkDate');
Route::get('activiteiten/{year}/{month}/{slug}', 'EventController@showEvent')->middleware('checkDate');

Route::group(['prefix' => 'wachtwoord-vergeten'], function() {
    Route::get('herinner', 'RemindersController@getEmail');
    Route::post('herinner', 'RemindersController@postEmail');
    Route::get('reset/{token}', 'RemindersController@getReset');
    Route::post('reset', 'RemindersController@postReset');
});

Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'has:member-or-former-member']
    ], function() {

    Route::get('/', 'AdminController@index');

    // events, albums/{photo}, files
    Route::resource('events',       'EventController');
    Route::resource('albums',       'AlbumController',  ['except' => ['create']]);
    Route::resource('albums.photo', 'PhotoController',  ['except' => ['index', 'create']]);
    Route::resource('files',        'FilesController');


    // Commissies
    Route::resource('commissies',   'CommitteeController', ['except' => ['create']]);

    // Hier nog een route voor ajax calls naar users db
    Route::resource('commissies/lidmaatschap', 'Committees\MembersController');

    // Users
    Route::group(['prefix' => 'gebruikers'], function() {
        Route::post('/{user}/activeren', 'UsersController@activate');
        Route::post('/{user}/accepteer-lid', 'UsersController@accept');
        Route::post('/{user}/profiel/create', 'UsersController@storeProfile');
        Route::put('/{user}/profiel', 'UsersController@updateProfile');
        Route::delete('/{user}/profiel', 'UsersController@destroyProfile');

        Route::get('/gasten',     'UsersController@showGuests');
        Route::get('/novieten',   'UsersController@showPotentials');
        Route::get('/leden',      'UsersController@showMembers');
        Route::get('/oud-leden',  'UsersController@showFormerMembers');
    });

    // Each part of the profile
    Route::get('leden/{user}/contact',       'MemberController@editContactDetails');
    Route::put('leden/{user}/contact',       'MemberController@updateContactDetails');
    Route::get('leden/{user}/email',         'MemberController@editEmail');
    Route::put('leden/{user}/email',         'MemberController@updateEmail');
    Route::get('leden/{user}/wachtwoord',    'MemberController@editPassword');
    Route::put('leden/{user}/wachtwoord',    'MemberController@updatePassword');
    Route::get('leden/{user}/geboortedatum', 'MemberController@editBirthDay');
    Route::put('leden/{user}/geboortedatum', 'MemberController@updateBirthDay');
    Route::get('leden/{user}/geslacht',      'MemberController@editGender');
    Route::put('leden/{user}/geslacht',      'MemberController@updateGender');
    Route::get('leden/{user}/jaarverband',   'MemberController@editYearGroup');
    Route::put('leden/{user}/jaarverband',   'MemberController@updateYearGroup');
    Route::get('leden/{user}/naam',          'MemberController@editName');
    Route::put('leden/{user}/naam',          'MemberController@updateName');
    Route::get('leden/{user}/werk',          'MemberController@editBusiness');
    Route::put('leden/{user}/werk',          'MemberController@updateBusiness');
    Route::get('leden/{user}/foto',          'MemberController@editPhoto');
    Route::put('leden/{user}/foto',          'MemberController@updatePhoto');
    Route::get('leden/{user}/ouders',        'MemberController@editParentContactDetails');
    Route::put('leden/{user}/ouders',        'MemberController@updateParentContactDetails');
    Route::get('leden/{user}/tijd-van-lidmaatschap', 'MemberController@editMembershipPeriod');
    Route::put('leden/{user}/tijd-van-lidmaatschap', 'MemberController@updateMembershipPeriod');
    

    Route::get('leden/oudleden.csv', 'UsersController@exportFormerMembers');
    Route::get('leden/leden.csv', 'UsersController@exportMembers');
    Route::get('leden/updates', 'MemberController@latestUpdates');

    Route::resource('gebruikers', 'UsersController');
    Route::resource('gebruikers.family', 'FamilyController');

    // Senaten
    Route::resource('senaten',   'SenateController');
    // Hier nog een route voor ajax calls naar users db
    Route::post('senaten/{senate}/members',            'Senates\MembersController@store');
    Route::delete('senaten/{senate}/members/{member}', 'Senates\MembersController@destroy');
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

Route::group(['prefix' => 'api', 'middleware' => ['auth', 'approved', 'has:member-or-former-member']], function() {
    Route::get('search/members', 'ApiController@members');
});

// Forum index, search, show comment, show thread
Route::get('forum',      'ForumThreadsController@getIndex');
Route::get('forum/zoek', 'ForumThreadsController@getSearch');
Route::get('forum/{slug}', 'ForumThreadsController@getShowThread');