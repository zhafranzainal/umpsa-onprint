<x-app-layout>

    <div class="container">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Campus Name</th>
                    <th>Outlet Name</th>
                    <th>Category Name</th>
                    <th>Delivery Method</th>
                    <th>Client Name</th>
                    <th>Document File</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr>

                        <td>{{ $order->id }}</td>
                        <td>{{ $order->outlet->campus->name }}</td>
                        <td>{{ $order->outlet->name }}</td>
                        <td>{{ $order->category->name }}</td>
                        <td>{{ $order->deliveryOption->name }}</td>
                        <td>{{ $order->transaction->user->name }}</td>

                        <td>
                            <a href="{{ asset('storage/documents/' . $order->document_file) }}" target="_blank">
                                <i class="fa fa-file-pdf"></i>
                                View PDF
                            </a>
                        </td>

                        <td>{{ $order->quantity }}</td>
                        <td>RM {{ $order->total_price }}</td>
                        <td>{{ $order->status }}</td>

                        <td>

                            <a href="{{ route('orders.edit', $order->id) }}">Edit</a>
                            <a href="{{ route('orders.show', $order->id) }}">View</a>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" style="cursor: pointer;"
                                    onclick="return confirm('Are you sure you want to delete this order?')">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</x-app-layout>
