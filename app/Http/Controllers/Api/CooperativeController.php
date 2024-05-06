<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use App\Models\CooperativeMember;
use Illuminate\Http\Request;

class CooperativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCooperative()
    {
        try {
            $cooperative = Cooperative::all();

            if ($cooperative->isNotEmpty()) {
                $response = [
                    'code'    => 200,
                    'success' => true,
                    'message' => 'Get data cooperative Successfully!',
                    'data'    => $cooperative
                ];
            } else {
                $response = [
                    'code'    => 404,
                    'success' => false,
                    'message' => 'Cooperative data not found!'
                ];
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'An error occurred while retrieving cooperative data.'
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
            'name'          => 'required|string',
            'email'         => 'nullable|email',
            'phone_number'  => ['nullable', 'string', 'regex:/^08[0-9]{9,}$/'],
            'address'       => 'nullable|string',
            'city'          => 'nullable|string',
            'postal_code'   => 'nullable|string',
        ], [
            'phone_number.regex' => 'The phone number format is invalid. It should start with 08 and have at least 11 digits.',
        ]);

        try {
            $cooperative = new Cooperative();
            $cooperative->no_cooperative = $this->generateNoCooperative();
            $cooperative->name           = $validatedData['name'];
            $cooperative->email          = $validatedData['email'];
            $cooperative->phone_number   = $validatedData['phone_number'];
            $cooperative->address        = $validatedData['address'];
            $cooperative->city           = $validatedData['city'];
            $cooperative->postal_code    = $validatedData['postal_code'];
            $cooperative->save();

            $response = [
                'code'    => 201,
                'success' => true,
                'message' => 'Cooperative data has been successfully created!',
                'data'    => $cooperative
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to create cooperative data.'
            ];

            return response()->json($response, 500);
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
        $validatedData = $request->validate([
            'name'          => 'required|string',
            'email'         => 'nullable|email',
            'phone_number'  => ['nullable', 'string', 'regex:/^08[0-9]{9,}$/'],
            'address'       => 'nullable|string',
            'city'          => 'nullable|string',
            'postal_code'   => 'nullable|string',
        ], [
            'phone_number.regex' => 'The phone number format is invalid. It should start with 08 and have at least 11 digits.',
        ]);

        try {
            $cooperative = Cooperative::findOrFail($id);
            $cooperative->name          = $validatedData['name'];
            $cooperative->email         = $validatedData['email'];
            $cooperative->phone_number  = $validatedData['phone_number'];
            $cooperative->address       = $validatedData['address'];
            $cooperative->city          = $validatedData['city'];
            $cooperative->postal_code   = $validatedData['postal_code'];
            $cooperative->save();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Cooperative data has been successfully updated!',
                'data'    => $cooperative
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to update cooperative data.'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cooperative  $cooperative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Set null for cooperative_id in CooperativeMember
            CooperativeMember::where('cooperative_id', $id)->update(['cooperative_id' => null]);

            $cooperative = Cooperative::findOrFail($id);
            $cooperative->delete();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Cooperative data has been successfully deleted!'
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to delete cooperative data.'
            ];

            return response()->json($response, 500);
        }
    }

    private function generateNoCooperative()
    {
        $dateTimePart = date('YmdHis');

        $lastRecord = Cooperative::latest()->first();
        if ($lastRecord) {
            $numericPart = (int)substr($lastRecord->no_cooperative, -6) + 1;
        } else {
            $numericPart = 1;
        }

        $numericPart = sprintf('%06d', $numericPart);

        $newCode = "KOP-$dateTimePart-$numericPart";

        return $newCode;
    }
}
