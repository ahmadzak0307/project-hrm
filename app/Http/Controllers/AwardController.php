<?php

namespace App\Http\Controllers;

use App\Models\MasterAward;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AwardController extends Controller
{
    public function __construct(Request $request)
    {
        $token = $request->header('X-CSRF-Token');
        $this->cektoken = User::select('hrm_usr_id')->where('hrm_usr_token', $token)->first();
        $this->date = Carbon::now()->format('Y-m-d H:i:s');
    }

    public function index()
    {
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }

            $data = MasterAward::all();
            if (count($data) != 0) {
                $response = [
                    'status' => true,
                    'message' => 'Data Master Award',
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Data Award Kosong'
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

    public function store(Request $request)
    {
        try {
            if (!$this->cektoken) {
                throw new Exception("Unauthorized", 401);
            }
            $request->merge([
                'created_at' => $this->date,
                'updated_at' => $this->date
            ]);
            $data = new MasterAward($request->all());
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
        } catch (Exception $th) {
            $response = [
                "status" => false,
                "message" => $th->getMessage()
            ];
            return response($response, 401);
        }
    }
}
