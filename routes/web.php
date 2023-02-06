<?php

// We keep the home route name as some built in functions use the 'home' name
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@showIndex']);

// Keep the new homepage accessible
Route::get('welkom', ['as' => 'home', 'uses' => 'HomeController@showNewIndex']);

// Nothing to see here, move along
Route::get('roos', 'HomeController@roos');

// Kiezel 2020
// Route::get('kiezel', 'HomeController@showKiezel');

// Kei 2020
// Route::get('kei', 'HomeController@showKei');

// Privacy-related stuff
Route::get('privacy-statement', 'PublicFilesController@showPrivacyStatement');

// Login and logout routes
Route::get('inloggen', ['middleware' => 'guest', 'uses' => 'SessionController@getLogin']);
Route::post('inloggen', ['middleware' => 'guest', 'uses' => 'SessionController@postLogin']);
Route::get('uitloggen', ['middleware' => 'auth', 'uses' => 'SessionController@getLogout']);

// Intern
Route::group(['prefix' => 'intern', 'middleware' => 'auth'], function () {
    // Profiles
    Route::get('profiel', 'UserController@showProfile');
    Route::get('profiel/bewerken', 'UserController@editProfile');
    Route::post('profiel/bewerken', 'UserController@updateProfile');

    // GSVdocs
    Route::get('bestanden', 'FilesController@index');

    // Ads
    Route::get('sponsorprogramma', 'HomeController@sponsorProgram');
});

// Jaarbundel
Route::group(['middleware' => 'auth'], function () {
    // Only logged in users can view the member list if they have permission
    Route::get('jaarbundel', 'UserController@showUsers');
    Route::get('jaarbundel/{id}', 'UserController@showUser')->where('id', '[0-9]+');
});

//Sponsors
Route::get('sponsors', 'HomeController@sponsorProgram');

Route::group(['prefix' => 'uploads'], function () {
    Route::get('bestanden/{id}', 'FilesController@show');
    // Shows photo corresponding to photo id
    Route::get('fotos/{id}/{type?}', 'PhotoController@showPhoto');
    // Shows photo corresponding to profile with id
    Route::get('gebruikers/{id}/{type?}', 'MemberController@showPhoto');
});

// De GSV
Route::group(['prefix' => 'de-gsv'], function () {
    Route::get('/', 'AboutController@showAbout');

    Route::get('/pijlers', 'AboutController@showPillars');
    Route::get('/geschiedenis', 'AboutController@showHistory');

    Route::get('vertrouwenspersonen', 'AboutController@showConfidants');

    Route::get('commissies', 'AboutController@showCommittees');
    Route::get('commissies/{id}', 'AboutController@showCommittee');

    Route::get('senaten', 'AboutController@showSenates');
    Route::get('senaten/{senaat}', 'AboutController@showSenate');

    Route::get('contact', 'AboutController@showContact');
    // Route::get('oud-leden', 'AboutController@showFormerMembers');
});

// Register - disabled due to excess of spam
//Route::get('registreer', 'RegisterController@create');
//Route::post('registreer', 'RegisterController@store');

// Word lid
Route::group(['prefix' => 'word-lid'], function () {
    Route::get('/', 'MemberController@index');
    Route::get('/studie-en-vereniging', 'MemberController@study');
    // Corona Q&A
    Route::get('corona', 'MemberController@showCorona');
    Route::get('/veel-gestelde-vragen', 'MemberController@faq');
    Route::get('klachtencommissie', 'MemberController@complaints');
    Route::get('inschrijven', 'MemberController@becomeMember');
    Route::post('inschrijven', 'MemberController@store');
});

// Albums
Route::get('albums', 'PhotoController@showAlbums');
Route::get('albums/{slug}', 'PhotoController@showPhotos');

// Events
Route::get('activiteiten', 'EventController@showIndex');
Route::get('activiteiten/{year}/{month?}', 'EventController@showMonth')->middleware('checkDate');
Route::get('activiteiten/{year}/{month}/{slug}', 'EventController@showEvent')->middleware('checkDate');

