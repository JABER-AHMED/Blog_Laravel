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
use App\User;
use App\Post;
use Illuminate\Support\Facades\Input;

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('contact', 'PagesController@getContact');
    Route::get('/profile', 'UserController@profile');
    Route::post('/profile', 'UserController@update_avatar');
    Route::post('contact', 'PagesController@postContact');

    //post route
      Route::resource('posts', 'PostController');



    //blog route
    Route::get('/blog', 'BlogController@getIndex');
    Route::get('blog/{slug}', 'BlogController@getSingle')->name('blog.single');

    //category route

    Route::resource('categories', 'CategoryController', ['except' => ['create']]);

    //tag route

	Route::resource('tags', 'TagController', ['except' => ['create']]);

	//Comments

	Route::post('comments/{post_id}', 'CommentsController@store')->name('comments.store');
	Route::get('comments/{id}/edit', 'CommentsController@edit')->name('comments.edit');
	Route::put('comments/{id}', 'CommentsController@update')->name('comments.update');
	Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
	Route::get('comments/{id}/delete', 'CommentsController@delete')->name('comments.delete');

    // search functionality

    Route::any ( '/search', function () {
    $q = Input::get ( 'q' );
    $user = User::where ( 'firstname', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $user ) > 0)
        return view ( 'searchitem' )->withDetails ( $user )->withQuery ( $q );
    else
        return view ( 'searchitem' )->withMessage ( 'No Details found. Try to search again !' );
    });

    //Like route

    Route::post('/like',[

        'uses' => 'LikeController@postLikePost',
        'as'   => 'like'
        ]);
});


Route::get('/about', 'PagesController@getAbout');
Route::get('/home', 'PagesController@getIndex')->name('home');

//Authentication Routes

Route::get('auth/login', 'LoginController@getLogin')->name('login');
Route::post('auth/login/user', 'LoginController@postLogin')->name('auth.login');
Route::post('auth/logout', 'LoginController@logout')->name('logout');

//Registration Routes
Route::get('auth/register', 'RegisterController@getRegister')->name('register');
Route::post('auth/register/user', 'RegisterController@register')->name('user.register');

// password reset routes
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/email', 'Auth\ResetPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@getReset');

// Categories Routes


// Auth::routes();
/*
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'PagesController@getIndex')->name('home');*/
