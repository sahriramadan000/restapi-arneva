@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-header text-center bg-card-head" style="border-radius:15px 15px 0px 0px;">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div>

            <form id="religionForm">
                @csrf
                <div class="card-body">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="religion_name" class="form-label">Religion Name</label>
                            <input type="text" name="religion_name" value="{{ $religion->name ?? old('religion_name') }}" class="form-control border border-secondary px-3" placeholder="Ex: Islam" id="religion_name" aria-describedby="religion_name">
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-card-foot mt-2 text-end" style="border-radius:0px 0px 15px 15px;">
                    <a class="btn btn-danger" href="{{ route('religion.index') }}">
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
        $('#religionForm').submit(function(e) {
            e.preventDefault();

            let religionName = $('#religion_name').val();
            let religionId = window.location.pathname.split('/').pop();

            $.ajax({
                url: `${globalURL}/updateReligion/${religionId}`,
                type: 'PATCH',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'name': religionName
                },
                success: function(response) {
                    alert('Data updated successfully!');
                    window.location.href = "{{ route('religion.index') }}";
                },
                error: function(xhr, status, error) {
                    alert('Failed to update data!');
                    console.error('Failed to update data: ', error);
                }
            });
        });
    });

</script>
@endpush
