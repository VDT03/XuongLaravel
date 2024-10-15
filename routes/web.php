<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AgeMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});


Route::resource('customers', CustomerController::class);
Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])
    ->name('customers.forceDestroy');

Route::resource('employees', EmployeeController::class);
Route::delete('employees/{employee}/forceDestroy', [EmployeeController::class, 'forceDestroy'])
->name('employees.forceDestroy');


// Laravel UI
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// Bài 1 middleware
Route::middleware([AgeMiddleware::class])->group(function(){
    Route::get('movies', function (){
        return view('movie');
    });
});
// Bài 3 Authentication
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('checkauth');

Route::get('logout', [LogoutController::class, 'logout'])->name('logout');



// Bài tập buổi 5 về session
Route::get('index', [TransactionController::class, 'index'])->name('index');
Route::get('create-trans', [TransactionController::class, 'create'])->name('transcreate');
Route::post('store-trans', [TransactionController::class, 'store'])->name('transstore');
Route::get('inf-trans', [TransactionController::class, 'infor'])->name('transinfor');
Route::post('confirm-trans', [TransactionController::class, 'confirm'])->name('transconfirm');
Route::get('forget', [TransactionController::class, 'forget'])->name('forget');



// Bài tập buổi 6 về mối quan hệ Eloquent
Route::resource('students', StudentController::class);