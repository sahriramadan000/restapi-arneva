<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CooperativeMember;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJob()
    {
        try {
            $job = Job::orderBy('id', 'ASC')->get();

            if ($job->isNotEmpty()) {
                $response = [
                    'code'    => 200,
                    'success' => true,
                    'message' => 'Get data job Successfully!',
                    'data'    => $job
                ];
            } else {
                $response = [
                    'code'    => 404,
                    'success' => false,
                    'message' => 'Job data not found!'
                ];
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'An error occurred while retrieving job data.'
            ];

            return response()->json($response, 500);
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
        $validatedData = $request->validate([
            'name'    => 'required|string',
            'detail'  => 'nullable|string',
        ]);

        try {
            $job = new Job();
            $job->code   = $this->generateCode();
            $job->name   = $validatedData['name'];
            $job->detail = $validatedData['detail'];
            $job->save();

            $response = [
                'code'    => 201,
                'success' => true,
                'message' => 'Job data has been successfully created!',
                'data'    => $job
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to create job data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'   => 'required|string',
            'detail' => 'nullable|string',
        ]);

        try {
            $job = Job::findOrFail($id);
            $job->name   = $validatedData['name'];
            $job->detail = $validatedData['detail'];
            $job->save();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Job data has been successfully updated!',
                'data'    => $job
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to update job data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Set null for job_id in CooperativeMember
            CooperativeMember::where('job_id', $id)->update(['job_id' => null]);

            $job = Job::findOrFail($id);
            $job->delete();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Job data has been successfully deleted!'
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to delete job data.'
            ];

            return response()->json($response, 500);
        }
    }

    private function generateCode()
    {
        $lastRecord = Job::latest()->first();

        if ($lastRecord) {
            $numericPart = (int)substr($lastRecord->code, -6);
            $numericPart++;

            $newCode = sprintf('%06d', $numericPart);
        } else {
            $newCode = '000001';
        }

        return $newCode;
    }
}
