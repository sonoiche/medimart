@extends('layouts.app', ['page_title' => 'User List'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="card-title">Users</h5>
                </div>
                <div>
                    <a href="{{ url('admin/admin-users/create') }}" class="btn btn-primary">Create User</a>
                </div>
            </div>
            <div class="card-body">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ url('assets/js/datatables.js') }}"></script>
<script>
function removeUser(id) {
    if(confirm('Are you sure you want to delete this?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/admin-users') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush