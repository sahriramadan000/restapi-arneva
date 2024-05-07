<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use App\Models\CooperativeMember;
use App\Models\Education;
use App\Models\Job;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CooperativeMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCooperativeMember()
    {
        try {
            $cooperativeMembers = CooperativeMember::orderBy('id', 'ASC')->get();

            if ($cooperativeMembers->isNotEmpty()) {
                $data = $cooperativeMembers->map(function ($cooperativeMember) {
                    return [
                        'id'                         => $cooperativeMember->id,
                        'no_cooperative'             => $cooperativeMember->cooperative->no_cooperative ?? null,
                        'cooperative_name'           => $cooperativeMember->cooperative->name ?? null,
                        'member_number'              => $cooperativeMember->member_number,
                        'employee_number'            => $cooperativeMember->employee_number,
                        'internal_member_number'     => $cooperativeMember->internal_member_number,
                        'nik'                        => $cooperativeMember->nik,
                        'name'                       => $cooperativeMember->name,
                        'email'                      => $cooperativeMember->email,
                        'phone_number'               => $cooperativeMember->phone_number,
                        'address'                    => $cooperativeMember->address,
                        'city'                       => $cooperativeMember->city,
                        'postal_code'                => $cooperativeMember->postal_code,
                        'date_of_entry'              => $cooperativeMember->date_of_entry,
                        'username'                   => $cooperativeMember->username,
                        'password'                   => $cooperativeMember->password,
                        'marital_status'             => $cooperativeMember->marital_status,
                        'gender'                     => $cooperativeMember->gender,
                        'place_of_birth'             => $cooperativeMember->place_of_birth,
                        'date_of_birth'              => $cooperativeMember->date_of_birth,
                        'photo'                      => $cooperativeMember->photo,
                        'relationship_with_relative' => $cooperativeMember->relationship_with_relative,
                        'relative_phone_number'      => $cooperativeMember->relative_phone_number,
                        'group'                      => $cooperativeMember->group,
                        'mother_name'                => $cooperativeMember->mother_name,
                        'status'                     => $cooperativeMember->status,
                        'education_code'             => $cooperativeMember->education->code ?? null,
                        'education_name'             => $cooperativeMember->education->name ?? null,
                        'job_code'                   => $cooperativeMember->job->code ?? null,
                        'job_name'                   => $cooperativeMember->job->name ?? null,
                        'job_detail'                 => $cooperativeMember->job->detail ?? null,
                        'religion_name'              => $cooperativeMember->religion->name ?? null,
                    ];
                });

                $response = [
                    'code'    => 200,
                    'success' => true,
                    'message' => 'Get data cooperative member successfully!',
                    'data'    => $data
                ];
            } else {
                $response = [
                    'code'    => 404,
                    'success' => false,
                    'message' => 'Cooperative member data not found!'
                ];
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'An error occurred while retrieving cooperative member data.'
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
            'name'                       => 'required|string',
            'email'                      => 'nullable|email',
            'phone_number'               => ['nullable', 'string', 'regex:/^08[0-9]{9,}$/'],
            'address'                    => 'nullable|string',
            'city'                       => 'nullable|string',
            'postal_code'                => 'nullable|string',
            'nik'                        => 'required|string|unique:cooperative_members,nik|max:8',
            'employee_number'            => 'required|string|unique:cooperative_members,employee_number',
            'internal_member_number'     => 'required|string|unique:cooperative_members,internal_member_number',
            'date_of_entry'              => 'nullable|date',
            'username'                   => 'required|string',
            'password'                   => 'required|string',
            'marital_status'             => ['nullable', 'string', Rule::in(['MENIKAH', 'BELUM MENIKAH'])],
            'gender'                     => ['nullable', 'string', Rule::in(['LAKI-LAKI', 'PEREMPUAN'])],
            'place_of_birth'             => 'nullable|string',
            'date_of_birth'              => 'nullable|date',
            'photo'                      => 'nullable|string',
            'relationship_with_relative' => 'nullable|string',
            'relative_phone_number'      => ['nullable', 'string', 'regex:/^08[0-9]{9,}$/'],
            'group'                      => 'nullable|string',
            'mother_name'                => 'nullable|string',
            'status'                     => ['nullable', 'string', Rule::in(['OK', 'NOT OK'])],
            'address'                    => 'nullable|string',
            'education_id'               => 'nullable|exists:educations,id',
            'job_id'                     => 'nullable|exists:jobs,id',
            'cooperative_id'             => 'nullable|exists:cooperatives,id',
            'religion_id'                => 'nullable|exists:religions,id',
        ], [
            'phone_number.regex' => 'The phone number format is invalid. It should start with 08 and have at least 11 digits.',
            'relative_phone_number.regex' => 'The relative phone number format is invalid. It should start with 08 and have at least 11 digits.',
        ]);

        try {
            $cooperativeMember = new CooperativeMember();
            $cooperativeMember->name                       = $validatedData['name'];
            $cooperativeMember->email                      = $validatedData['email'] ?? null;
            $cooperativeMember->phone_number               = $validatedData['phone_number'] ?? null;
            $cooperativeMember->address                    = $validatedData['address'] ?? null;
            $cooperativeMember->city                       = $validatedData['city'] ?? null;
            $cooperativeMember->postal_code                = $validatedData['postal_code'] ?? null;
            $cooperativeMember->nik                        = $validatedData['nik'];
            $cooperativeMember->member_number              = $this->generateMemberNumber();
            $cooperativeMember->employee_number            = $validatedData['employee_number'];
            $cooperativeMember->internal_member_number     = $validatedData['internal_member_number'];
            $cooperativeMember->date_of_entry              = ($validatedData['date_of_entry']) ? date('d-m-Y', strtotime($validatedData['date_of_entry'])) : null;
            $cooperativeMember->username                   = $validatedData['username'];
            $cooperativeMember->password                   = Hash::make($validatedData['password']);
            $cooperativeMember->marital_status             = $validatedData['marital_status'] ?? null;
            $cooperativeMember->gender                     = $validatedData['gender'] ?? null;
            $cooperativeMember->place_of_birth             = $validatedData['place_of_birth'] ?? null;
            $cooperativeMember->date_of_birth              = ($validatedData['date_of_birth']) ? date('d-m-Y', strtotime($validatedData['date_of_birth'])) : null;
            $cooperativeMember->photo                      = $validatedData['photo'] ?? null;
            $cooperativeMember->relationship_with_relative = $validatedData['relationship_with_relative'] ?? null;
            $cooperativeMember->relative_phone_number      = $validatedData['relative_phone_number'] ?? null;
            $cooperativeMember->group                      = $validatedData['group'] ?? null;
            $cooperativeMember->mother_name                = $validatedData['mother_name'] ?? null;
            $cooperativeMember->status                     = $validatedData['status'] ?? null;
            $cooperativeMember->education_id               = $validatedData['education_id'] ?? null;
            $cooperativeMember->job_id                     = $validatedData['job_id'] ?? null;
            $cooperativeMember->cooperative_id             = $validatedData['cooperative_id'] ?? null;
            $cooperativeMember->religion_id                = $validatedData['religion_id'] ?? null;
            $cooperativeMember->save();

            $data = [
                'no_cooperative'            => $cooperativeMember->cooperative->no_cooperative ?? null,
                'cooperative_name'          => $cooperativeMember->cooperative->name ?? null,
                'member_number'             => $cooperativeMember->member_number,
                'employee_number'           => $cooperativeMember->employee_number,
                'internal_member_number'    => $cooperativeMember->internal_member_number,
                'nik'                       => $cooperativeMember->nik,
                'name'                      => $cooperativeMember->name,
                'email'                     => $cooperativeMember->email,
                'phone_number'              => $cooperativeMember->phone_number,
                'address'                   => $cooperativeMember->address,
                'city'                      => $cooperativeMember->city,
                'postal_code'               => $cooperativeMember->postal_code,
                'date_of_entry'             => $cooperativeMember->date_of_entry,
                'username'                  => $cooperativeMember->username,
                'password'                  => $cooperativeMember->password,
                'marital_status'            => $cooperativeMember->marital_status,
                'gender'                    => $cooperativeMember->gender,
                'place_of_birth'            => $cooperativeMember->place_of_birth,
                'date_of_birth'             => $cooperativeMember->date_of_birth,
                'photo'                     => $cooperativeMember->photo,
                'relationship_with_relative'=> $cooperativeMember->relationship_with_relative,
                'relative_phone_number'     => $cooperativeMember->relative_phone_number,
                'group'                     => $cooperativeMember->group,
                'mother_name'               => $cooperativeMember->mother_name,
                'status'                    => $cooperativeMember->status,
                'education_code'            => $cooperativeMember->education->code ?? null,
                'education_name'            => $cooperativeMember->education->name ?? null,
                'job_code'                  => $cooperativeMember->job->code ?? null,
                'job_name'                  => $cooperativeMember->job->name ?? null,
                'job_detail'                => $cooperativeMember->job->detail ?? null,
                'religion_name'             => $cooperativeMember->religion->name ?? null,
            ];

            $response = [
                'code'    => 201,
                'success' => true,
                'message' => 'Cooperative member data has been successfully created!',
                'data'    => $data
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to create cooperative member data.'
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
            'name'                       => 'required|string',
            'email'                      => 'nullable|email',
            'phone_number'               => ['nullable', 'string', 'regex:/^08[0-9]{9,}$/'],
            'address'                    => 'nullable|string',
            'city'                       => 'nullable|string',
            'postal_code'                => 'nullable|string',
            'nik'                        => 'required|string|max:8|unique:cooperative_members,nik,' . $id,
            'employee_number'            => 'required|string|unique:cooperative_members,employee_number,' . $id,
            'internal_member_number'     => 'required|string|unique:cooperative_members,internal_member_number,' . $id,
            'date_of_entry'              => 'nullable|date',
            'username'                   => 'required|string',
            'password'                   => 'required|string',
            'marital_status'             => ['nullable', 'string', Rule::in(['MENIKAH', 'BELUM MENIKAH'])],
            'gender'                     => ['nullable', 'string', Rule::in(['LAKI-LAKI', 'PEREMPUAN'])],
            'place_of_birth'             => 'nullable|string',
            'date_of_birth'              => 'nullable|date',
            'photo'                      => 'nullable|string',
            'relationship_with_relative' => 'nullable|string',
            'relative_phone_number'      => ['nullable', 'string', 'regex:/^08[0-9]{9,}$/'],
            'group'                      => 'nullable|string',
            'mother_name'                => 'nullable|string',
            'status'                     => ['nullable', 'string', Rule::in(['OK', 'NOT OK'])],
            'address'                    => 'nullable|string',
            'education_id'               => 'nullable|exists:educations,id',
            'job_id'                     => 'nullable|exists:jobs,id',
            'cooperative_id'             => 'nullable|exists:cooperatives,id',
            'religion_id'                => 'nullable|exists:religions,id',
        ], [
            'phone_number.regex' => 'The phone number format is invalid. It should start with 08 and have at least 11 digits.',
            'relative_phone_number.regex' => 'The relative phone number format is invalid. It should start with 08 and have at least 11 digits.',
        ]);

        try {
            $cooperativeMember = CooperativeMember::findOrFail($id);
            $cooperativeMember->name                       = $validatedData['name'];
            $cooperativeMember->email                      = $validatedData['email'] ?? null;
            $cooperativeMember->phone_number               = $validatedData['phone_number'] ?? null;
            $cooperativeMember->address                    = $validatedData['address'] ?? null;
            $cooperativeMember->city                       = $validatedData['city'] ?? null;
            $cooperativeMember->postal_code                = $validatedData['postal_code'] ?? null;
            $cooperativeMember->nik                        = $validatedData['nik'];
            $cooperativeMember->employee_number            = $validatedData['employee_number'];
            $cooperativeMember->internal_member_number     = $validatedData['internal_member_number'];
            $cooperativeMember->date_of_entry              = ($validatedData['date_of_entry']) ? date('d-m-Y', strtotime($validatedData['date_of_entry'])) : null;
            $cooperativeMember->username                   = $validatedData['username'];
            $cooperativeMember->password                   = Hash::make($validatedData['password']);
            $cooperativeMember->marital_status             = $validatedData['marital_status'] ?? null;
            $cooperativeMember->gender                     = $validatedData['gender'] ?? null;
            $cooperativeMember->place_of_birth             = $validatedData['place_of_birth'] ?? null;
            $cooperativeMember->date_of_birth              = ($validatedData['date_of_birth']) ? date('d-m-Y', strtotime($validatedData['date_of_birth'])) : null;
            $cooperativeMember->photo                      = $validatedData['photo'] ?? null;
            $cooperativeMember->relationship_with_relative = $validatedData['relationship_with_relative'] ?? null;
            $cooperativeMember->relative_phone_number      = $validatedData['relative_phone_number'] ?? null;
            $cooperativeMember->group                      = $validatedData['group'] ?? null;
            $cooperativeMember->mother_name                = $validatedData['mother_name'] ?? null;
            $cooperativeMember->status                     = $validatedData['status'] ?? null;
            $cooperativeMember->education_id               = $validatedData['education_id'] ?? null;
            $cooperativeMember->job_id                     = $validatedData['job_id'] ?? null;
            $cooperativeMember->cooperative_id             = $validatedData['cooperative_id'] ?? null;
            $cooperativeMember->religion_id                = $validatedData['religion_id'] ?? null;
            $cooperativeMember->save();

            $data = [
                'no_cooperative'            => $cooperativeMember->cooperative->no_cooperative ?? null,
                'cooperative_name'          => $cooperativeMember->cooperative->name ?? null,
                'member_number'             => $cooperativeMember->member_number,
                'employee_number'           => $cooperativeMember->employee_number,
                'internal_member_number'    => $cooperativeMember->internal_member_number,
                'nik'                       => $cooperativeMember->nik,
                'name'                      => $cooperativeMember->name,
                'email'                     => $cooperativeMember->email,
                'phone_number'              => $cooperativeMember->phone_number,
                'address'                   => $cooperativeMember->address,
                'city'                      => $cooperativeMember->city,
                'postal_code'               => $cooperativeMember->postal_code,
                'date_of_entry'             => $cooperativeMember->date_of_entry,
                'username'                  => $cooperativeMember->username,
                'password'                  => $cooperativeMember->password,
                'marital_status'            => $cooperativeMember->marital_status,
                'gender'                    => $cooperativeMember->gender,
                'place_of_birth'            => $cooperativeMember->place_of_birth,
                'date_of_birth'             => $cooperativeMember->date_of_birth,
                'photo'                     => $cooperativeMember->photo,
                'relationship_with_relative'=> $cooperativeMember->relationship_with_relative,
                'relative_phone_number'     => $cooperativeMember->relative_phone_number,
                'group'                     => $cooperativeMember->group,
                'mother_name'               => $cooperativeMember->mother_name,
                'status'                    => $cooperativeMember->status,
                'education_code'            => $cooperativeMember->education->code ?? null,
                'education_name'            => $cooperativeMember->education->name ?? null,
                'job_code'                  => $cooperativeMember->job->code ?? null,
                'job_name'                  => $cooperativeMember->job->name ?? null,
                'job_detail'                => $cooperativeMember->job->detail ?? null,
                'religion_name'             => $cooperativeMember->religion->name ?? null,
            ];

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Cooperative member data has been successfully updated!',
                'data'    => $data
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to update cooperative member data.'
            ];

            return response()->json($response, 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CooperativeMember  $cooperative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cooperativeMember = CooperativeMember::findOrFail($id);
            $cooperativeMember->delete();

            $response = [
                'code'    => 200,
                'success' => true,
                'message' => 'Cooperative member data has been successfully deleted!'
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'code'    => 500,
                'success' => false,
                'message' => 'Failed to delete cooperative member data.'
            ];

            return response()->json($response, 500);
        }
    }

    private function generateMemberNumber()
    {
        $dateTimePart = date('YmdHis');

        $lastRecord = CooperativeMember::latest()->first();
        if ($lastRecord) {
            $numericPart = (int)substr($lastRecord->no_cooperative, -6) + 1;
        } else {
            $numericPart = 1;
        }

        $numericPart = sprintf('%06d', $numericPart);

        $newCode = "AGT-$dateTimePart-$numericPart";

        return $newCode;
    }
}
