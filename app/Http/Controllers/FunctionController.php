<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Throwable;
use Carbon\Carbon;

date_default_timezone_set('Asia/Jakarta');


class FunctionController extends Controller
{
    public function __construct(Request $request)
    {
        $token = $request->header('X-CSRF-Token');
        $this->cektoken = User::select('hrm_usr_id')->where('hrm_usr_token', $token)->first();

        $this->date = Carbon::now()->format('Y-m-d H:i:s');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'index';
        // $data = MasterFunction::all();
        $data = MasterFunction::select('hrm_mst_function.*', 'b.hrm_name_dep')
            ->leftjoin('hrm_mst_dep as b', 'b.hrm_dep_id', '=', 'hrm_mst_function.hrm_dep_id')
            ->get(); 

        return response([
            'status' => true,
            'message' => 'Data master function',
            'data' => $data
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
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }
            $request->merge([
                'hrm_func_createdAt' => $this->date,
                'hrm_func_createdBy' => $this->cektoken->hrm_usr_id
            ]);


            $data = new MasterFunction($request->all());
            $create = $data->save();
            if ($create) {
                $response = [
                    'status' => true,
                    'message' => 'Create data success',
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Create data failed'
                ];
            }

            return response($response);
        } catch (Exception $th) {
            $response = [
                "status" => false,
                "message" => $th->getMessage()
            ];
            return response($response, 401);
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
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }
            $data = MasterFunction::where('hrm_func_id', $id)->first();
            if (!$data == null) {
                return response([
                    'status' => true,
                    'message' => 'Data Shown',
                    'data' => $data
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Failed to Shown'
                ]);
            }
        } catch (Exception $th) {
            $response = [
                "status" => false,
                "message" => $th->getMessage()
            ];
            return response($response, 401);
        }
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
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }

            $request->merge([
                'hrm_func_updatedAt' => $this->date,
                'hrm_func_updatedBy' => $this->cektoken->hrm_usr_id
            ]);

            $data = MasterFunction::where('hrm_func_id', $id)->update($request->all());
            if ($data) {
                return response([
                    'status' => true,
                    'message' => 'Update Data Success',
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Update Data failed',
                ]);
            }
            return response($response);
        } catch (Exception $th) {
            $response = [
                "status" => false,
                "message" => $th->getMessage()
            ];
            return response($response, 401);
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
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }

            $data = MasterFunction::where('hrm_func_id', $id);
            $data = $data->delete();

            if ($data) {
                return response([
                    'status' => true,
                    'message' => 'Delete Data Success'
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Delete Data Failed'
                ]);
            }
        } catch (Exception $th) {
            $response = [
                "status" => false,
                "message" => $th->getMessage()
            ];
            return response($response, 401);
        }
    }
}
