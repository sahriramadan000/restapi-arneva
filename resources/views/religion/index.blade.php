@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-3 d-flex align-items-center justify-content-between">
                    <h6 class="text-white text-capitalize ps-3">{{ $page_title }} table</h6>
                    <a href="{{ route('religion.create') }}" class="btn btn-sm bg-success text-white me-3 mb-0">Add Data</a>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" width="15%">Religion Code</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Religion Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="data-religion">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('bottom-js')
    <script>
        getData();

        function getData() {
            $.ajax({
                url: `${globalURL}/getReligion`,
                type: 'GET',
                data: {},
                success: function(response) {
                    console.log(response);
                    $('#data-religion').empty();

                    $.each(response.data, function(index, dt) {
                        var editUrl = "{{ route('religion.edit', ':id') }}".replace(':id', dt.id);
                        var deleteUrl = `${globalURL}/deleteReligion/${dt.id}`;
                        var addList = `<tr>`+
                                            `<td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold align-middle">${index+1}</span></td>`+
                                            `<td><span class="text-secondary text-xs font-weight-bold align-middle">${dt.code}</span></td>`+
                                            `<td><span class="text-secondary text-xs font-weight-bold align-middle">${dt.name}</span></td>`+
                                            `<td>
                                                <a href="${editUrl}" class="btn btn-sm bg-warning text-white">Edit</a>
                                                <button onclick="confirmDelete(${dt.id}, '${deleteUrl}')" class="btn btn-sm bg-danger text-white">Delete</button>
                                            </td>`+
                                        `</tr>`;

                        $('#data-religion').append(addList);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Failed to load religion data!')
                }
            });
        }
    </script>
@endpush
