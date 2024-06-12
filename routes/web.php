<?php

use App\Http\Controllers\Controller; // Add this line
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StudentDocumentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ReportController;




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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('/profile', [InfoUserController::class, 'user'])->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	// Route::get('user-management', function () {
	// 	return view('management/user-management');
	// })->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	//Route::get('virtual-reality', function () {
	//	return view('virtual-reality');
	//})->name('virtual-reality');

	//Route::get('static-sign-in', function () {
	//	return view('static-sign-in');
	//})->name('sign-in');

	//Route::get('static-sign-up', function () {
	//	return view('static-sign-up');
	//})->name('sign-up');

	Route::get('/report-main', [ReportController::class, 'main'])->name('report.main');
	Route::post('/save_report', [ReportController::class, 'save_report'])->name('report.save');


	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/add_products', [InfoUserController::class, 'add_products']);
	Route::post('/save_enrollee', [InfoUserController::class, 'save_enrollee']);
	Route::post('/save_product', [InfoUserController::class, 'save_product']);
	Route::get('/enrolled_students', [InfoUserController::class, 'enrolled_students'])->name('enrolled_students');
	Route::get('/view_products', [InfoUserController::class, 'view_products'])->name('view_products');

	Route::delete('/delete_enrollee/{id}', [InfoUserController::class, 'delete_enrollee'])->name('delete_enrollee');
	Route::get('/update_enrollee/{id}', [InfoUserController::class, 'edit'])->name('management.enrolled_student_update');
	Route::get('/product_details/{id}', [InfoUserController::class, 'product_details'])->name('management.product_details');
	Route::post('/update_product/{id}', [InfoUserController::class, 'update_product'])->name('management.update_product');


    Route::put('/management/enrolled_student_update/{id}', [InfoUserController::class, 'update_enrollee']);

	Route::put('/management/add_staff/', [InfoUserController::class, 'add_staff']);
	Route::put('/management/add_role/', [InfoUserController::class, 'add_role']);
	Route::get('/backup', [InfoUserController::class, 'backup'])->name('backup');
	Route::post('/update-profile', [InfoUserController::class, 'updateProfile'])->name('update.profile');
	Route::post('/change_email', [InfoUserController::class, 'change_email']);
	Route::post('/change_password', [InfoUserController::class, 'change_password']);


	// ? CHATS
	Route::post('/send-chat', [ChatController::class, 'sendChat'])->name('send-chat');
	Route::get('/conversation', [ChatController::class, 'loadConversation'])->name('load-conversation');

	Route::get('user-management', [InfoUserController::class, 'user_management'])->name('user-management');
	Route::get('/student_documents', [StudentDocumentsController::class, 'student_documents'])->name('student_documents');
	Route::put('/update_student_documents/{id}', [StudentDocumentsController::class, 'updateStudentDocuments'])
		->name('update_student_documents');
	Route::get('/download_student_document/{id}/{type}', [StudentDocumentsController::class, 'downloadStudentDocument'])
		->name('download_student_document');

	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});

// Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store'])->name('register');
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password', [ResetController::class, 'resetPass'])->name('password.reset');


// });

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');


Route::post('/backup-database', [DatabaseController::class, 'backupDatabase']);





