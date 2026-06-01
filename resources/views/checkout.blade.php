<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - FoodExpress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @include('navbar')

    <div class="container py-5">
        <h2 class="mb-5 text-success fw-bold text-center">Secure Checkout</h2>

        @if(empty($cart))
            <div class="alert alert-warning text-center">
                Your cart is empty! <a href="{{ url('/#menu') }}">Go back to the menu</a> to add items before checking out.
            </div>
        @else
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="card shadow-sm p-4 border-0">
                        <h4 class="mb-4 text-secondary">Delivery Information</h4>
                        
                        <form action="{{ route('order.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="09123456789" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Delivery Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="House Number, Street Name, Barangay, City" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="Cash on Delivery">Cash on Delivery (COD)</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">Confirm & Place Order</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card shadow-sm p-4 border-0 bg-white">
                        <h4 class="mb-4 text-secondary">Your Order</h4>
                        <hr>

                        @php $totalPrice = 0; @endphp
                        @foreach($cart as $id => $details)
                            @php $totalPrice += $details['price'] * $details['quantity']; @endphp
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $details['image'] }}" width="45" height="45" class="rounded me-3" style="object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $details['name'] }}</h6>
                                        <small class="text-muted">Qty: {{ $details['quantity'] }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-dark">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </div>
                        @endforeach

                        <hr>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="fw-bold">Total Amount:</h5>
                            <h4 class="text-success fw-bold">${{ number_format($totalPrice, 2) }}</h4>
                        </div>
                        
                        <a href="{{ route('cart.view') }}" class="btn btn-outline-warning w-100 mt-4 btn-sm">Edit Cart Items</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

   

</body>
</html>