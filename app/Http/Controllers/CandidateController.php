<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\SkillSet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    private $responses;

    public function __construct()
    {
        $this->responses = [
            'meta' => [
                'code' => '',
                'message' => ''
            ]
        ];
    }

    public function apply(Request $request) 
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'phone'     => 'required|numeric|unique:candidates',
                'email'     => 'required|email|unique:candidates',
                'year'      => 'required|numeric',
                'job_id'    => 'required|numeric',
                'skills'    => 'required'
            ]);
            
            if ($validator->fails()) {
                $this->responses['meta']['code'] = 422;
                $this->responses['meta']['message'] = 'Input validation error';
                $this->responses['error'] = $validator->errors();
                
                return response()->json($this->responses);
            }

            $candidate = new Candidate();
            $candidate->name = $request->name;
            $candidate->email = $request->email;
            $candidate->phone = $request->phone;
            $candidate->year = $request->year;
            $candidate->job_id = $request->job_id;
            $candidate->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $candidate->save();
    
            $skill_set = new SkillSet();
            $skill_set->candidate_id = $candidate->id;
            $skill_set->skill_id = json_encode($request->skills);
            $skill_set->save();

            DB::commit();
    
            $this->responses['meta']['code'] = 200;
            $this->responses['meta']['message'] = 'Your application has been sent';
    
            return response()->json($this->responses);
        } catch (\Throwable $th) {
            DB::rollback();
            $this->responses['meta']['code'] = 500;
            $this->responses['meta']['message'] = $th->getMessage();
    
            return response()->json($this->responses);
        }
    }
}
