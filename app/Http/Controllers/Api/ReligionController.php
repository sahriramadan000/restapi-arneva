<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CooperativeMember;
use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReligion()
    {
        try {
            $religion = Religion::all();

            if ($religion->isNotEmpty()) {
                $response = [
                    'code'    => 200,
                    'success' => true,
                    'message' => 'Get data religion Successfully!',
                    'data'    => $religion
                ];
            } else {
                $response = [
                    'code'    => 404,
                    'success' => false,
                    'message' => 'Religion data not found!'
                ];
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'An error occurred while retrieving religion data.'
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
            $religion = new Religion();
            $religion->code = $this->generateCode();
            $religion->name = $validatedData['name'];
            $religion->save();

            $response = [
                'code'    => 201,
                'success' => true,
                'message' => 'Religion data has been successfully created!',
                'data'    => $religion
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to create religion data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $religion = Religion::findOrFail($id);
            $religion->name = $validatedData['name'];
            $religion->save();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Religion data has been successfully updated!',
                'data'    => $religion
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to update religion data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Set null for religion_id in CooperativeMember
            CooperativeMember::where('religion_id', $id)->update(['religion_id' => null]);

            $religion = Religion::findOrFail($id);
            $religion->delete();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Religion data has been successfully deleted!'
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to delete religion data.'
            ];

            return response()->json($response, 500);
        }
    }

    private function generateCode()
    {
        $lastRecord = Religion::latest()->first();

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
