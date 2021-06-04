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

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/img', [App\Http\Controllers\ImageController::class, 'index'])->name('img');
Route::post('/img/store', [App\Http\Controllers\ImageController::class, 'store'])->name('img/store');
Route::get('/img/test', [App\Http\Controllers\ImageController::class, 'test'])->name('img/test');

Route::get('/aimg', [App\Http\Controllers\AimageController::class, 'create'])->name('aimg.home');

Route::post('/aimg', [App\Http\Controllers\AimageController::class, 'store']);

// use App\Models\Aimage;
//*/
Route::get('/aimg/{image}', [App\Http\Controllers\AimageController::class, 'show'])->name('aimg.show');


/*/

Route::get('/aimg/{aimg}', function (Aimage $aimg) {
    return $aimg;
    // return view('modvisor');
});
//*/

use App\Http\Controllers\PostsController;
Route::get('posts/{slug}', [PostsController::class, 'show']);
// Route::get('posts/{post}', function ($post) {
//     $posts = [
//         'first' => 'Hello, this is my first blog post!',
//         'second' => 'Now I am getting the hang of this blogging thing.'
//     ];

//     if(!array_key_exists($post, $posts)) abort(404, 'Sorry, that post was not found!');
//     // $name = request('name');
//     // dd($name);
//     return view('post',[
//         'post' => $posts[$post] ?? 'Nothing here yet.'
//     ]);
// });

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});