Route::group(['prefix' => 'wachtwoord-vergeten'], function () {
    Route::get('herinner', 'RemindersController@getEmail');
    Route::post('herinner', 'RemindersController@postEmail');
    Route::get('reset/{token}', 'RemindersController@getReset');
    Route::post('reset', 'RemindersController@postReset');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'has:member-or-reunist'],
], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/me', 'AdminController@redirectToMyProfile');

    // events, albums/{photo}, files
    Route::resource('events', 'EventController');
    Route::resource('albums', 'AlbumController', ['except' => ['create']]);
    Route::resource('albums.photo', 'PhotoController', ['except' => ['index', 'create']]);
    Route::resource('files', 'FilesController');

    // Commissies
    Route::resource('commissies', 'CommitteeController', ['except' => ['create']]);

    // Hier nog een route voor ajax calls naar users db
    Route::resource('commissies/lidmaatschap', 'Committees\MembersController');

    // Users
    Route::group(['prefix' => 'gebruikers'], function () {
        Route::post('/{user}/activeren', 'UsersController@activate');
        Route::post('/{user}/accepteer-lid', 'UsersController@accept');
        Route::post('/{user}/profiel/create', 'UsersController@storeProfile');
        Route::put('/{user}/profiel', 'UsersController@updateProfile');
        Route::delete('/{user}/profiel', 'UsersController@destroyProfile');

        Route::get('/gasten', 'UsersController@showGuests');
        Route::get('/novieten', 'UsersController@showPotentials');
        Route::get('/leden', 'UsersController@showMembers');
        Route::get('/oud-leden', 'UsersController@showFormerMembers');
    });

    // Each part of the profile
    Route::get('leden/{user}/contact', 'MemberController@editContactDetails');
    Route::put('leden/{user}/contact', 'MemberController@updateContactDetails');
    Route::get('leden/{user}/email', 'MemberController@editEmail');
    Route::put('leden/{user}/email', 'MemberController@updateEmail');
    Route::get('leden/{user}/wachtwoord', 'MemberController@editPassword');
    Route::put('leden/{user}/wachtwoord', 'MemberController@updatePassword');
    Route::get('leden/{user}/geboortedatum', 'MemberController@editBirthDay');
    Route::put('leden/{user}/geboortedatum', 'MemberController@updateBirthDay');
    Route::get('leden/{user}/geslacht', 'MemberController@editGender');
    Route::put('leden/{user}/geslacht', 'MemberController@updateGender');
    Route::get('leden/{user}/jaarverband', 'MemberController@editYearGroup');
    Route::put('leden/{user}/jaarverband', 'MemberController@updateYearGroup');
    Route::get('leden/{user}/naam', 'MemberController@editName');
    Route::put('leden/{user}/naam', 'MemberController@updateName');
    Route::get('leden/{user}/gebruikersnaam', 'MemberController@editUsername');
    Route::put('leden/{user}/gebruikersnaam', 'MemberController@updateUsername');
    Route::get('leden/{user}/werk', 'MemberController@editBusiness');
    Route::put('leden/{user}/werk', 'MemberController@updateBusiness');
    Route::get('leden/{user}/foto', 'MemberController@editPhoto');
    Route::put('leden/{user}/foto', 'MemberController@updatePhoto');
    Route::get('leden/{user}/ouders', 'MemberController@editParentContactDetails');
    Route::put('leden/{user}/ouders', 'MemberController@updateParentContactDetails');
    Route::get('leden/{user}/studie', 'MemberController@editStudy');
    Route::put('leden/{user}/studie', 'MemberController@updateStudy');
    Route::get('leden/{user}/regio', 'MemberController@editRegion');
    Route::put('leden/{user}/regio', 'MemberController@updateRegion');
    Route::get('leden/{user}/tijd-van-lidmaatschap', 'MemberController@editMembershipPeriod');
    Route::put('leden/{user}/tijd-van-lidmaatschap', 'MemberController@updateMembershipPeriod');
    Route::get('leden/{user}/in-leven', 'MemberController@editAlive');
    Route::put('leden/{user}/in-leven', 'MemberController@updateAlive');
    Route::get('leden/{user}/sic-ontvangen', 'MemberController@editNewspaper');
    Route::put('leden/{user}/sic-ontvangen', 'MemberController@updateNewspaper');

    // Some actions (post requests therefore)
    Route::get('leden/{user}/lidmaatschap', 'MemberController@editMembershipStatus');
    Route::post('leden/{user}/lidmaatschap/maak-reunist', 'MemberController@makeReunist');
    Route::post('leden/{user}/lidmaatschap/maak-oud-lid', 'MemberController@makeExMember');
    Route::post('leden/{user}/lidmaatschap/maak-lid', 'MemberController@makeMember');

    // Deleting user data according to GDPR rules
    Route::get('leden/{user}/forget', 'MemberController@setForget');
    Route::post('leden/{user}/forget', 'MemberController@forget');

    Route::get('leden/oudleden.csv', 'UsersController@exportFormerMembers');
    Route::get('leden/leden.csv', 'UsersController@exportMembers');
    Route::get('leden/sic-ontvangers.csv', 'MemberController@exportNewspaperRecipients');
    Route::get('leden/updates', 'MemberController@latestUpdates');

    Route::resource('gebruikers', 'UsersController');
    Route::resource('gebruikers.family', 'FamilyController');

    // Senaten
    Route::resource('senaten', 'SenateController');
    // Hier nog een route voor ajax calls naar users db
    Route::post('senaten/{senate}/members', 'Senates\MembersController@store');
    Route::delete('senaten/{senate}/members/{member}', 'Senates\MembersController@destroy');

    // Extension
    Route::get('extension', 'ExtensionController@index');
    Route::post('extension', 'ExtensionController@store');
});

