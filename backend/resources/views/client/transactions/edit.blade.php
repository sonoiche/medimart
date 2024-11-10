@extends('layouts.app', ['page_title' => 'Update Transaction'])
@section('content')
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update Transaction</h5>
            </div>
            <form action="{{ url('client/transactions', $transaction->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="id" value="{{ $transaction->id }}" />
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Client\TransactionRequest') !!}
@endpush