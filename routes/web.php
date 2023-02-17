<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExtensionApiController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ForumApiController;
use App\Http\Controllers\ForumRepliesController;
use App\Http\Controllers\Forum\ForumThreadsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Malfonds;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PublicFilesController;
use App\Http\Controllers\RemindersController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// We keep the home route name as some built in functions use the 'home' name
Route::get('/', [HomeController::class, 'showIndex'])->name('home');

// Keep the new homepage accessible
Route::get('welkom', [HomeController::class, 'showNewIndex'])->name('home');

// Nothing to see here, move along
Route::get('roos', [HomeController::class, 'roos']);

// Kiezel 2020
// Route::get('kiezel', 'HomeController@showKiezel');

// Kei 2020
// Route::get('kei', 'HomeController@showKei');

// Privacy-related stuff
Route::get('privacy-statement', [PublicFilesController::class, 'showPrivacyStatement']);

// Login and logout routes
Route::get('inloggen', [SessionController::class, 'getLogin'])->middleware('guest')->name('login');
Route::post('inloggen', [SessionController::class, 'postLogin'])->middleware('guest');
Route::get('uitloggen', [SessionController::class, 'getLogout'])->middleware('auth');

// Intern
Route::prefix('intern')->middleware('auth')->group(function () {
    // Profiles
    Route::get('profiel', [UserController::class, 'showProfile']);
    Route::get('profiel/bewerken', [UserController::class, 'editProfile']);
    Route::post('profiel/bewerken', [UserController::class, 'updateProfile']);

    // GSVdocs
    Route::get('bestanden', [FilesController::class, 'index']);

    // Ads
    Route::get('sponsorprogramma', [HomeController::class, 'sponsorProgram']);
});

// Jaarbundel
Route::middleware('auth')->group(function () {
    // Only logged in users can view the member list if they have permission
    Route::get('jaarbundel', [UserController::class, 'showUsers']);
    Route::get('jaarbundel/{id}', [UserController::class, 'showUser'])->where('id', '[0-9]+');
});

//Sponsors
Route::get('sponsors', [HomeController::class, 'sponsorProgram']);

Route::prefix('uploads')->group(function () {
    Route::get('bestanden/{id}', [FilesController::class, 'show']);
    // Shows photo corresponding to photo id
    Route::get('fotos/{id}/{type?}', [PhotoController::class, 'showPhoto']);
    // Shows photo corresponding to profile with id
    Route::get('gebruikers/{id}/{type?}', [MemberController::class, 'showPhoto']);
});

// De GSV
Route::prefix('de-gsv')->group(function () {
    Route::get('/', [AboutController::class, 'showAbout']);

    Route::get('/pijlers', [AboutController::class, 'showPillars']);
    Route::get('/geschiedenis', [AboutController::class, 'showHistory']);

    Route::get('vertrouwenspersonen', [AboutController::class, 'showConfidants']);

    Route::get('commissies', [AboutController::class, 'showCommittees']);
    Route::get('commissies/{id}', [AboutController::class, 'showCommittee']);

    Route::get('senaten', [AboutController::class, 'showSenates']);
    Route::get('senaten/{senaat}', [AboutController::class, 'showSenate']);

    Route::get('contact', [AboutController::class, 'showContact']);
    // Route::get('oud-leden', 'AboutController@showFormerMembers');
});

// Register - disabled due to excess of spam
//Route::get('registreer', 'RegisterController@create');
//Route::post('registreer', 'RegisterController@store');

// Word lid
Route::prefix('word-lid')->group(function () {
    Route::get('/', [MemberController::class, 'index']);
    Route::get('/studie-en-vereniging', [MemberController::class, 'study']);
    // Corona Q&A
    Route::get('corona', [MemberController::class, 'showCorona']);
    Route::get('/veel-gestelde-vragen', [MemberController::class, 'faq']);
    Route::get('klachtencommissie', [MemberController::class, 'complaints']);
    Route::get('inschrijven', [MemberController::class, 'becomeMember']);
    Route::post('inschrijven', [MemberController::class, 'store']);
});

// Albums
Route::get('albums', [PhotoController::class, 'showAlbums']);
Route::get('albums/{slug}', [PhotoController::class, 'showPhotos']);

// Events
Route::get('activiteiten', [EventController::class, 'showIndex']);
Route::get('activiteiten/{year}/{month?}', [EventController::class, 'showMonth'])->middleware('checkDate');
Route::get('activiteiten/{year}/{month}/{slug}', [EventController::class, 'showEvent'])->middleware('checkDate');

Route::prefix('wachtwoord-vergeten')->group(function () {
    Route::get('herinner', [RemindersController::class, 'getEmail']);
    Route::post('herinner', [RemindersController::class, 'postEmail']);
    Route::get('reset/{token}', [RemindersController::class, 'getReset']);
    Route::post('reset', [RemindersController::class, 'postReset']);
});

Route::prefix('admin')->middleware('auth', 'has:member-or-reunist')->group(function () {
    Route::get('/', [Admin\AdminController::class, 'index']);
    Route::get('/me', [Admin\AdminController::class, 'redirectToMyProfile']);

    // events, albums/{photo}, files
    Route::resource('events', Admin\EventController::class);
    Route::resource('albums', Admin\AlbumController::class)->except('create');
    Route::resource('albums.photo', Admin\PhotoController::class)->except('index', 'create');
    Route::resource('files', Admin\FilesController::class);

    // Commissies
    Route::resource('commissies', Admin\CommitteeController::class)->except('create');

    // Hier nog een route voor ajax calls naar users db
    Route::resource('commissies/lidmaatschap', Admin\Committees\MembersController::class);

    // Users
    Route::prefix('gebruikers')->group(function () {
        Route::post('/{user}/activeren', [Admin\UsersController::class, 'activate']);
        Route::post('/{user}/accepteer-lid', [Admin\UsersController::class, 'accept']);
        Route::post('/{user}/profiel/create', [Admin\UsersController::class, 'storeProfile']);
        Route::put('/{user}/profiel', [Admin\UsersController::class, 'updateProfile']);
        Route::delete('/{user}/profiel', [Admin\UsersController::class, 'destroyProfile']);

        Route::get('/gasten', [Admin\UsersController::class, 'showGuests']);
        Route::get('/novieten', [Admin\UsersController::class, 'showPotentials']);
        Route::get('/leden', [Admin\UsersController::class, 'showMembers']);
        Route::get('/oud-leden', [Admin\UsersController::class, 'showFormerMembers']);
    });

    // Each part of the profile
    Route::get('leden/{user}/contact', [Admin\MemberController::class, 'editContactDetails']);
    Route::put('leden/{user}/contact', [Admin\MemberController::class, 'updateContactDetails']);
    Route::get('leden/{user}/email', [Admin\MemberController::class, 'editEmail']);
    Route::put('leden/{user}/email', [Admin\MemberController::class, 'updateEmail']);
    Route::get('leden/{user}/wachtwoord', [Admin\MemberController::class, 'editPassword']);
    Route::put('leden/{user}/wachtwoord', [Admin\MemberController::class, 'updatePassword']);
    Route::get('leden/{user}/geboortedatum', [Admin\MemberController::class, 'editBirthDay']);
    Route::put('leden/{user}/geboortedatum', [Admin\MemberController::class, 'updateBirthDay']);
    Route::get('leden/{user}/geslacht', [Admin\MemberController::class, 'editGender']);
    Route::put('leden/{user}/geslacht', [Admin\MemberController::class, 'updateGender']);
    Route::get('leden/{user}/jaarverband', [Admin\MemberController::class, 'editYearGroup']);
    Route::put('leden/{user}/jaarverband', [Admin\MemberController::class, 'updateYearGroup']);
    Route::get('leden/{user}/naam', [Admin\MemberController::class, 'editName']);
    Route::put('leden/{user}/naam', [Admin\MemberController::class, 'updateName']);
    Route::get('leden/{user}/gebruikersnaam', [Admin\MemberController::class, 'editUsername']);
    Route::put('leden/{user}/gebruikersnaam', [Admin\MemberController::class, 'updateUsername']);
    Route::get('leden/{user}/werk', [Admin\MemberController::class, 'editBusiness']);
    Route::put('leden/{user}/werk', [Admin\MemberController::class, 'updateBusiness']);
    Route::get('leden/{user}/foto', [Admin\MemberController::class, 'editPhoto']);
    Route::put('leden/{user}/foto', [Admin\MemberController::class, 'updatePhoto']);
    Route::get('leden/{user}/ouders', [Admin\MemberController::class, 'editParentContactDetails']);
    Route::put('leden/{user}/ouders', [Admin\MemberController::class, 'updateParentContactDetails']);
    Route::get('leden/{user}/studie', [Admin\MemberController::class, 'editStudy']);
    Route::put('leden/{user}/studie', [Admin\MemberController::class, 'updateStudy']);
    Route::get('leden/{user}/regio', [Admin\MemberController::class, 'editRegion']);
    Route::put('leden/{user}/regio', [Admin\MemberController::class, 'updateRegion']);
    Route::get('leden/{user}/tijd-van-lidmaatschap', [Admin\MemberController::class, 'editMembershipPeriod']);
    Route::put('leden/{user}/tijd-van-lidmaatschap', [Admin\MemberController::class, 'updateMembershipPeriod']);
    Route::get('leden/{user}/in-leven', [Admin\MemberController::class, 'editAlive']);
    Route::put('leden/{user}/in-leven', [Admin\MemberController::class, 'updateAlive']);
    Route::get('leden/{user}/sic-ontvangen', [Admin\MemberController::class, 'editNewspaper']);
    Route::put('leden/{user}/sic-ontvangen', [Admin\MemberController::class, 'updateNewspaper']);

    // Some actions (post requests therefore)
    Route::get('leden/{user}/lidmaatschap', [Admin\MemberController::class, 'editMembershipStatus']);
    Route::post('leden/{user}/lidmaatschap/maak-reunist', [Admin\MemberController::class, 'makeReunist']);
    Route::post('leden/{user}/lidmaatschap/maak-oud-lid', [Admin\MemberController::class, 'makeExMember']);
    Route::post('leden/{user}/lidmaatschap/maak-lid', [Admin\MemberController::class, 'makeMember']);

    // Deleting user data according to GDPR rules
    Route::get('leden/{user}/forget', [Admin\MemberController::class, 'setForget']);
    Route::post('leden/{user}/forget', [Admin\MemberController::class, 'forget']);

    Route::get('leden/oudleden.csv', [Admin\UsersController::class, 'exportFormerMembers']);
    Route::get('leden/leden.csv', [Admin\UsersController::class, 'exportMembers']);
    Route::get('leden/sic-ontvangers.csv', [Admin\MemberController::class, 'exportNewspaperRecipients']);
    Route::get('leden/updates', [Admin\MemberController::class, 'latestUpdates']);

    Route::resource('gebruikers', Admin\UsersController::class);
    Route::resource('gebruikers.family', Admin\FamilyController::class);

    // Senaten
    Route::resource('senaten', Admin\SenateController::class);
    // Hier nog een route voor ajax calls naar users db
    Route::post('senaten/{senate}/members', [Admin\Senates\MembersController::class, 'store']);
    Route::delete('senaten/{senate}/members/{member}', [Admin\Senates\MembersController::class, 'destroy']);

    // Extension
    Route::get('extension', [Admin\ExtensionController::class, 'index']);
    Route::post('extension', [Admin\ExtensionController::class, 'store']);
});

// Forum
Route::prefix('forum')->middleware('auth', 'approved')->group(function () {
    Route::get('stats', [ForumThreadsController::class, 'statistics']);

    Route::get('prullenbak', [ForumThreadsController::class, 'getTrashed']);

    // Edit routes
    Route::get('bewerk-onderwerp/{threadId}', [ForumThreadsController::class, 'getEditThread']);
    Route::post('bewerk-onderwerp/{threadId}', [ForumThreadsController::class, 'postEditThread']);
    Route::get('bewerk-reactie/{replyId}', [ForumRepliesController::class, 'getEditReply']);
    Route::post('bewerk-reactie/{replyId}', [ForumRepliesController::class, 'postEditReply']);

    // Delete routes
    Route::get('verwijder-reactie/{replyId}', [ForumRepliesController::class, 'getDelete']);
    Route::delete('verwijder-reactie/{replyId}', [ForumRepliesController::class, 'postDelete']);
    Route::get('verwijder-onderwerp/{threadId}', [ForumThreadsController::class, 'getDelete']);
    Route::delete('verwijder-onderwerp/{threadId}', [ForumThreadsController::class, 'postDelete']);

    // Create routes
    Route::get('nieuw-onderwerp', [ForumThreadsController::class, 'getCreateThread']);
    Route::post('nieuw-onderwerp', [ForumThreadsController::class, 'postCreateThread']);
    Route::post('{slug}', [ForumRepliesController::class, 'postCreateReply']);

    // Quotes
    Route::get('threads/quote/{threadId}', [ForumApiController::class, 'quoteThread']);
    Route::get('quote/{replyId}', [ForumApiController::class, 'quoteReply']);

    // Likes
    Route::post('replies/{id}/like', [ForumApiController::class, 'likeReply']);
    Route::delete('replies/{id}/like', [ForumApiController::class, 'dislikeReply']);
    Route::post('threads/{id}/like', [ForumApiController::class, 'likeThread']);
    Route::delete('threads/{id}/like', [ForumApiController::class, 'dislikeThread']);
});

