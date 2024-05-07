@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-header text-center bg-card-head" style="border-radius:15px 15px 0px 0px;">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div>

            <form id="jobForm">
                @csrf
                <div class="card-body">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="job_name" class="form-label">Job Name</label>
                            <input type="text" name="job_name" value="{{ $job->name ?? old('job_name') }}" class="form-control border border-secondary px-3" placeholder="Ex: Marketing" id="job_name" aria-describedby="job_name">
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="job_detail" class="form-label">Job Detail</label>
                            <input type="text" name="job_detail" value="{{ $job->detail ?? old('job_detail') }}" class="form-control border border-secondary px-3" placeholder="Ex: SD" id="job_detail" aria-describedby="job_detail">
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-card-foot mt-2 text-end" style="border-radius:0px 0px 15px 15px;">
                    <a class="btn btn-danger" href="{{ route('job.index') }}">
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
        $('#jobForm').submit(function(e) {
            e.preventDefault();

            let jobName = $('#job_name').val();
            let jobDetail = $('#job_detail').val();
            let jobId = window.location.pathname.split('/').pop();

            $.ajax({
                url: `${globalURL}/updateJob/${jobId}`,
                type: 'PATCH',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'name': jobName,
                    'detail': jobDetail,
                },
                success: function(response) {
                    alert('Data updated successfully!');
                    window.location.href = "{{ route('job.index') }}";
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
