<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
class TriningController extends Controller
{
    //
    public function index()
    {
        $data = Training::all();

        return response()->api($data);
    }
}
