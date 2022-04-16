<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use Log;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthController extends Controller
{
    public function userlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $out = [
                "message"=> $validator->messages()->all(),
            ];
            return response()->json($out, 422);
        }
    	// return 'login';
        $email = $request->email;
        $password = $request->password;
        $cekUser = User::select('hrm_mst_usr.hrm_usr_id','hrm_mst_usr.hrm_usr_role','hrm_mst_usr.hrm_role_id','hrm_mst_usr.hrm_usr_nama','hrm_mst_usr.hrm_usr_email')
        ->where('hrm_usr_email', $email)
        ->where('password', $password)
        ->join('hrm_mst_role', 'hrm_mst_role.hrm_role_id', '=', 'hrm_mst_usr.hrm_usr_role')
        ->first();

        if (empty($cekUser)) {
            $response = [
                "status" => false,
                "message" => "User Not Found."
            ];
            return response()->json($response, 422);
        } else {

            $token = Str::random(60);
            $tokennew = DB::table('hrm_mst_usr')->where('hrm_usr_email',$cekUser['hrm_usr_email'])->update([
                'hrm_usr_token' => $token
            ]);

            if ($tokennew) {
                $response = [
                    "status" => true,
                    "message" => "Login Successfuly.",
                    "data" => $cekUser,
                    "token" => $token,
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    "status" => false,
                    "message" => "Login Failed."
                ];
                return response()->json($response, 401);
            }
            
        }
        
    }

    public function getprofile(Request $request)
    {
        // return 'profile';
        $token = $request->header('X-CSRF-Token');
        $cektoken = User::select('hrm_usr_id')->where('hrm_usr_token', $token)->first();
        // return $cektoken;

        try {
            if (!$cektoken) {
                throw new Exception("Unauthorized", 401);
            }
            $cekUser = User::select('hrm_mst_usr.hrm_usr_id','hrm_mst_usr.hrm_usr_role','hrm_mst_usr.hrm_role_id','hrm_mst_usr.hrm_usr_nama','hrm_mst_usr.hrm_usr_email')
            ->where('hrm_usr_id', $cektoken['hrm_usr_id'])
            ->leftjoin('hrm_mst_role','hrm_mst_role.hrm_role_id','=','hrm_mst_usr.hrm_usr_role')
            ->first();

            if ($cekUser) {
                $getprofiledata=[
                    "hrm_usr_id"=>$cekUser->hrm_usr_id,
                    "hrm_usr_role"=>$cekUser->hrm_usr_role,
                    "hrm_role_id"=>$cekUser->hrm_role_id,
                    "hrm_usr_nama"=>$cekUser->hrm_usr_nama,
                    "hrm_usr_email"=>$cekUser->hrm_usr_email,
                    "hrm_usr_id"=>$cekUser->hrm_usr_id
                ];

                $response = [
                    "status" =>true,
                    "message"=>"Data Shown",
                    "data"=>$getprofiledata
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    "status" =>false,
                    "message"=>"User Not Found"
                ];
                return response()->json($response, 401);
            }

        } catch (Throwable $th) {
            $response = [
                "status" => false,
                "message" => "Failed to Show..",
                "error" => $th
            ];
            $http_code = 422;

            return response($response,$http_code);
        }
    }
}
