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

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::resource('users', 'Admin\AdminUserController');
    Route::resource('posts', 'Admin\AdminPostController');
    Route::resource('categories', 'Admin\AdminCategoryController');
    Route::resource('photos', 'Admin\AdminPhotoController');
    Route::resource('visits', 'Admin\AdminVisitController');
    Route::get('dashboard', 'Admin\AdminDashboardController@index')->name('dashboard.index');

    Route::resource('comments', 'Admin\CommentController');
    Route::post('comments/actions/{id}', 'Admin\CommentController@actions')->name('comments.actions');

    Route::delete('delete/media', 'Admin\AdminPhotoController@mass_deletion')->name('photo.mass_deletion');
});

Route::middleware(['LogVisits'])->group(function () {

    Auth::routes();

    Route::get('/', 'Frontend\MainController@index')->name('home');
    Route::get('posts/{slug}', 'Frontend\PostController@show')->name('frontend.post.show');
    Route::get('search', 'Frontend\PostController@search_title')->name('frontend.post.search');
    Route::get('category/{slug}', 'Frontend\PostController@category')->name('frontend.post.category');

    Route::middleware(['auth'])->group(function () {
        Route::post('comments/{postId}', 'Frontend\CommentController@store')->name('frontend.comments.store');
        Route::post('comments}', 'Frontend\CommentController@reply')->name('frontend.comments.reply');
    });

    Route::middleware(['NormalUser'])->group(function () {
        Route::get('user/{id}', 'Frontend\UserPanelController@index')->name('frontend.user.index');
        Route::patch('user/{id}', 'Frontend\UserPanelController@update')->name('frontend.user.update');
    });

});
