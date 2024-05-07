<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CooperativeMember;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEducation()
    {
        try {
            $education = Education::orderBy('id', 'ASC')->get();

            if ($education->isNotEmpty()) {
                $response = [
                    'code'    => 200,
                    'success' => true,
                    'message' => 'Get data education Successfully!',
                    'data'    => $education
                ];
            } else {
                $response = [
                    'code'    => 404,
                    'success' => false,
                    'message' => 'Education data not found!'
                ];
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'An error occurred while retrieving education data.'
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
            'name' => 'required|string',
        ]);

        try {
            $education = new Education();
            $education->code = $this->generateCode();
            $education->name = $validatedData['name'];
            $education->save();

            $response = [
                'code'    => 201,
                'success' => true,
                'message' => 'Education data has been successfully created!',
                'data'    => $education
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to create education data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $education = Education::findOrFail($id);
            $education->name = $validatedData['name'];
            $education->save();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Education data has been successfully updated!',
                'data'    => $education
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to update education data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Set null for education_id in CooperativeMember
            CooperativeMember::where('education_id', $id)->update(['education_id' => null]);

            $education = Education::findOrFail($id);
            $education->delete();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Education data has been successfully deleted!'
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to delete education data.'
            ];

            return response()->json($response, 500);
        }
    }

    private function generateCode()
    {
        $lastRecord = Education::latest()->first();

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
