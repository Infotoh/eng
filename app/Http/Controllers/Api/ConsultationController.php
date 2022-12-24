<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;


class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Consultation::query();
        $query->when($request->status,function($q) use ($request){
            return $q->where('categoreys_id',$request->status);
        });
        
        // $categoreys = $query->where('user_id',auth()->id());
        $categoreys = $query->get();
        
        return JsonResource::collection($categoreys);
    }
    


   public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required','numeric'],
            'name' => ['required'],
            'consultion' => ['required'],
            'categoreys_id' => 'required|numeric|exists:categoreys,id',
        ]);

        if ($validator->fails()) {
         return response()->api([], 1, $validator->errors()->first());
        }
        
        return auth()->user('sanctum');
        $request->merge(['user_id' => auth()->id()]);

        $data = Consultation::create($request->all());

        return response()->api($data);
    }
    
    public function show($id)
    {
        $category = Consultation::findOrFail($id);
        
    }//end of show

    
 
    
    
}
