<?php

use Illuminate\Support\Facades\Route;

//admin
use App\Http\Controllers\admin\AdminController;

use App\Http\Controllers\admin\CategoryController;

use App\Http\Controllers\admin\GenreController;

use App\Http\Controllers\admin\MovieController;

use App\Http\Controllers\admin\RoomController;

use App\Http\Controllers\admin\ShowtimeController;

use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\client\CheckoutController;

use App\Http\Controllers\admin\OrderController;

//client 
use App\Http\Controllers\client\ClientController;

use App\Http\Controllers\client\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin') -> middleware('admin.auth') -> name('admin.')-> group(function(){

    // home
    Route::get('/',[AdminController::class,'index']) -> name('index');
    
    //category
    Route::get('cate',[CategoryController::class,'index']) -> name('cate');

    Route::get('addCategory',[CategoryController::class,'add']) -> name('addCategory');

    Route::post('addCategory',[CategoryController::class,'addPost']);

    Route::get('deleteCate/{id}',[CategoryController::class,'delete']) -> name('deleteCategory');

    Route::get('updateCate/{id}',[CategoryController::class,'update']) -> name('updateCategory');

    Route::post('updateCate',[CategoryController::class,'updatePost']) -> name('updateCategoryPost');

    //genre
    Route::get('genre',[GenreController::class,'index']) -> name('genre');

    Route::get('addGenre',[GenreController::class,'add']) -> name('addGenre');

    Route::post('addGenre',[GenreController::class,'addPost']);

    Route::get('deleteGenre/{id}',[GenreController::class,'delete']) -> name('deleteGenre');

    Route::get('updateGenre/{id}',[GenreController::class,'update']) -> name('updateGenre');

    Route::post('updateGenre',[GenreController::class,'updatePost']) -> name('updateGenrePost');

    //movie
    Route::get('movie',[MovieController::class,'index']) -> name('movie');

    Route::get('addMovie',[MovieController::class,'add']) -> name('addMovie');
    
    Route::post('addMovie',[MovieController::class,'addPost']);

    Route::get('detailMovie/{id}',[MovieController::class,'detail']) -> name('detailMovie');

    Route::get('deleteMovie/{id}',[MovieController::class,'delete']) -> name('deleteMovie');

    Route::get('updateMovie/{id}',[MovieController::class,'update']) -> name('updateMovie');

    Route::post('updateMovie',[MovieController::class,'updatePost']) -> name('updateMoviePost');

    //room
    Route::get('room',[RoomController::class,'index']) -> name('room');

    Route::get('addRoom',[RoomController::class,'add']) -> name('addRoom');

    Route::post('addRoom',[RoomController::class,'addPost']);

    Route::get('deleteRoom/{id}',[RoomController::class,'delete']) -> name('deleteRoom');

    Route::get('updateRoom/{id}',[RoomController::class,'update']) -> name('updateRoom');

    Route::post('updateRoom',[RoomController::class,'updatePost']) -> name('updateRoomPost');

    //showtime
    Route::get('showtime',[ShowtimeController::class,'index']) -> name('showtime');

    Route::get('showtimeDetails/{id}/{date?}',[ShowtimeController::class,'details']) -> name('showtimeDetails');

    Route::get('addShowtime/{id}',[ShowtimeController::class,'add']) -> name('addShowtime');

    Route::post('addShowtime',[ShowtimeController::class,'addPost']) -> name('addShowtimePost');

    //user
    Route::get('user',[UserController::class,'index']) -> name('user');

    Route::get('changeStatusUser/{id?}/{status?}',[UserController::class,'changeStatusUser']) -> name('changeStatusUser');

    //order
    Route::get('order',[OrderController::class,'index']) -> name('order');

});

//Client

Route::middleware('client.auth')->group(function () {

    Route::get('logout',[ClientController::class,'logout']) -> name('logout');

    Route::post('mail',[ClientController::class,'mail']) -> name('mail');

    Route::get('ChangePassword/{id?}',[ClientController::class,'changePassword']) -> name('ChangePassword');

    Route::post('ChangePassword/{id?}',[ClientController::class,'postChangePassword']) -> name('postChangePassword');

    Route::get('ChangePasswordNew/{id?}',[ClientController::class,'changePasswordNew']) -> name('ChangePasswordNew');

    Route::post('ChangePasswordNew',[ClientController::class,'changePasswordNewPost']) -> name('changePasswordNewPost');

    Route::get('ChangeInformation',[ClientController::class,'changeInformation']) -> name('ChangeInformation');

    Route::post('ChangeInformation',[ClientController::class,'changeInformationPost']) -> name('ChangeInformationPost');

    Route::get('BookTicket/{id?}', [ClientController::class,'bookTicket']) -> name('BookTicket');

    Route::post('Checkout', [CheckoutController::class,'checkOut']) -> name('checkOut');

    Route::get('AddOrder', [CheckoutController::class,'order']) -> name('AddOrder');

    Route::get('CheckOutSuccess', [CheckoutController::class,'checkOutSuccess']) -> name('CheckOutSuccess');

    Route::get('OrderOfUser', [ClientController::class,'orderOfUser']) -> name('OrderOfUser');

    Route::get('DeleteComment/{id?}', [CommentController::class,'deleteComment']) -> name('DeleteComment');

    Route::get('AddComment', [CommentController::class,'addComment']) -> name('AddComment');

});

Route::get('register',[ClientController::class,'register']) -> name('register');

Route::post('register',[ClientController::class,'addRegister']);

Route::get('login',[ClientController::class,'login']) -> name('login');

Route::post('login',[ClientController::class,'postLogin']);

Route::get('PasswordRetrieval',[ClientController::class,'passwordRetrieval']) -> name('PasswordRetrieval');

Route::get('SearchMovie', [ClientController::class,'searchMovie']) -> name('SearchMovie');

Route::get('MovieDetail/{id?}/{date?}', [ClientController::class,'movieDetail']) -> name('MovieDetail');

//trang chủ
Route::get('/{id?}',[ClientController::class,'index']) -> name('index');
