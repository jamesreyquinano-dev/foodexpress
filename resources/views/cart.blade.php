<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - FoodExpress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @include('navbar')

    <div class="container py-5">
        <h2 class="mb-4 text-success fw-bold">Your Shopping Cart</h2>

        @if(empty($cart))
            <div class="alert alert-warning">Your cart is currently empty! <a href="{{ url('/#menu') }}">Go back to menu</a>.</div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm p-3">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th> </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $totalPrice += $details['price'] * $details['quantity']; @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ $details['image'] }}" width="50" height="50" class="rounded me-2" style="object-fit: cover;">
                                            <strong>{{ $details['name'] }}</strong>
                                        </td>
                                        <td>${{ number_format($details['price'], 2) }}</td>
                                        <td>{{ $details['quantity'] }}</td>
                                        <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm p-4 text-center">
                        <h4>Order Summary</h4>
                        <hr>
                        <h3 class="text-success fw-bold">${{ number_format($totalPrice, 2) }}</h3>
                        <p class="text-muted">Total Amount</p>
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100 btn-lg fw-bold text-white mt-3">Proceed to Checkout</a>
                        <a href="{{ url('/#menu') }}" class="btn btn-outline-warning w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    

</body>
</html>