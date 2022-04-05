@extends('layout.app')
@section('title', 'My Orders')

@section('content')
    <?php $status = ['pending', 'processing', 'completed', 'cancelled'];  ?>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-10 offset-md-1">
            <div class="row justify-content-end">
                <div class="col-6 col-md-2">
                    <select class="form-select" width="300px" name="status">
                        @foreach($status as $stat)
                            <option value="{{ $stat }}">{{ $stat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if(count($orders) == 0)
                <div class="alert alert-danger">
                    <strong>No orders found</strong>
                </div>
            @else
                <div class="table-responsive-xl">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">ShippingPrice</th>
                            <th scope="col">Total</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $order->product->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/products/'.$order->product->image) }}" alt="{{ $order->product->name }}" width="200px">
                                    </td>
                                    <td>{{$order->product->price }}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>Rs 50</td>
                                    <td>Rs {{ $order->total }}</td>
                                    <td>{{ $order->location }} </td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                                        @endif
                                        @if($order->status != 'completed' && $order->status != 'cancelled')
                                            <a href="{{ route('order.cancel', $order->id) }}" class="btn btn-danger">Cancel</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('select').on('change', function () {
                var status = $(this).val();
                var url = "{{ route('order.my-orders', ["status" => 'temp']) }}";
                url = url.replace('temp', status);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        renderTable(response);
                    }
                });

            });
        });

        function renderTable(data)
        {
            if(data.length === 0)
            {
                $('table tbody').html('<tr><td colspan="9" class="text-center text-danger">No orders found</td></tr>');

            }
            else
            {
                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr>';
                    html += '<th scope="row">' + (index + 1) + '</th>';
                    html += '<td>' + value.product.name + '</td>';
                    html += '<td>' + `<img src="{{asset('storage/products') }}/` + value["product"].image + `" width='200px'></td>`;
                    html += '<td>' + value.product.price + '</td>';
                    html += '<td>' + value.quantity + '</td>';
                    html += '<td>' + 50 + '</td>';
                    html += '<td> Rs' + (value.product.price * value.quantity + 50) + '</td>';
                    html += '<td>' + value.location + '</td>';
                    html += '<td>' + renderAction(value) + '</td>';
                    html += '</tr>';
                });
                $('tbody').html(html);
            }

        }

        function renderAction(order)
        {
            let html = '';
            if(order.status == 'pending')
               html += `<a href="/order/${order.id}/edit" class="btn btn-primary">Edit</a>`
            if(order.status !== 'cancelled' && order.status !=="completed" )
               html += `<a href="/order/${order.id}/cancel" class="btn btn-danger">Cancel</a>`

            return html;
        }
    </script>

@endsection
