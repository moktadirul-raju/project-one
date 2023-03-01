<?php

use Illuminate\Support\Facades\Route;

Route::view('/','auth.login')->name('home');

// User login and registration related routes
Route::namespace('Auth')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::view('login','auth.login')->name('login');
        Route::post('user-login','userLogin')->name('user-login');
        Route::get('logout','logout')->name('logout');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::view('register','auth.register')->name('register');
        Route::post('user-register','userRegister')->name('user-register');
        Route::get('change-profile','changeProfileForm')->name('change-profile');
        Route::put('update-profile','updateProfile')->name('update-profile');
    });
});

// Authenticate user routes
Route::middleware('auth')->group(function () {
    // To-do and tasks related routes
    Route::resource('to-do-list','ToDoListController');

    // Manage tasks
    Route::controller(ToDoListController::class)->group(function () {
        Route::get('to-do-tasks/{id}','toDoTasks')->name('to-do-tasks');
        Route::get('manage-tasks/{id}','manageTask')->name('manage-tasks');
        Route::put('update-to-do-tasks/{id}','updateTasks')->name('update-to-do-tasks');
        Route::get('add-tasks/{id}','addTask')->name('add-tasks');
        Route::post('add-tasks-on-to-do/{id}','storeTask')->name('add-tasks-on-to-do');
        Route::get('edit-task/{id}','editTask')->name('edit-task');
        Route::put('update-task/{id}','updateTask')->name('update-task');
        Route::delete('delete-task/{id}','deleteTask')->name('delete-task');
    });
});


