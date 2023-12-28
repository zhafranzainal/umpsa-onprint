<x-app-layout>

    <div class="container">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Outlet Name</th>
                    <th>Category Name</th>
                    <th>Delivery Method</th>
                    <th>Client Name</th>
                    <th>Document File</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->outlet->name }}</td>
                        <td>{{ $order->category->name }}</td>
                        <td>{{ $order->deliveryOption->name }}</td>
                        <td>{{ $order->transaction->user->name }}</td>
                        <td>{{ $order->document_file }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>RM {{ $order->total_price }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</x-app-layout>
