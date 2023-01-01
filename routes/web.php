<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\Owner\WelcomController;

Route::get('/', function (){

    if (!auth('admin')->check()) {

        return redirect()->route('dashboard.login.index');

    }//end of if

    return redirect()->route('dashboard.admin.welcome');

});//end of

