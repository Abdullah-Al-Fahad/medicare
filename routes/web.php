<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterPatientController;
use App\Http\Controllers\Auth\RegisterDoctorController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\AppointmentListController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\AccountController;



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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Patient registration route
Route::post('patient/register', 'App\Http\Controllers\Auth\RegisterPatientController@register')->name('patient.register.submit');

// Doctor registration route
Route::post('doctor/register', 'App\Http\Controllers\Auth\RegisterDoctorController@register')->name('doctor.register.submit');

// Login routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Display appointment form
Route::get('/appointment', [PatientAppointmentController::class, 'index'])->name('patient.appointment');

// Store appointment data
Route::post('/appointment', [PatientAppointmentController::class, 'store'])->name('patient.appointment.store');

// Route for displaying the appointment list
Route::get('/patient/appointments', [AppointmentListController::class, 'index'])->name('patient.appointmentslist');
Route::get('/doctor/appointments', [AppointmentListController::class, 'index'])->name('doctor.appointmentslist');


// Route for deleting an appointment
Route::delete('/appointmentslist/{appointment}', [AppointmentListController::class, 'destroy'])->name('appointment.destroy');

// Forum routes
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum/post', [ForumController::class, 'createPost'])->name('forum.createPost');
Route::post('/forum/post/{postId}/comment', [ForumController::class, 'addComment'])->name('forum.addComment');
Route::delete('/forum/delete-post/{postId}', [ForumController::class, 'deletePost'])->name('forum.deletePost');

// Chat routes
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::get('/chat/get-messages', [ChatController::class, 'getMessages'])->name('chat.getMessages');

//graph routes


// Route for displaying the form page
Route::get('/graphs/create', [GraphController::class, 'create'])->name('graphs.create');

// Route for submitting the form
Route::post('/graphs', [GraphController::class, 'store'])->name('graphs.store');

// Route for displaying the graph page
Route::get('/graphs', [GraphController::class, 'show'])->name('graphs.show');
Route::get('/graphz', [GraphController::class, 'showx'])->name('grap.show');

// Route for retrieving the graph data
Route::get('/graphs/patient', [GraphController::class, 'getData'])->name('graphs.getData');
Route::get('/graphs/data', [GraphController::class, 'showGraphs'])->name('enx');

Route::get('/patient/select', [GraphController::class, 'patientselector'])->name('selector');


//settings for updating the info of user
Route::get('/account/settings', [AccountController::class, 'showSettings'])->name('Settings');
Route::match(['PUT', 'POST'], '/account/settings', [AccountController::class, 'updateSettings'])->name('account.update');



