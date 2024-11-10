@extends('layouts.app', ['page_title' => 'Transactions List'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">My Transactions</h5>
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
function removeTransaction(id) {
    if(confirm('Are you sure you want to delete this?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('client/transactions') }}/" + id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush