<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$domain = implode('.', array_slice(explode('.', explode(':', request()->server('HTTP_HOST'))[0]), -2));

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------|
*/

Route::domain('rivex.online')->group(function () {
    Route::view('/', 'home.index');
});

/*
|--------------------------------------------------------------------------
| Shop
|--------------------------------------------------------------------------|
*/

Route::domain("shop.$domain")->group(function () {
    Route::name('shop.index')->get('/', 'Shop\IndexController@index');
    Route::name('shop.order')->post('order', 'Shop\IndexController@pay');
    Route::name('shop.sum')->post('sum', 'Shop\IndexController@sum');
    Route::name('shop.list')->get('list', 'Shop\IndexController@list');
    Route::view('conditions', 'shop.conditions')->name('shop.conditions');
    Route::view('privacy', 'shop.privacy')->name('shop.privacy');
    Route::name('shop.result')->get('/unitpay/result', 'Shop\UnitPayController@payOrderFromGate');
});

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------|
*/

// Home
Route::name('home')->get('/', 'Front\PostController@index');


// Contact
Route::resource('contacts', 'Front\ContactController', ['only' => ['create', 'store']]);

// Posts and comments
Route::prefix('posts')->namespace('Front')->group(function () {
    Route::name('posts.display')->get('{slug}', 'PostController@show');
    Route::name('posts.tag')->get('tag/{tag}', 'PostController@tag');
    Route::name('posts.search')->get('', 'PostController@search');
    Route::name('posts.comments.store')->post('{post}/comments', 'CommentController@store');
    Route::name('posts.comments.comments.store')->post('{post}/comments/{comment}/comments', 'CommentController@store');
    Route::name('posts.comments')->get('{post}/comments/{page}', 'CommentController@comments');
});

Route::resource('comments', 'Front\CommentController', [
    'only' => ['update', 'destroy'],
    'names' => ['destroy' => 'front.comments.destroy']
]);

Route::name('category')->get('category/{category}', 'Front\PostController@category');


// Authentification
Auth::routes();

Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------|
*/

Route::prefix('admin')->namespace('Back')->group(function () {

    Route::middleware('redac')->group(function () {

        Route::name('admin')->get('/', 'AdminController@index');


        // Posts
        Route::name('posts.seen')->put('posts/seen/{post}', 'PostController@updateSeen')->middleware('can:manage,post');
        Route::name('posts.active')->put('posts/active/{post}/{status?}', 'PostController@updateActive')->middleware('can:manage,post');
        Route::resource('posts', 'PostController');

        // Notifications
        Route::name('notifications.index')->get('notifications/{user}', 'NotificationController@index');
        Route::name('notifications.update')->put('notifications/{notification}', 'NotificationController@update');

        // Bugs and improvements
        Route::name('bugs.seen')->put('bugs/seen/{bug}', 'BugController@updateSeen');
        Route::name('bugs.active')->put('bugs/active/{bug}/{status?}', 'BugController@updateActive');
        Route::resource('bugs', 'BugController');
        Route::name('bugcomments.store')->post('bugcomments/{bug}', 'BugCommentController@store');

        // Violations
        Route::name('violations.seen')->put('violations/seen/{violation}', 'ViolationController@updateSeen');
        Route::name('violations.active')->put('Violations/active/{violation}/{status?}', 'ViolationController@updateActive');
        Route::resource('violations', 'ViolationController');

        // Laws
        Route::resource('laws', 'LawController');

        // Scores
        Route::resource('scores', 'ScoreController');

        // Medias
        Route::view('medias', 'back.medias')->name('medias.index');
    });

    Route::middleware('admin')->group(function () {

        // Users
        Route::name('users.seen')->put('users/seen/{user}', 'UserController@updateSeen');
        Route::name('users.valid')->put('users/valid/{user}', 'UserController@updateValid');
        Route::resource('users', 'UserController', ['only' => [
            'index', 'edit', 'update', 'destroy'
        ]]);

        // Categories
        Route::resource('categories', 'CategoryController', ['except' => 'show']);

        // Contacts
        Route::name('contacts.seen')->put('contacts/seen/{contact}', 'ContactController@updateSeen');
        Route::resource('contacts', 'ContactController', ['only' => [
            'index', 'destroy'
        ]]);

        // Comments
        Route::name('comments.seen')->put('comments/seen/{comment}', 'CommentController@updateSeen');
        Route::resource('comments', 'CommentController', ['only' => [
            'index', 'destroy'
        ]]);

        // Settings
        Route::name('settings.edit')->get('settings', 'AdminController@settingsEdit');
        Route::name('settings.update')->put('settings', 'AdminController@settingsUpdate');

    });

});
