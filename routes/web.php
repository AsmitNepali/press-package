<?php

use Illuminate\Support\Facades\Route;
use Vicgonvt\Press\Http\Controllers\TestController;

Route::view('blog', 'press::test');

Route::get('controller', [TestController::class,'index']);