Route::get('preview', [ForumApiController::class, 'preview'])->middleware('auth');

Route::prefix('api')->middleware('auth', 'approved', 'has:member-or-reunist')->group(function () {
    Route::get('search/members', [ApiController::class, 'members']);
});

// Forum index, search, show comment, show thread
Route::get('forum', [ForumThreadsController::class, 'getIndex']);
Route::get('forum/zoek', [ForumThreadsController::class, 'getSearch']);
Route::get('forum/{slug}', [ForumThreadsController::class, 'getShowThread']);

// Malfonds
Route::get('admin/leden/{id}/invite', [Malfonds\InvitationController::class, 'create']);
Route::post('admin/leden/{id}/invite', [Malfonds\InvitationController::class, 'store']);
Route::post('admin/leden/{id}/invite-via-mail', [Malfonds\InvitationController::class, 'inviteByMail']);

Route::prefix('api')->middleware('cors')->group(function () {
    Route::middleware('loginViaToken', 'tokenAuth')->group(function () {
        Route::get('me', [Malfonds\MemberController::class, 'me']);

        Route::resource('members', Malfonds\MemberController::class);
        Route::resource('yeargroups', Malfonds\YearGroupController::class);
        Route::get('members/{id}/familie', [Malfonds\MemberController::class, 'family']);

        Route::get('members/{id}/history', [Malfonds\MemberHistoryController::class, 'show']);

        Route::put('members/{id}/naam', [Malfonds\MemberController::class, 'updateName']);
        Route::put('members/{id}/email', [Malfonds\MemberController::class, 'updateEmail']);
        Route::put('members/{id}/adres', [Malfonds\MemberController::class, 'updateAddress']);
        Route::put('members/{id}/jaarverband', [Malfonds\MemberController::class, 'updateYearGroup']);
        Route::put('members/{id}/geslacht', [Malfonds\MemberController::class, 'updateGender']);
        Route::put('members/{id}/wachtwoord', [Malfonds\MemberController::class, 'updatePassword']);

        // Verifications
        Route::post('members/{id}/naam/verifieer', [Malfonds\MemberController::class, 'verifyName']);
        Route::post('members/{id}/email/verifieer', [Malfonds\MemberController::class, 'verifyEmail']);
        Route::post('members/{id}/jaarverband/verifieer', [Malfonds\MemberController::class, 'verifyYearGroup']);
        Route::post('members/{id}/geslacht/verifieer', [Malfonds\MemberController::class, 'verifyGender']);
        Route::post('members/{id}/familie/verifieer', [Malfonds\MemberController::class, 'verifyFamily']);

        // Invites
        Route::post('members/{id}/invite', [Malfonds\MemberController::class, 'invite']);
        Route::put('members/{id}/invite', [Malfonds\MemberController::class, 'requestInvite']);
    });

    Route::post('login', [Malfonds\SessionController::class, 'login']);
});

Route::prefix('api')->middleware('cors')->group(function () {
    // Shop extension
    Route::get('shops', [ExtensionApiController::class, 'show']);

    // API for GSVGroningen.nl
    Route::get('events', [ApiController::class, 'events']);
});

// Iframes
Route::prefix('iframe')->group(function () {
    Route::get('inschrijven', [MemberController::class, 'becomeMemberIFrame']);
});
