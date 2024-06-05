<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    //
    /**
    * Login api
    * API Login (parameter {userType, email, password})
    * userType { admin or tour_operator_staff }
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        
        /* start email and password validation */
            $validator = Validator::make($request->all(), [
                'email'     => 'required|string|email',
                'password'  => 'required|string|min:6',
                'userType'  => 'required|in:admin,tour_operator_staff',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }   
        /* end email and password validation */

            
        if(!empty($request->userType)){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                if($request->userType === 'admin'){
                    $UserInfo    = Admin::where('email', $request->email)->first();  
                    
                    $tokenResult = $UserInfo->createToken('CMS App');
                    $token = $tokenResult->token;
                    $token->expires_at = Carbon::now()->addWeeks(1);
                    $token->save();
                                        
                    $response_arr = array(
                        'userID'   => $UserInfo->id,
                        'userName' => $UserInfo->name,
                        'access_token' => $tokenResult->accessToken,
                        'access_token_name' => $tokenResult->token->name,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                    );
                    
                    return $this->sendResponse($response_arr, 'Admin Login Successfully.', 'success');
                }
            }else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            } 
        }   
    }
}
