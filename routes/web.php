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

Route::get('/', 'ArticleController@index');

Route::get('/articles','ArticleController@index');

Route::get('/articles/detail',function(){
    echo "article details";
})->name('articles.detail');

Route::get('/articles/detail/{id}','ArticleController@detail');
Route::get('/articles/add','ArticleController@add');
Route::post('/articles/add','ArticleController@create');
Route::get('/articles/delete/{id}','ArticleController@delete');
Route::get('/articles/more',function(){
    return redirect()->route('articles.detail');
});


Route::post('/articles/detail/{article_id}/comments/add','CommentController@create');
Route::get('/articles/detail/{aritcle_id}/comments/delete/{comment_id}','CommentController@delete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