// Forum
Route::group(['prefix' => 'forum', 'middleware' => ['auth', 'approved']], function () {
    Route::get('stats', 'ForumThreadsController@statistics');

    Route::get('prullenbak', 'ForumThreadsController@getTrashed');

    // Edit routes
    Route::get('bewerk-onderwerp/{threadId}', 'ForumThreadsController@getEditThread');
    Route::post('bewerk-onderwerp/{threadId}', 'ForumThreadsController@postEditThread');
    Route::get('bewerk-reactie/{replyId}', 'ForumRepliesController@getEditReply');
    Route::post('bewerk-reactie/{replyId}', 'ForumRepliesController@postEditReply');

    // Delete routes
    Route::get('verwijder-reactie/{replyId}', 'ForumRepliesController@getDelete');
    Route::delete('verwijder-reactie/{replyId}', 'ForumRepliesController@postDelete');
    Route::get('verwijder-onderwerp/{threadId}', 'ForumThreadsController@getDelete');
    Route::delete('verwijder-onderwerp/{threadId}', 'ForumThreadsController@postDelete');

    // Create routes
    Route::get('nieuw-onderwerp', 'ForumThreadsController@getCreateThread');
    Route::post('nieuw-onderwerp', 'ForumThreadsController@postCreateThread');
    Route::post('{slug}', 'ForumRepliesController@postCreateReply');

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

Route::group(['prefix' => 'api', 'middleware' => ['auth', 'approved', 'has:member-or-reunist']], function () {
    Route::get('search/members', 'ApiController@members');
});

// Forum index, search, show comment, show thread
Route::get('forum', 'ForumThreadsController@getIndex');
Route::get('forum/zoek', 'ForumThreadsController@getSearch');
Route::get('forum/{slug}', 'ForumThreadsController@getShowThread');

// Malfonds
Route::get('admin/leden/{id}/invite', 'Malfonds\InvitationController@create');
Route::post('admin/leden/{id}/invite', 'Malfonds\InvitationController@store');
Route::post('admin/leden/{id}/invite-via-mail', 'Malfonds\InvitationController@inviteByMail');

Route::group(['prefix' => 'api', 'middleware' => ['cors']], function () {
    Route::group(['middleware' => ['loginViaToken', 'tokenAuth']], function () {
        Route::get('me', 'Malfonds\MemberController@me');

        Route::resource('members', 'Malfonds\MemberController');
        Route::resource('yeargroups', 'Malfonds\YearGroupController');
        Route::get('members/{id}/familie', 'Malfonds\MemberController@family');

        Route::get('members/{id}/history', 'Malfonds\MemberHistoryController@show');

        Route::put('members/{id}/naam', 'Malfonds\MemberController@updateName');
        Route::put('members/{id}/email', 'Malfonds\MemberController@updateEmail');
        Route::put('members/{id}/adres', 'Malfonds\MemberController@updateAddress');
        Route::put('members/{id}/jaarverband', 'Malfonds\MemberController@updateYearGroup');
        Route::put('members/{id}/geslacht', 'Malfonds\MemberController@updateGender');
        Route::put('members/{id}/wachtwoord', 'Malfonds\MemberController@updatePassword');

        // Verifications
        Route::post('members/{id}/naam/verifieer', 'Malfonds\MemberController@verifyName');
        Route::post('members/{id}/email/verifieer', 'Malfonds\MemberController@verifyEmail');
        Route::post('members/{id}/jaarverband/verifieer', 'Malfonds\MemberController@verifyYearGroup');
        Route::post('members/{id}/geslacht/verifieer', 'Malfonds\MemberController@verifyGender');
        Route::post('members/{id}/familie/verifieer', 'Malfonds\MemberController@verifyFamily');

        // Invites
        Route::post('members/{id}/invite', 'Malfonds\MemberController@invite');
        Route::put('members/{id}/invite', 'Malfonds\MemberController@requestInvite');
    });

    Route::post('login', 'Malfonds\SessionController@login');
});

Route::group(['prefix' => 'api', 'middleware' => ['cors']], function () {
    // Shop extension
    Route::get('shops', 'ExtensionApiController@show');

    // API for GSVGroningen.nl
    Route::get('events', 'ApiController@events');
});

// Iframes
Route::group(['prefix' => 'iframe'], function () {
    Route::get('inschrijven', 'MemberController@becomeMemberIFrame');
});
