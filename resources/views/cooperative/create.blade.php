@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-header text-center bg-card-head" style="border-radius:15px 15px 0px 0px;">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div>

            <form id="cooperativeForm">
                @csrf
                <div class="card-body">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="cooperative_name" class="form-label">Cooperative Name</label>
                            <input type="text" name="cooperative_name" value="{{ old('cooperative_name') }}" class="form-control border border-secondary px-3" placeholder="Ex: Koperasi 1" id="cooperative_name" aria-describedby="cooperative_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="cooperative_email" class="form-label">Cooperative Email</label>
                                <input type="email" name="cooperative_email" value="{{ old('cooperative_email') }}" class="form-control border border-secondary px-3" placeholder="Ex: jhondoe@gmail.com" id="cooperative_email" aria-describedby="cooperative_email">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="cooperative_phone" class="form-label">Cooperative Phone Number</label>
                                <input type="text" name="cooperative_phone" value="{{ old('cooperative_phone') }}" class="form-control border border-secondary px-3" placeholder="Ex: 08xxxxxxxxxx" id="cooperative_phone" aria-describedby="cooperative_phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="cooperative_city" class="form-label">Cooperative City</label>
                                <input type="text" name="cooperative_city" value="{{ old('cooperative_city') }}" class="form-control border border-secondary px-3" placeholder="Ex: Jakarta" id="cooperative_city" aria-describedby="cooperative_city">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="cooperative_postal_code" class="form-label">Cooperative Postal Code</label>
                                <input type="text" name="cooperative_postal_code" value="{{ old('cooperative_postal_code') }}" class="form-control border border-secondary px-3" placeholder="Ex: 129873" id="cooperative_postal_code" aria-describedby="cooperative_postal_code">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="cooperative_address" class="form-label">Cooperative Address</label>
                            <textarea name="cooperative_address" id="cooperative_address" class="form-control border border-secondary px-3" cols="30" rows="4" placeholder="Ex: Jl.Pahlawan"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-card-foot mt-2 text-end" style="border-radius:0px 0px 15px 15px;">
                    <a class="btn btn-danger" href="{{ route('cooperative.index') }}">
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
        $('#cooperativeForm').submit(function(e) {
            e.preventDefault();

            let cooperativeName = $('#cooperative_name').val();
            let cooperativeEmail = $('#cooperative_email').val();
            let cooperativePhone = $('#cooperative_phone').val();
            let cooperativeCity = $('#cooperative_city').val();
            let cooperativePostalCode = $('#cooperative_postal_code').val();
            let cooperativeAddress = $('#cooperative_address').val();

            $.ajax({
                url: `${globalURL}/storeCooperative`,
                type: 'POST',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'name': cooperativeName,
                    'email': cooperativeEmail,
                    'phone_number': cooperativePhone,
                    'city': cooperativeCity,
                    'postal_code': cooperativePostalCode,
                    'address': cooperativeAddress
                },
                success: function(response) {
                    alert('Data saved successfully!');
                    window.location.href = "{{ route('cooperative.index') }}";
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
