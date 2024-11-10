@extends('layouts.app', ['page_title' => 'Add New Product'])
@section('content')
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Product Information</h5>
            </div>
            <form action="{{ url('client/products', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('client.products.form')
                <input type="hidden" name="id" value="{{ $product->id }}" />
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Client\ProductRequest') !!}
@endpush