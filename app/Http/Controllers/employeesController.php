<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\MasterEmployees;
use App\Models\User;
use DB;
use Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;
date_default_timezone_set('Asia/Jakarta');

class employeesController extends Controller
{
    public function __construct(Request $request)
    {
        $token = $request->header('X-CSRF-Token');
        $this->cektoken = User::select('hrm_usr_id')->where('hrm_usr_token', $token)->first();
        if (!$this->cektoken) {
            throw new Exception("Unauthorized", 401);
        }
        $this->date=Carbon::now()->format('Y-m-d H:i:s');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'employees';
        $data = MasterEmployees::all();
        return response([
            'status'=>True,
            'message'=>'Data Master Employees',
            'data'=>$data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 'tambah';
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'id_company' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'profile_image' => 'required',
            'alamat' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            $out = [
                "message" => $validator->messages()->all(),
            ];
            return response()->json($out, 422);
        }

        $data = new MasterEmployees();
        $data->nip = $request->nip;
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->id_company = $request->id_company;
        $data->gender = $request->gender;
        $data->father_name = $request->father_name;
        $data->phone = $request->phone;
        $data->date_of_birth = $request->date_of_birth;
        $data->profile_image = $request->profile_image;
        $data->alamat = $request->alamat;
        $data->status = $request->status;
        $data->hrm_employees_createdAt = $this->date;
        $data->hrm_employees_createdBy = $this->cektoken['hrm_usr_id'];
        $createEmployees = $data->save();
        if ($createEmployees) {
            return response([
                'status'=>true,
                'message'=>'Create employees success',
                'data'=>$data
            ]);
        } else {
            return response([
                'status'=>false,
                'message'=>'Create employees failed',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MasterEmployees::find($id);
        return response([
            'status'=> true,
            'message'=> 'Data employees',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateemployees = MasterEmployees::where('id', $id)
        ->update([
            'nip' => $request->nip,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'id_company' => $request->id_company,
            'gender' => $request->gender,
            'father_name' => $request->father_name,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'profile_image' => $request->profile_image,
            'alamat' => $request->alamat,
            'status' => $request->status
        ]);
        if ($updateemployees) {
            $data = MasterEmployees::where('id', $id)->get();
            return response ([
                'status' => true,
                'message' => 'Update employees success',
                'data' => $data
            ]);
        } else {
            return response ([
                'status' => true,
                'message' => 'Update employees failed',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteemployees = MasterEmployees::where('id', $id)
        ->delete();
        if ($deleteemployees) {
            return response ([
                'status' => true,
                'message' => 'Delete employees success'
            ]);
        } else {
            return response ([
                'status' => false,
                'message' => 'Delete employees failed'
            ]);
        } 
    }
}
