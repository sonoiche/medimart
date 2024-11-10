@extends('layouts.app', ['page_title' => 'My Orders'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">My Orders</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date Order</th>
                            <th>Order Number</th>
                            <th>Herbal Item</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $key => $order)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $order->created_date }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->product->name ?? '' }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection