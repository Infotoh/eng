<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationResource;
use App\Models\Categorey;
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

        //get consultation for loged in user
        $consultations = $query->where('user_id',auth('api')->id())->get();

        return response()->json([
            'status' => true,
            'data' => ConsultationResource::collection($consultations),
        ],200);
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

        $request->merge(['user_id' => auth('api')->id()]);

        Consultation::create($request->except('comment'));

        return response()->json([
            'status' => true,
            'data' => null,
        ],201);
    }

    public function show($id)
    {
        $consultation= Consultation::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => new ConsultationResource($consultation),
        ],200);


    }//end of show

    public function notifications()
    {
        $consultations = Consultation::whereNotNull('comment')->where('user_id',auth('api')->id())->get();
        $consultations = ConsultationResource::collection($consultations);

        return response()->json([
            'status' => true,
            'data' => $consultations,
        ],200);
    }

    public function categories(){
        $categories = Categorey::all();

        return response()->json([
            'status' => true,
            'data' => $categories,
        ],200);
    }

    


}
