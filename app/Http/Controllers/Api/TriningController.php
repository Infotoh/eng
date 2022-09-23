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
        $data = \App\Models\Training::create([
            'number' => 21111222,
            'number2' => 9999,
            'name' => 'training ',
            'age' => 12,
            'gender_type' => 'mail',
            'qualification' => 'qualification ',
        ]);

        return response()->api($data);
    }
}
