<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Absent;
use phpseclib\Crypt\RC2;

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
    return view('login');
})->name('login');
Route::get('/register', function(){
    return view('register');
});
Route::post('/', [LoginController::class, 'login'])->name('postlogin');
Route::group(['middleware' => ['auth','status:admin']],function(){

   // Route::get('/dashboard', function () {
       // return view('admin.home');
   // });
    Route::get('/dashboard', [Admin::class, 'index']);
    Route::get('/dashboard/logout', [LoginController::class, 'logoutAdmin']);
    Route::get('/dashboard/{id}/delete', [Admin::class, 'destroy']);
    Route::post('/dashboard/edit/{id}', [Admin::class, 'update']);
    Route::get('/input/project',[Admin::class, 'getEvent']);
    Route::post('/input/project', [Admin::class, 'create'])->name('input.project');
    Route::get('/input/blog', function () {
        return view('admin.blog');

    });
    Route::post('/input/blog', [Admin::class, 'inputBlogPost']);


});



Route::group(['middleware' => ['auth','status:user']],function(){
    Route::get('/home', [UserController::class, 'index']);
    Route::get('/user/logout', [UserController::class, 'logoutUser']);
    Route::get('/api/absensi', [Absent::class, 'index']);
    
    Route::get('/absensi', function () {
        return view('user.kehadiran');        
    });
    Route::get('/acara', [UserController::class, 'acara']);
    Route::get('/proyek/list', [UserController::class, 'list']);
    Route::get('/pengumpulan/proyek', [UserController::class, 'getPengumpulan']);

});

Route::post('/register', [LoginController::class, 'register']);

Route::group(['middleware' => ['auth','status:user,admin']],function(){

    Route::post('/dashboard/acara', [Admin::class, 'store'])->name('dashboard.acara');
    Route::get('/api/acara', [Admin::class, 'getAcara']);
    Route::get('/api/proyek', [Admin::class, 'getProyek']);
    Route::get('/api/proyek/user', [UserController::class, 'getProyek']);
    
});
