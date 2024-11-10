@extends('layouts.app', ['page_title' => 'Add New User'])
@section('content')
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">User Information</h5>
            </div>
            <form action="{{ url('admin/admin-users') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.users.form')
                <div class="form-group mb-3 mx-3">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Admin\UserRequest') !!}
@endpush