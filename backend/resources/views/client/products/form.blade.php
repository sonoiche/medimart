<div class="card-body">
    <div class="form-group row mb-3">
        <label for="title" class="form-label col-4">Product Title</label>
        <div class="col-8">
            <input type="text" name="title" id="title" class="form-control" value="{{ $product->title ?? '' }}" />
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea name="description" id="description" style="width: 100%" rows="5" class="form-control">{{ $product->description ?? '' }}</textarea>
    </div>
    <div class="form-group row mb-3">
        <label for="price" class="form-label col-4">Product Price</label>
        <div class="col-8">
            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price ?? '' }}" />
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="photo" class="form-label col-4">Product Photo</label>
        <div class="col-8">
            <input type="file" name="photo" id="photo" class="form-control" />
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="status" class="form-label col-4">Status</label>
        <div class="col-8">
            <select name="status" id="status" class="form-select">
                <option value="">Select Status</option>
                <option value="In Stock" {{ (isset($product->status) && $product->status == 'In Stock') ? 'selected' : '' }}>In Stock</option>
                <option value="Out of Stock" {{ (isset($product->status) && $product->status == 'Out of Stock') ? 'selected' : '' }}>Out of Stock</option>
            </select>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </div>
</div>