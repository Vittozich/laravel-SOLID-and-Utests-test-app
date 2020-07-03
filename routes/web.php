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

Route::get('/', function () {
    return view('welcome');
});


Route::get('feedback', ['as' => 'feedback', 'uses' => 'Tests\BrowserTestController@feedback']);


Route::resource('books','Tests\BooksController' );
//
//Route::get('books', ['as' => 'books', 'uses' => 'Tests\BooksController@index']);
//Route::post('books', ['as' => 'books.store', 'uses' => 'Tests\BooksController@store']);
//Route::put('books/{book}', ['as' => 'books.update', 'uses' => 'Tests\BooksController@update']);
//Route::delete('books/{book}', ['as' => 'books.destroy', 'uses' => 'Tests\BooksController@destroy']);
