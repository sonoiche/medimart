@extends('layouts.app', ['page_title' => 'Add New User'])
@section('content')
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">User Information</h5>
            </div>
            <form action="{{ url('account', $account->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $account->id }}" />
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label for="name" class="form-label col-4">Fullname</label>
                        <div class="col-8">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $account->name ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="email" class="form-label col-4">Email Address</label>
                        <div class="col-8">
                            <input type="email" name="email" id="email" class="form-control" value="{{ $account->email ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="form-label col-4">Password</label>
                        <div class="col-8">
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password_confirmation" class="form-label col-4">Confirm Password</label>
                        <div class="col-8">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="address" class="form-label col-4">Address</label>
                        <div class="col-8">
                            <input type="text" name="address" id="address" class="form-control" value="{{ $account->address ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="city" class="form-label col-4">City</label>
                        <div class="col-8">
                            <input type="text" name="city" id="city" class="form-control" value="{{ $account->city ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="province" class="form-label col-4">Province</label>
                        <div class="col-8">
                            <input type="text" name="province" id="province" class="form-control" value="{{ $account->province ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="postal_zip" class="form-label col-4">Zip Code</label>
                        <div class="col-8">
                            <input type="text" name="postal_zip" id="postal_zip" class="form-control" value="{{ $account->postal_zip ?? '' }}" />
                        </div>
                    </div>
                </div>
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
{!! JsValidator::formRequest('App\Http\Requests\AccountRequest') !!}
@endpush