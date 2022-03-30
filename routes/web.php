<?php

use App\Http\Controllers\LoginStaff;
use App\Http\Controllers\NavigateController;
use App\Http\Controllers\RegisterStaff;
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

Route::get('/', [NavigateController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [LoginStaff::class, 'show'])->name('login');
Route::post('/login', [LoginStaff::class, 'process']);
Route::get('/register/staff',[RegisterStaff::class, 'show'])->name('register_staff');
Route::post('/register/staff',[RegisterStaff::class, 'store']);
Route::get('/helpdesk/{status}', [NavigateController::class, 'helpdesk'])->name('helpdesk');
Route::get('/register/staff',[RegisterStaff::class, 'show']);
Route::get('/share/sent', [NavigateController::class, 'share'])->name('share');
Route::get('/share/recieved', [NavigateController::class, 'recieved'])->name('recieved');
Route::get('/generate/report', [NavigateController::class, 'report'])->name('report');
Route::get('/add/ticket', [NavigateController::class, 'add_ticket'])->name('add_ticket');
Route::post('/add/ticket', [NavigateController::class, 'store_ticket']);
Route::post('/send/files',[NavigateController::class, 'send_file']);
Route::get('/view/ticket/{id}',[NavigateController::class, 'ticket_details']);
Route::post('/reply/request/{ticket}', [NavigateController::class, 'send_reply']);
Route::get('/ticket/recieved/{status}', [NavigateController::class, 'recieved_ticket']);
Route::get('/all/users',[NavigateController::class, 'all_users']);
Route::get('/view/report',[NavigateController::class, 'view_generate']);
Route::get('/change/password',[NavigateController::class, 'change_password']);
Route::post('/change/password',[NavigateController::class, 'store_password']);
Route::get('/view/user/{id}',[NavigateController::class, 'view_user']);
Route::post('/change/user/picture',[NavigateController::class, 'update_image']);
Route::get('/edit/user/details/{id}',[NavigateController::class,'show_edit']);
Route::post('/edit/user/details/{id}',[NavigateController::class,'edit_user']);
Route::get('/delete/user/{id}',[NavigateController::class, 'delete_user']);
Route::post('/logout',[NavigateController::class, 'logout']);
