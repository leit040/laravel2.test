<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\RedirectResponse;
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
Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'loginHandle']);

});
Route::resource('user', UserController::class);
Route::middleware('auth')->group(function () {
    Route::get('auth/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);

    Route::get('/user/{user}/category/{category}/tags/{tags}', [\App\Http\Controllers\PostController::class, 'searchResult'])->name('findPosts');
    Route::post('/post/search', function () {

        $data = request()->all();
        $validator = validator()->make($data, [
            'category_id' => ['required', 'exists:categories,id'],
            'tags_id' => ['required'],
            'user_id' => ['required', 'exists:users,id']


        ]);
        $error = $validator->errors();
        if (count($error) > 0) {
            $_SESSION['errors'] = $error->toArray();
            $_SESSION['data'] = $data;
            return new RedirectResponse($_SERVER['HTTP_REFERER']);

        }
        return new RedirectResponse("/user/" . $data['user_id'] . "/category/" . $data['category_id'] . "/tags/" . implode("#", $data['tags_id']));

    });
    Route::prefix('post')->group(function () {
        Route::get('/index', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');   //вывод постов
        Route::get('/search', [\App\Http\Controllers\PostController::class, 'search'])->name('post.search');   //вывод постов
        Route::get('/tag/{id}', [\App\Http\Controllers\PostController::class, 'posts_tag'])->name('post.tag');//ввывод постов по тегу
        Route::get('/category/{id}', [\App\Http\Controllers\PostController::class, 'posts_category'])->where('id', '[0-9]+')->name('post.category'); //вывод постов по категории
        Route::get('/user/{id}', [\App\Http\Controllers\PostController::class, 'post_user'])->name('post.user'); //вывод постов по юзеру
        Route::get('/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');//создание нового поста
        Route::post('/create', [\App\Http\Controllers\PostController::class, 'store']);//сохранение поста после добавления
        Route::get('/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit']);//передача поста на редактирование
        Route::post('/{post}/edit', [\App\Http\Controllers\PostController::class, 'update']);// редактирование поста
        Route::get('/{post}/delete', [\App\Http\Controllers\PostController::class, 'destroy']); //  удаление поста из таблицы


    });

});


Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/index', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');   //вывод постов

Route::fallback(function () {
    return view('index');

});
