<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;


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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['authcheck'])->group(function(){
    Route::get('/AdminDashbord', [AuthController::class, 'dashbord']);

});


Route::get('/Login',[AuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/Loginuser',[AuthController::class,'userlogin']);
Route::post('/login-user-cus',[AuthController::class,'loginCus'])->name('login-user-cus');
Route::post('/login-user',[AuthController::class,'loginUser'])->name('login-user');
Route::get('/logout-cus', [AuthController::class, 'logoutCus'])->name('logout-cus');



Route::get('/reguser',[AuthController::class,'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user',[AuthController::class,'registerUser'])->name('register-user');


Route::get('/ConcertBruTicket',[ConcertController::class,'index']);
Route::get('/ConcertBruTicket/allconcert', [ConcertController::class, 'allConcerts']);



Route::get('/AdminDashbord/customer', [AdminController::class, 'Dashcus']);
Route::get('/AdminDashbord/concert', [AdminController::class, 'Dashcon']);
Route::get('/AdminDashbord/ticket', [AdminController::class, 'DashTicket']);



Route::post('/add-ticket', [AdminController::class, 'addTicket']);
Route::POST('/update-ticket/{id}', [AdminController::class, 'updateTicket']);
Route::delete('/delete-ticket/{id}', [AdminController::class, 'deleteTicket']);


Route::post('/add-concert', [AdminController::class, 'storeConcert']);
Route::post('/add-customer',[AdminController::class,'addCustomer']);
Route::post('/edit-customer', [AdminController::class, 'updateCustomer']);
Route::post('/delete-customer', [AdminController::class, 'deleteCustomer']);


Route::get('/booking', [BookingController::class, 'showBookingForm']);
Route::get('/show-booking-details', [BookingController::class, 'showBookingDetails']);
Route::post('/booking/{concert_id}', [BookingController::class, 'processBooking'])->name('processBooking');




Route::get('/generate-pdf', [CustomerController::class, 'generatePDF']);
Route::get('/get-tickets-for-concert/{concert_id}', 'TicketController@getTicketsForConcert');

Route::get('/generate-pdf-hhh', [CustomerController::class, 'cusgeneratePDF']);
Route::get('/print-tickets/{customerId}', [BookingController::class,'printTickets']);

Route::get('/test-hash', function () {
    return bcrypt('adminRoger');
});


