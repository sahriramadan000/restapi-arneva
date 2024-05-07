@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-header text-center bg-card-head" style="border-radius:15px 15px 0px 0px;">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div>

            <form id="cooperativeMemberForm">
                @csrf
                <div class="card-body">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $cooperativeMember->name }}" class="form-control border border-secondary px-3" placeholder="Enter name" id="name" aria-describedby="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $cooperativeMember->email }}" class="form-control border border-secondary px-3" placeholder="Enter email" id="email" aria-describedby="email">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ $cooperativeMember->phone_number }}" class="form-control border border-secondary px-3" placeholder="Enter phone number" id="phone_number" aria-describedby="phone_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" value="{{ $cooperativeMember->nik }}" class="form-control border border-secondary px-3" placeholder="Enter NIK" id="nik" aria-describedby="nik">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="employee_number" class="form-label">Employee Number</label>
                                <input type="text" name="employee_number" value="{{ $cooperativeMember->employee_number }}" class="form-control border border-secondary px-3" placeholder="Enter employee number" id="employee_number" aria-describedby="employee_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="internal_member_number" class="form-label">Internal Member Number</label>
                                <input type="text" name="internal_member_number" value="{{ $cooperativeMember->internal_member_number }}" class="form-control border border-secondary px-3" placeholder="Enter internal member number" id="internal_member_number" aria-describedby="internal_member_number">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="date_of_entry" class="form-label">Date of Entry</label>
                                <input type="date" name="date_of_entry" value="{{ $cooperativeMember->date_of_entry }}" class="form-control border border-secondary px-3" id="date_of_entry" aria-describedby="date_of_entry">
                            </div>
                        </div>
                    </div>
                    <!-- Additional Fields -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" value="{{ $cooperativeMember->username }}" class="form-control border border-secondary px-3" placeholder="Enter username" id="username" aria-describedby="username">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" value="{{ $cooperativeMember->password }}" class="form-control border border-secondary px-3" placeholder="Enter password" id="password" aria-describedby="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="marital_status" class="form-label">Marital Status</label>
                                <select name="marital_status" class="form-control border border-secondary px-3" id="marital_status">
                                    <option value="MENIKAH" {{ $cooperativeMember->marital_status == 'MENIKAH' ? 'selected' : '' }}>MENIKAH</option>
                                    <option value="BELUM MENIKAH" {{ $cooperativeMember->marital_status == 'BELUM MENIKAH' ? 'selected' : '' }}>BELUM MENIKAH</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-control border border-secondary px-3" id="gender">
                                    <option value="LAKI-LAKI" {{ $cooperativeMember->gender == 'LAKI-LAKI' ? 'selected' : '' }}>LAKI-LAKI</option>
                                    <option value="PEREMPUAN" {{ $cooperativeMember->gender == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="place_of_birth" class="form-label">Place of Birth</label>
                                <input type="text" name="place_of_birth" value="{{ $cooperativeMember->place_of_birth }}" class="form-control border border-secondary px-3" placeholder="Enter place of birth" id="place_of_birth" aria-describedby="place_of_birth">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ $cooperativeMember->date_of_birth }}" class="form-control border border-secondary px-3" id="date_of_birth" aria-describedby="date_of_birth">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="text" name="photo" id="photo" value="{{ $cooperativeMember->photo }}" class="form-control border border-secondary px-3" id="photo" placeholder="Enter url photo" aria-describedby="photo">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="relationship_with_relative" class="form-label">Relationship with Relative</label>
                                <input type="text" name="relationship_with_relative" value="{{ $cooperativeMember->relationship_with_relative }}" class="form-control border border-secondary px-3" placeholder="Enter relationship with relative" id="relationship_with_relative" aria-describedby="relationship_with_relative">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="relative_phone_number" class="form-label">Relative Phone Number</label>
                                <input type="text" name="relative_phone_number" value="{{ $cooperativeMember->relative_phone_number }}" class="form-control border border-secondary px-3" placeholder="Enter relative phone number" id="relative_phone_number" aria-describedby="relative_phone_number">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="group" class="form-label">Group</label>
                                <input type="text" name="group" value="{{ $cooperativeMember->group }}" class="form-control border border-secondary px-3" placeholder="Enter group" id="group" aria-describedby="group">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="mother_name" class="form-label">Mother's Name</label>
                                <input type="text" name="mother_name" value="{{ $cooperativeMember->mother_name }}" class="form-control border border-secondary px-3" placeholder="Enter mother's name" id="mother_name" aria-describedby="mother_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control border border-secondary px-3" id="status">
                                    <option value="OK" {{ $cooperativeMember->status == 'OK' ? 'selected' : '' }}>OK</option>
                                    <option value="NOT OK" {{ $cooperativeMember->status == 'NOT OK' ? 'selected' : '' }}>NOT OK</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control border border-secondary px-3" cols="30" rows="4" placeholder="Enter address">{{ $cooperativeMember->address }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="education_id" class="form-label">Education</label>
                                <select name="education_id" id="education_id" class="form-control border border-secondary px-3">
                                    <option value="">Select Education</option>
                                    @foreach($educations as $education)
                                        <option value="{{ $education->id }}" {{ $cooperativeMember->education_id == $education->id ? 'selected' : '' }}>
                                            {{ $education->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="job_id" class="form-label">Job</label>
                                <select name="job_id" id="job_id" class="form-control border border-secondary px-3">
                                    <option value="">Select Job</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->id }}" {{ $cooperativeMember->job_id == $job->id ? 'selected' : '' }}>
                                            {{ $job->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="cooperative_id" class="form-label">Cooperative ID</label>
                                <select name="cooperative_id" id="cooperative_id" class="form-control border border-secondary px-3">
                                    <option value="">Select Cooperative</option>
                                    @foreach($cooperatives as $cooperative)
                                        <option value="{{ $cooperative->id }}" {{ $cooperativeMember->cooperative_id == $cooperative->id ? 'selected' : '' }}>
                                            {{ $cooperative->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="religion_id" class="form-label">Religion ID</label>
                                <select name="religion_id" id="religion_id" class="form-control border border-secondary px-3">
                                    <option value="">Select Religion</option>
                                    @foreach($religions as $religion)
                                        <option value="{{ $religion->id }}" {{ $cooperativeMember->religion_id == $religion->id ? 'selected' : '' }}>
                                            {{ $religion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-card-foot mt-2 text-end" style="border-radius:0px 0px 15px 15px;">
                    <a class="btn btn-danger" href="{{ route('cooperative-member.index') }}">
                        Back
                    </a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('bottom-js')
<script>
    $(document).ready(function() {
        $('#cooperativeMemberForm').submit(function(e) {
            e.preventDefault();

            let name = $('#name').val();
            let email = $('#email').val();
            let phoneNumber = $('#phone_number').val();
            let nik = $('#nik').val();
            let employeeNumber = $('#employee_number').val();
            let internalMemberNumber = $('#internal_member_number').val();
            let dateOfEntry = $('#date_of_entry').val();
            let username = $('#username').val();
            let password = $('#password').val();
            let maritalStatus = $('#marital_status').val();
            let gender = $('#gender').val();
            let placeOfBirth = $('#place_of_birth').val();
            let dateOfBirth = $('#date_of_birth').val();
            let photo = $('#photo').val();
            let relationshipWithRelative = $('#relationship_with_relative').val();
            let relativePhoneNumber = $('#relative_phone_number').val();
            let group = $('#group').val();
            let motherName = $('#mother_name').val();
            let status = $('#status').val();
            let address = $('#address').val();
            let educationId = $('#education_id').val();
            let jobId = $('#job_id').val();
            let cooperativeId = $('#cooperative_id').val();
            let religionId = $('#religion_id').val();
            let cooperativeMemberId = window.location.pathname.split('/').pop();

            $.ajax({
                url: `${globalURL}/updateCooperativeMember/${cooperativeMemberId}`,
                type: 'PATCH',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'name': name,
                    'email': email,
                    'phone_number': phoneNumber,
                    'nik': nik,
                    'employee_number': employeeNumber,
                    'internal_member_number': internalMemberNumber,
                    'date_of_entry': dateOfEntry,
                    'username': username,
                    'password': password,
                    'marital_status': maritalStatus,
                    'gender': gender,
                    'place_of_birth': placeOfBirth,
                    'date_of_birth': dateOfBirth,
                    'photo': photo,
                    'relationship_with_relative': relationshipWithRelative,
                    'relative_phone_number': relativePhoneNumber,
                    'group': group,
                    'mother_name': motherName,
                    'status': status,
                    'address': address,
                    'education_id': educationId,
                    'job_id': jobId,
                    'cooperative_id': cooperativeId,
                    'religion_id': religionId
                },
                success: function(response) {
                    alert('Data saved successfully!');
                    window.location.href = "{{ route('cooperative-member.index') }}";
                },
                error: function(xhr, status, error) {
                    alert('Failed to save data!');
                    console.error('Failed to save data: ', error);
                }
            });
        });
    });

</script>
@endpush
