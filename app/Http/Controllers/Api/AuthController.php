<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'    => ['required','numeric','min:9'],
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $request['password'] = '123123123';

        $credentials = $request->only('phone', 'password');

        if (auth()->attempt($credentials)) {

            $user          = auth()->user();
            $data['user']  = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;

            return response()->api($data);

        } else {

            return response()->api([], 1, __('auth.failed'));

        }//end of else

    }//end of login

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'phone'    => ['required','unique:users'],
        ]);


        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }
        $request_data = $request->except('image');
        $request_data['password'] = bcrypt('123123123');

        if($request->image) {

            $request_data['image'] = $request->file('image')->store('user_images','public');

        }//end of image

        $user = User::create($request_data);

        $request['password'] = '123123123';
        $credentials = $request->only('phone', 'password');

        if (auth()->attempt($credentials)) {

            $user          = auth()->user();
            $data['user']  = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;

            return response()->api($data);

        } else {

            return response()->api([], 1, __('auth.failed'));

        }//end of else

    }//end of register

    public function user()
    {
        $data['user'] = new UserResource(auth()->user('sanctum'));

        $data['favoreds']      = User::with('favoreds')->find($data['user']->id);
        $data['favored_count'] = Favored::where('user_id', $data['user']->id)->count();

        return response()->api($data);

    }// end of user

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'region'   => ['required'],
            // 'phone'    => ['required','unique:users'],
            // 'image'    => ['required','image'],
            // 'password' => ['required','min:6'],
        ]);


        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $data['user'] = new UserResource(auth()->user('sanctum'));

        $user = User::find($data['user']->id);

        if ($request->image) {

            if ($user->image != 'user_images/default.png') {

                Storage::disk('local')->delete('public/'. $user->image);

            } //end of if

            $request_data['image'] = $request->file('image')->store('user_images','public');

            $user->update([
                'username' => $request->username,
                'region'   => $request->region,
                'image'    => $request_data['image'],
            ]);

        } else {

            $user->update([
                'username' => $request->username,
                'region'   => $request->region,
            ]);

        }//end of if

        $user = User::find($data['user']->id);

        return response()->api($user);

    }//end of update user

    public function update_user(User $user, Request $request)
    {
        $user = User::find($request->id);

        $user->update([
            'username' => $request->username,
            'region'   => $request->region,
        ]);

        return response()->api($user);

    }//end of update user

}//end of controller
