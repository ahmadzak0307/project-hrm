<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterRole;
use App\Models\User;
use DB;
use Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;
date_default_timezone_set('Asia/Jakarta');

class MasterRoleController extends Controller
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
        // return 'index';
        $data = MasterRole::all();
        return response([
            'status'=> true,
            'message'=> 'Data Role',
            'data' =>$data
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
        $data = new MasterRole();
        $data->hrm_role_name = $request->role_name;
        $data->hrm_role_stat = $request->role_stat;
        $data->hrm_role_createdAt = $this->date;
        $data->hrm_role_createdBy = $this->cektoken['hrm_usr_id'];
        $data->hrm_role_updatedAt = $this->date;
        $data->hrm_role_createdBy = $this->cektoken['hrm_usr_id'];
        $createrole = $data->save();
        if ($createrole) {
            return response([
                'status'=> true,
                'message'=>'Create role success',
                'data'=>$data,
            ]);
        } else {
            return response([
                'status'=> false,
                'message'=>'Create role failed'
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
        $data = MasterRole::where('hrm_role_id', $id)->get();
        // return $data;
        return response([
            'status'=> true,
            'message'=> 'Data Role Detail',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
