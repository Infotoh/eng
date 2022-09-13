<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function index()
    {
        $data = Consultation::all();

        return response()->api($data);
    }
}
