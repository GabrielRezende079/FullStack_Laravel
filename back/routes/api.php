<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ===> php artisan install:api  |  para criar api.php
//Porém é de boa prática criar um controller
// ===>   php artisan make:controller --api

/*
Exemplo de Criação de Rotas "uma por uma":

Route::get('users/', [UserController::class,'index']);
Route::post('users/', [UserController::class,'store']);
*/

//Criação de todas as 5 rotas em uma linha:       GET, POST, GET_by_ID, PUT, DELETE
Route::apiResource('/users', UserController::class);

// ===> php artisan route:list --path=api    "Lista suas rotas apis"






