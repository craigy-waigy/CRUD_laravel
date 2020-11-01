<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Oauth\GithubController;

Auth::routes();

Route::get('/', 'StatController@contract')->name('stat.contract');

Route::resource('/contractor', 'ContractorController', [
    'except' => ['show'],
]);

Route::resource('/customer', 'CustomerController', [
    'except' => ['show'],
]);

Route::resource('/contract', 'ContractController', [
    'except' => ['show'],
]);

Route::get('auth/github', [GithubController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [GithubController::class, 'handleGithubCallback']);