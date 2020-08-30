<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function () {

    Route::resource('admin/users', 'Admin\AdminUserController');
    Route::resource('admin/posts', 'Admin\AdminPostController');
    Route::resource('admin/categories', 'Admin\AdminCategoryController');
    Route::resource('admin/photos', 'Admin\AdminPhotoController');
    Route::get('admin/dashboard', 'Admin\AdminDashboardController@index')->name('dashboard.index');

    Route::resource('admin/comments', 'Admin\CommentController');
    Route::post('admin/comments/actions/{id}', 'Admin\CommentController@actions')->name('comments.actions');
});

Route::get('/', 'Frontend\MainController@index');
Route::get('posts/{slug}', 'Frontend\PostController@show')->name('frontend.post.show');
Route::get('search', 'Frontend\PostController@search_title')->name('frontend.post.search');

Route::post('comments/{postId}', 'Frontend\CommentController@store')->name('frontend.comments.store');
Route::post('comments}', 'Frontend\CommentController@reply')->name('frontend.comments.reply');
