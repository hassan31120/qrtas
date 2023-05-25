<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|numeric|unique:users,number',
            "email" => 'nullable|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'push_token' => 'required'
        ]);

        if ($validator->fails()) {
            // return $this->sendError('please Validate error', $validator->errors());
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ], 200);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['push_token'] = $request['push_token'];
        $input['real_age'] = Carbon::parse($input['age'])->age;
        $user = User::create($input);
        $success['token'] = $user->createToken('hassona')->plainTextToken;
        $success['name'] = $user->name;

        $users = User::all();
        $cart['user_id'] = $users[count($users) - 1]->id;
        Cart::create($cart);

        return $this->sendResponse($success, 'User has registered successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'push_token' => 'required'
        ]);

        $loginData = [
            'password' => $request->password,
        ];

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $loginData['email'] = $request->email;
        } else {
            $loginData['number'] = $request->email;
        }

        if (Auth::attempt($loginData)) {
            $user =  User::find(Auth::user()->id);
            $success['token'] = $user->createToken('hassona')->plainTextToken;
            $success['name'] = $user->name;
            $user['push_token'] = $request['push_token'];
            $user->save();
            return $this->sendResponse($success, 'User has login successfully');
        } else {
            return response()->json(
                [
                    'success' => false,
                    'data' => [],
                    'message' => 'Please check your credentials',
                ],
                200
            );
        }
    }
}
