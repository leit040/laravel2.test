<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
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
    return view('index');
});
Route::get('/welcome', function () {
    return view('welcome');
});
/*Route::prefix('category')->group(function(){
    Route::get('/index',[\App\Http\Controllers\CategoryController::class,'index']);   //вывод таблицы категорий
    Route::get('/create',[\App\Http\Controllers\CategoryController::class , 'create'])->name('CreateCategory'); // создание категории
    Route::post('/create',[\App\Http\Controllers\CategoryController::class , 'store']); // сохранение категории
    Route::get('/{category}/update',[\App\Http\Controllers\CategoryController::class , 'edit']); // редактирование категории
    Route::post('/{category}/update',[\App\Http\Controllers\CategoryController::class , 'update']); // сохранение отредактированной категории
    Route::get('/{category}/delete',[\App\Http\Controllers\CategoryController::class , 'destroy']); //  удаление категории


});*/
Route::resource('category',CategoryController::class);

Route::prefix('tag')->group(function(){

    Route::get('/index',[\App\Http\Controllers\TagController::class,'index']);   //вывод таблицы тегов
    Route::get('/create',[\App\Http\Controllers\TagController::class , 'create']); // создание тега
    Route::post('/create',[\App\Http\Controllers\TagController::class , 'store']); // сохранение тега
    Route::get('/{tag}/update',[\App\Http\Controllers\TagController::class , 'edit']); // редактирование тега
    Route::post('/{tag}/update',[\App\Http\Controllers\TagController::class , 'update']); // сохранение отредактированного тега
    Route::get('/{tag}/delete',[\App\Http\Controllers\TagController::class , 'destroy']); //  удаление тега

});

Route::prefix('user')->group(function(){

    Route::get('/index',[\App\Http\Controllers\UserController::class,'index']);   //вывод таблицы юзеров
    Route::get('/create',[\App\Http\Controllers\UserController::class , 'create']); // создание юзера
    Route::post('/create',[\App\Http\Controllers\UserController::class , 'store']); // сохранение юзера
    Route::get('/{tag}/update',[\App\Http\Controllers\UserController::class , 'edit']); // редактирование юзера
    Route::post('/{tag}/update',[\App\Http\Controllers\UserController::class , 'update']); // сохранение отредактированного юзера
    Route::get('/{tag}/delete',[\App\Http\Controllers\UserController::class , 'destroy']); //  удаление юзера

});

Route::get('/user/{user}/category/{category}/tag/{tag}',[\App\Http\Controllers\PostController::class , 'searchResult'])->name('findPosts');

Route::prefix('post')->group(function (){
    Route::get('/index',[\App\Http\Controllers\PostController::class , 'index']);   //вывод постов
    Route::get('/tag/{id}',[\App\Http\Controllers\PostController::class , 'posts_tag']);//ввывод постов по тегу
    Route::get('/category/{id}',[\App\Http\Controllers\PostController::class , 'posts_category'])->where('id', '[0-9]+'); //вывод постов по категории
    Route::get('/user/{id}',[\App\Http\Controllers\PostController::class , 'post_user']); //вывод постов по юзеру
    Route::get('/create',[\App\Http\Controllers\PostController::class , 'create']);//создание нового поста
    Route::post('/create',[\App\Http\Controllers\PostController::class , 'store']);//сохранение поста после добавления
    Route::get('/{post}/edit',[\App\Http\Controllers\PostController::class , 'edit']);//передача поста на редактирование
    Route::post('/{post}/edit',[\App\Http\Controllers\PostController::class , 'update']);// редактирование поста
    Route::get('/{post}/delete',[\App\Http\Controllers\PostController::class , 'destroy']); //  удаление поста из таблицы


});


Route::fallback(function (){
    return view('index');

});
