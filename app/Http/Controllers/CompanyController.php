<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCompany;
use App\Models\User;
use Exception;
use Carbon\Carbon;

date_default_timezone_set('Asia/Jakarta');

class CompanyController extends Controller
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
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }

            $data = MasterCompany::all();
            if (count($data) != 0) {
                $response = [
                    'status' => true,
                    'message' => 'Data Master Company',
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Data Company Kosong'
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
                'hrm_company_createdAt' => $this->date,
                'hrm_company_createdBy' => $this->cektoken->hrm_usr_id
            ]);

            $data = new MasterCompany($request->all());
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
            $data = MasterCompany::where('hrm_company_id', $id)->first();
            if (!$data == null) {
                $response = [
                    'status' => true,
                    'message' => 'Data Detail Company',
                    'data' => $data
                ];
                $http_code = 200;
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Data Detail Company Kosong'
                ];
                $http_code = 422;
            }
            return response($response, $http_code);
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

            $data = MasterCompany::where('hrm_company_id', $id)->update($request->all());

            if ($data) {
                $response = [
                    "status" => false,
                    "message" => 'Update data success',
                    "data" => $data
                ];
            } else {
                $response = [
                    "status" => false,
                    "message" => 'Update data failed'
                ];
            }

            return response($response, $http_code);
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
        //
    }
}
