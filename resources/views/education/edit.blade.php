@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-header text-center bg-card-head" style="border-radius:15px 15px 0px 0px;">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div>

            <form id="educationForm">
                @csrf
                <div class="card-body">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="education_name" class="form-label">Education Name</label>
                            <input type="text" name="education_name" value="{{ $education->name ?? old('education_name') }}" class="form-control border border-secondary px-3" placeholder="Ex: SD" id="education_name" aria-describedby="education_name">
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-card-foot mt-2 text-end" style="border-radius:0px 0px 15px 15px;">
                    <a class="btn btn-danger" href="{{ route('education.index') }}">
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
        $('#educationForm').submit(function(e) {
            e.preventDefault();

            let educationName = $('#education_name').val();
            let educationId = window.location.pathname.split('/').pop();

            $.ajax({
                url: `${globalURL}/updateEducation/${educationId}`,
                type: 'PATCH',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'name': educationName
                },
                success: function(response) {
                    alert('Data updated successfully!');
                    window.location.href = "{{ route('education.index') }}";
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
