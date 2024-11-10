<div class="card-body">
    <div class="form-group row mb-3">
        <label for="name" class="form-label col-4">Fullname</label>
        <div class="col-8">
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name ?? '' }}" />
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="email" class="form-label col-4">Email Address</label>
        <div class="col-8">
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}" />
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
        <label for="email" class="form-label col-4">Role</label>
        <div class="col-8">
            <select name="role" id="role" class="form-select">
                <option value="">Select Role</option>
                <option value="Customer" {{ (isset($user->role) && $user->role == 'Customer') ? 'selected' : '' }}>Customer</option>
                <option value="Admin" {{ (isset($user->role) && $user->role == 'Admin') ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="address" class="form-label col-4">Address</label>
        <div class="col-8">
            <input type="text" name="address" id="address" class="form-control" value="{{ $user->address ?? '' }}" />
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="city" class="form-label col-4">City</label>
        <div class="col-8">
            <input type="text" name="city" id="city" class="form-control" value="{{ $user->city ?? '' }}" />
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="province" class="form-label col-4">Province</label>
        <div class="col-8">
            <input type="text" name="province" id="province" class="form-control" value="{{ $user->province ?? '' }}" />
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="postal_zip" class="form-label col-4">Zip Code</label>
        <div class="col-8">
            <input type="text" name="postal_zip" id="postal_zip" class="form-control" value="{{ $user->postal_zip ?? '' }}" />
        </div>
    </div>
</div>