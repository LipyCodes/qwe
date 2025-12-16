@extends('admin.maindesign')

@section('dashboard') <div class="container-fluid">
    <div class="block margin-bottom-sm">
        <div class="title"><strong>All Orders</strong></div>
        <div class="table-responsive"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product(s)</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->rec_address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            @foreach($order->orderItems as $item)
                                @if($item->product)
                                    <div>
                                        {{ $item->product->product_title }} 
                                        (x{{ $item->quantity }})
                                    </div>
                                @else
                                    <div style="color:red;">Product Deleted</div>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @php
                                $total = 0;
                                foreach($order->orderItems as $item) {
                                    $total += $item->price * $item->quantity;
                                }
                            @endphp
                            ₱{{ $total }}
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection