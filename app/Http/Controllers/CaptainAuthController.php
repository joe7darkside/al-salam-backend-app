<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Captain;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CaptainAuthController extends Controller
{

    /**
     * Register a Captian.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fields = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|digits:11|unique:captains|max:11',
                'email' => 'required|email|unique:captains|max:255',
                'vehicle' => 'required|max:255',
                'licence_plate' => 'required|max:255',
                'password' => 'required|confirmed|max:255|min:8',
                'img' => 'required|mimes:jpeg,png,jpg|max:1850',

            ]);
            if ($fields->fails()) {
                redirect()->back()->with(['Error', $fields->errors()->toJson()]);
            }
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/images/captains/', $filename);

            Captain::create(array_merge(
                $fields->validated(),
                [
                    'password' => Hash::make($request->password),
                    'img' => 'uploads/images/captains/' . $filename,
                ]
            ));

            return redirect()->back()->with('Success', 'Added successfully');
        }
        return redirect()->back()->with('Error', 'The image not found!');
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->guard('captain')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('captain')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('captain')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('captain')->refresh());
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('captain')->factory()->getTTL() * 60
        ]);
    }
}
