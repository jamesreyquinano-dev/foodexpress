<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
 </head>
<body class="bg-light">

@include('navbar')

     <section id="home" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-3 fw-bold text-success">Fresh Food, Fast Delivery.</h1>
                <p class="lead">Experience the best healthy meals prepared with love, delivered straight to your doorstep.</p>
                <a href="#menu" class="btn btn-warning btn-lg">Order Now</a>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80" class="img-fluid rounded" alt="Delicious Food">
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 display-4 fw-bold text-success">About Us</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=600&q=80" class="img-fluid rounded" alt="About Us">
            </div>
            <div class="col-md-6">
                <h2 class="text-warning">Our Mission</h2>
                <p>At FoodExpress, we believe that eating healthy should be easy, affordable, and delicious. We source fresh ingredients daily to ensure you get the best quality nutrition in every bite.</p>
            </div>
        </div>
    </div>
</section>

<section id="menu" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 display-4 fw-bold text-success">Our Healthy Menu</h2>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://bakeitwithlove.com/wp-content/uploads/2024/07/green-garden-salad-sq1-720x720.jpg" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Garden Fresh Salad</h5>
                        <p class="card-text">Fresh crisp greens with organic nuts and balsamic dressing.</p>
                        <p class="fw-bold">$12.99</p>
                        
                        <form action="{{ route('cart.add', 1) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-warning">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Place Order</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=300&q=80" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Grilled Salmon</h5>
                        <p class="card-text">Wild-caught salmon with steamed asparagus and lemon zest.</p>
                        <p class="fw-bold">$18.50</p>
                        
                        <form action="{{ route('cart.add', 2) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-warning">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Place Order</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=300&q=80" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Quinoa Power Bowl</h5>
                        <p class="card-text">Protein-packed quinoa with roasted chickpeas and kale.</p>
                        <p class="fw-bold">$14.00</p>
                        
                        <form action="{{ route('cart.add', 3) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-warning">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Place Order</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1525351484163-7529414344d8?w=300&q=80" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Avocado Toast</h5>
                        <p class="card-text">Multigrain bread topped with smashed avocado and seeds.</p>
                        <p class="fw-bold">$9.99</p>
                        
                        <form action="{{ route('cart.add', 4) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-warning">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Place Order</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://nutribulletmexico.com/storage/elementor/thumbs/strawberry-banana-smoothie-2021-08-26-23-04-07-utc-qb9cforqpx3p0ju66jh0jod1qvyysszi643sndy168.webp" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Smoothie Blast</h5>
                        <p class="card-text">Mixed berries, banana, and chia seeds for a boost.</p>
                        <p class="fw-bold">$7.50</p>
                        
                        <form action="{{ route('cart.add', 5) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-warning">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Place Order</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1488477181946-6428a0291777?w=300&q=80" class="card-img-top" style="height: 200px; width: 100%; object-fit: cover;" alt="Food">
                    <div class="card-body">
                        <h5 class="card-title">Berry Parfait</h5>
                        <p class="card-text">Greek yogurt layered with granola and fresh blueberries.</p>
                        <p class="fw-bold">$8.00</p>
                        
                        <form action="{{ route('cart.add', 6) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-100 mb-2 btn btn-warning">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">Place Order</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('footer')

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>