<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\MasterDep;
use App\Models\User;
use DB;
use Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Throwable;
use Carbon\Carbon;
date_default_timezone_set('Asia/Jakarta');

class DepController extends Controller
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
        $data = MasterDep::all();
        return response([
            'status'=>true,
            'message'=>'Data master departement',
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
        $validator = Validator::make($request->all(), [
            'name_dep' => 'required',
            'company_id' => 'required'
        ]);
        if ($validator->fails()) {
            $out = [
                "message"=>$validator->messages()->all()
            ];
            return response()->json($out, 422);
        }

        $data = new MasterDep();
        $data->hrm_name_dep = $request->name_dep;
        $data->hrm_company_id = $request->company_id;
        $data->hrm_dep_createdAt = $this->date;
        $data->hrm_dep_createdBy = $this->cektoken['hrm_usr_id'];
        $createdep = $data->save();
        if ($createdep) {
            return response([
                'status'=>true,
                'message'=>'Create departement success',
                'data'=>$data
            ]);
        } else {
           return response([
            'status'=>false,
            'message'=>'Create departement failed',
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
        $data = MasterDep::where('hrm_dep_id', $id)->get();
        return response([
            'status'=>true,
            'message'=>'Data departement',
            'data'=>$data
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
     $updatedep = MasterDep::where('hrm_dep_id', $id)->update([
        'hrm_name_dep' => $request->name_dep,
        'hrm_company_id' => $request->company_id,
        'hrm_dep_updatedAt' => $this->date,
        'hrm_dep_updatedBy' => $this->cektoken['hrm_usr_id']
    ]);
     if ($updatedep) {
        $data = MasterDep::where('hrm_dep_id', $id)->get();
        return response([
            'status'=>true,
            'message'=>'Updated departement success',
            'data'=>$data
        ]);
    } else {
       return response([
        'status'=>false,
        'message'=>'Updated departement failed',
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
        $deletedep = MasterDep::where('hrm_dep_id', $id)->delete();
        if ($deletedep) {
            return response([
                'status'=>true,
                'message'=>'Delete departement success'
            ]);
        } else {
            return response([
                'status'=>false,
                'message'=>'Delete departement failed'
            ]);
        }
        
    }
}
