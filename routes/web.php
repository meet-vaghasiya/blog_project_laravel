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

Route::get('/', function () {
    return 'second route';
    return view('welcome');
});

Route::get('/contact', function () {
    return 'contact page';
    // return view('welcome');
})->name('contact.index');


Route::get('/about-us', function () {
    return 'about us page';
    // return view('welcome');
})->name('about_us.index');


Route::get('/posts/1', function () {
    return  'post 1';
});


Route::get('/posts/2', function () {
    return  'post 2';
});


Route::get('/posts/{id}', function ($id) {
    return  'post no:' . $id;
});



Route::get('/posts/{id}', function ($idd) {
    return  'post no:' . $idd;
});



Route::get('/posts/{id}/{no}', function ($id, $no) {
    return  'post no:' . $id . $no;
});  //it's compalsary parameter, we can pass  any argument name in function of route


//optoinal parament
Route::get('/optional/{no?}', function ($id = 20) {
    return  'post no:' . $id;
});  //provide default argument,otherwise it will give error


Route::get('/where/{id}', function ($id = 20) {
    return  'whre condition:' . $id;
})->where([
    'id' => '[0-9]+'
]);


Route::get('/route-service-provider-constrained/{number}', function ($id = 20) {
    return  'route-service-provider-constrained' . $id;
});

//if id is not number than give 404 error
