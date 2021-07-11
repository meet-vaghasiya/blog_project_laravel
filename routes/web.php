<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserCommentController;

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

// Route::get('/test-redirect', function () {
//     return view('welcome');
// })->name('test.redirect');

// Route::get('/', function () {
//     return view('layouts.app');
// })->name('home.index');


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create'); //keep this route above show route,otherwise it wil get error
Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/post/{post}/update', [PostController::class, 'update'])->name('posts.update');
Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');
Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/post/tag/{id}', [PostTagController::class, 'index'])->name('posts.tag.index');

Route::post('/post/{post}/commetns', [PostCommentController::class, 'addComment'])->name('post.comment.store');

Route::get('/secrate', [HomeController::class, 'secrate'])->name('secrate')->middleware('can:home.contact');

Route::get('/practise/hasMany', [PostController::class, 'hasMany'])->name('posts.hasmany');
Route::get('/practise/many-to-many', [PostController::class, 'manyToMany'])->name('posts.hasmany');

Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);
Route::resource('users.comments', UserCommentController::class)->only(['store']);
// Route::get('/contact', function () {
//     return 'contact page';
//     // return view('welcome');
// })->name('contact.index');


// Route::get('/about-us', function () {
//     return 'about us page';
//     // return view('welcome');
// })->name('about_us.index');


// Route::get('/posts/1', function () {
//     return  'post 1';
// });


// Route::get('/posts/2', function () {
//     return  'post 2';
// });


// Route::get('/posts/{id}', function ($id) {
//     return  'post no:' . $id;
// });



// Route::get('/posts/{id}', function ($idd) {
//     return  'post no:' . $idd;
// });



// Route::get('/posts/{id}/{no}', function ($id, $no) {
//     return  'post no:' . $id . $no;
// });  //it's compalsary parameter, we can pass  any argument name in function of route


// //optoinal parament
// Route::get('/optional/{no?}', function ($id = 20) {
//     return  'post no:' . $id;
// });  //provide default argument,otherwise it will give error


// Route::get('/where/{id}', function ($id = 20) {
//     return  'whre condition:' . $id;
// })->where([
//     'id' => '[0-9]+'
// ]);


// Route::get('/route-service-provider-constrained/{number}', function ($id = 20) {
//     return  'route-service-provider-constrained' . $id;
// });


// Route::get('section-9', function () {
//     return  '<h1 style="color:red">hello world</h1>';
// });

// Route::get('section-9', function () {
//     return  '<h1 style="color:red">hello world</h1>';
// });
// Route::get('section-9', function () {
//     return  view('section-9');  //don't use blade php syntact
// });
// Route::get('section-9', function () {
//     return  '<h1 style="color:red">hello world</h1>';
// });


// Route::view('/direct-view', 'about-us');

// Route::get('about-us', function () {

//     return view('about-us');
// });
// Route::get('contact/{id}', function ($id) {

//     $posts = [
//         1 => ['title' => 'contact page1', 'content' => 'This is contect page from dynamic'],
//         2 => ['title' => 'about-us page', 'content' => 'This is about  us page']
//     ];

//     abort_if(!isset($posts[$id]), 404);  // if we not find this page than it will return nice 404 error page in laravel

//     // return view('contact', ['posts' => $posts[$id]]);
//     return view('contact', compact('posts'));
// });
// //if id is not number than give 404 error


// Route::get('conditional-rendering', function () {


//     return view('conditonal-rendering');
// })->middleware('test:first,second');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
