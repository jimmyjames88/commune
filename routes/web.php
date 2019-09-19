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

Route::get('/', function () {
    return view('marketing.index');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/tweets', function(){
    $limit = $_GET['limit'];
    $posts = \App\Post::with(['user'])->limit($limit)->get();
    return $posts;
})->middleware(['cors']);

// Route::get('/tweets-api', function(){
//     $tweets = \App\Tweet::with(['user'])->limit(20)->get();
//     return $tweets;
// })->middleware(['cors']);

Route::get('marketing', function() {
    return view('marketing.index');
});

Route::middleware(['auth'])->group(function() {

    Route::get('/home', function(){
        return redirect(route('home'));
    });



    Route::get('/posts', 'PostController@index')->name('home');
    Route::get('/posts/create', 'PostController@create');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::post('/posts', 'PostController@store');
    // Route::get('/likes/{like_id}/{like_type}', 'LikeController@handleLike');
    Route::post('/posts/{post}/like', 'PostController@like');
    Route::post('/posts/{post}/unlike', 'PostController@unlike');
    Route::get('/posts/{post}', 'PostController@show');
    Route::put('/posts/{post}', 'PostController@update');

    Route::get('/posts/{post}/delete', 'PostController@delete');
    Route::delete('/posts/{post}', 'PostController@destroy');

    Route::post('/posts/{post}/comments', 'CommentController@store');
    Route::put('/posts/{post}/comments/{comment}', 'CommentController@update');
    Route::get('/posts/{post}/comments/{comment}/edit', 'CommentController@edit');
    Route::get('/posts/{post}/comments/{comment}/like', 'CommentController@like');
    Route::get('/posts/{post}/comments/{comment}/delete', 'CommentController@delete');
    Route::delete('/posts/{post}/comments/{comment}', 'CommentController@destroy');

    Route::resource('conversations', 'ConversationController');
    Route::post('/conversations/{conversation}/messages', 'MessageController@store');
    Route::put('/conversations/{conversation}/invite', 'ConversationController@invite');
    Route::get('/conversations/create/{user}', 'ConversationController@create');

    Route::resource('/profiles', 'ProfileController');

    // redirect to own profile if no ID passed
    Route::get('/profiles', function() {
        return redirect('/profiles/' . Auth::id());
    });

    Route::get('/profiles/{profile}/followers', 'ProfileController@followers');
    Route::get('/profiles/{profile}/following', 'ProfileController@following');
    Route::get('/profiles/{profile}/follow', 'ProfileController@follow');
    Route::get('/profiles/{profile}/unfollow', 'ProfileController@unfollow');
    Route::get('/profiles/{profile}/edit', 'ProfileController@edit');
    Route::put('/profiles/{profile}', 'ProfileController@update');

    // who to follow one-off -- if adding more standalone pages, consider a PageController
    Route::get('/who-to-follow', 'ProfileController@suggest');

    Route::get('/pusher', function() {
        return view('pusher.test');
    });
});
