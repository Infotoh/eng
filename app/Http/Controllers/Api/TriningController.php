<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use Illuminate\Support\Facades\Validator;

class TriningController extends Controller
{
    //
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required'],
            'name' => ['required'],
            'qualification' => ['required'],
            'age' => 'required|numeric',
            'number2' => 'required|numeric',
            'gender_type' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $data = Training::create($request->all());

        return response()->api($data);
    }
}
