<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobController extends Controller
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
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skill = Job::whereNull('deleted_at')->get();

        if (count($skill) == 0) {
            $this->responses['meta']['code'] = 404;
            $this->responses['meta']['message'] = 'Data not found';
            $this->responses['data'] = $skill;
    
            return response()->json($this->responses);
        }

        $this->responses['meta']['code'] = 200;
        $this->responses['meta']['message'] = 'Success get data';
        $this->responses['data'] = $skill;

        return response()->json($this->responses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $add = Job::create([
            'name' => $request->name,
            'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        $this->responses['meta']['code'] = 200;
        $this->responses['meta']['message'] = 'Success add data';
        $this->responses['data'] = $add;

        return response()->json($this->responses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $params = [
            'name' => $request->name,
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
        ];

        Job::where('id', $id)->update($params);

        $this->responses['meta']['code'] = 200;
        $this->responses['meta']['message'] = 'Success update data';

        return response()->json($this->responses);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $skill = Job::find($id);
        if (!$skill) {
            $this->responses['meta']['code'] = 404;
            $this->responses['meta']['message'] = 'Data not found';
            $this->responses['data'] = [];
    
            return response()->json($this->responses);
        }

        // soft delete
        $params = [
            'deleted_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
        ];

        Job::where('id', $id)->update($params);

        $this->responses['meta']['code'] = 200;
        $this->responses['meta']['message'] = 'Success delete data data';
        $this->responses['data'] = $skill;

        return response()->json($this->responses);
    }
}
