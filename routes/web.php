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
    return view('index');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/category/index',[\App\Http\Controllers\CategoryController::class,'index']);   //вывод таблицы категорий
Route::get('/category/create',[\App\Http\Controllers\CategoryController::class , 'create'])->name('CreateCategory'); // создание категории
Route::post('/category/create',[\App\Http\Controllers\CategoryController::class , 'store']); // сохранение категории
Route::get('/category/{category}/update',[\App\Http\Controllers\CategoryController::class , 'edit']); // редактирование категории
Route::post('/category/{category}/update',[\App\Http\Controllers\CategoryController::class , 'update']); // сохранение отредактированной категории
Route::get('/category/{category}/delete',[\App\Http\Controllers\CategoryController::class , 'destroy']); //  удаление категории

Route::get('/tag/index',[\App\Http\Controllers\TagController::class,'index']);   //вывод таблицы тегов
Route::get('/tag/create',[\App\Http\Controllers\TagController::class , 'create']); // создание тега
Route::post('/tag/create',[\App\Http\Controllers\TagController::class , 'store']); // сохранение тега
Route::get('/tag/{tag}/update',[\App\Http\Controllers\TagController::class , 'edit']); // редактирование тега
Route::post('/tag/{tag}/update',[\App\Http\Controllers\TagController::class , 'update']); // сохранение отредактированного тега
Route::get('/tag/{tag}/delete',[\App\Http\Controllers\TagController::class , 'destroy']); //  удаление тега

Route::get('/user',[\App\Http\Controllers\UserController::class,'index']);   //вывод таблицы юзеров
Route::get('/user/create',[\App\Http\Controllers\UserController::class , 'create']); // создание юзера
Route::post('/user/create',[\App\Http\Controllers\UserController::class , 'store']); // сохранение юзера
Route::get('/user/{tag}/update',[\App\Http\Controllers\UserController::class , 'edit']); // редактирование юзера
Route::post('/user/{tag}/update',[\App\Http\Controllers\UserController::class , 'update']); // сохранение отредактированного юзера
Route::get('/user/{tag}/delete',[\App\Http\Controllers\UserController::class , 'destroy']); //  удаление юзера

Route::get('/user/{user}/category/{category}/tag/{tag}',[\App\Http\Controllers\PostController::class , 'searchResult'])->name('findPosts');
Route::get('/post/index',[\App\Http\Controllers\PostController::class , 'index']);   //вывод постов
Route::get('/post/tag/{id}',[\App\Http\Controllers\PostController::class , 'posts_tag']);//ввывод постов по тегу
Route::get('/post/category/{id}',[\App\Http\Controllers\PostController::class , 'posts_category'])->where('id', '[0-9]+'); //вывод постов по категории
Route::get('/post/user/{id}',[\App\Http\Controllers\PostController::class , 'post_user']); //вывод постов по юзеру
Route::get('/post/create',[\App\Http\Controllers\PostController::class , 'create']);//создание нового поста
Route::post('/post/create',[\App\Http\Controllers\PostController::class , 'store']);//сохранение поста после добавления
Route::get('/post/{post}/edit',[\App\Http\Controllers\PostController::class , 'edit']);//передача поста на редактирование
Route::post('/post/{post}/edit',[\App\Http\Controllers\PostController::class , 'update']);// редактирование поста
Route::get('/post/{post}/delete',[\App\Http\Controllers\PostController::class , 'destroy']); //  удаление поста из таблицы


