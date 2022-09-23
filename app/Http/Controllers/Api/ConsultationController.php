<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required'],
            'name' => ['required'],
            'consultion' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $data = Consultation::create($request->all());

        return response()->api($data);
    }
}
