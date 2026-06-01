<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import your database models here
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function addToCart(Request $request, string $id)
    {
        $foodMenu = [
            1 => ["name" => "Garden Fresh Salad", "price" => 12.99, "image" => "https://bakeitwithlove.com/wp-content/uploads/2024/07/green-garden-salad-sq1-720x720.jpg"],
            2 => ["name" => "Grilled Salmon", "price" => 18.50, "image" => "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2"],
            3 => ["name" => "Quinoa Power Bowl", "price" => 14.00, "image" => "https://images.unsplash.com/photo-1512621776951-a57141f2eefd"],
            4 => ["name" => "Avocado Toast", "price" => 9.99, "image" => "https://images.unsplash.com/photo-1525351484163-7529414344d8"],
            5 => ["name" => "Smoothie Blast", "price" => 7.50, "image" => "https://nutribulletmexico.com/storage/elementor/thumbs/strawberry-banana-smoothie-2021-08-26-23-04-07-utc-qb9cforqpx3p0ju66jh0jod1qvyysszi643sndy168.webp"],
            6 => ["name" => "Berry Parfait", "price" => 8.00, "image" => "https://images.unsplash.com/photo-1488477181946-6428a0291777"]
        ];

        if (!isset($foodMenu[$id])) {
            return redirect()->back()->with('error', 'Item not found!');
        }

        $item = $foodMenu[$id];
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $item['name'],
                "quantity" => 1,
                "price" => $item['price'],
                "image" => $item['image']
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->withFragment('menu')->with('success', $item['name'] . ' added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function viewCheckout()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        // 1. Validate form information
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        // 2. Calculate the total bill layout
        $totalPrice = 0;
        foreach($cart as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        // 3. Save details into the main 'orders' table
        $order = new Order();
        $order->customer_name = $request->name;
        $order->phone_number = $request->phone;
        $order->delivery_address = $request->address;
        $order->payment_method = $request->payment_method;
        $order->total_price = $totalPrice;
        $order->save(); // Generates the order ID automatically in MySQL

        // 4. Save every item from the cart breakdown into 'order_items' table
        foreach($cart as $id => $details) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id; // Ties this item row to the main parent order container
            $orderItem->food_name = $details['name'];
            $orderItem->quantity = $details['quantity'];
            $orderItem->price = $details['price'];
            $orderItem->save();
        }

        // 5. Clear the session cart back to zero
        session()->forget('cart');

        // 6. Direct user back home with a success confirmation banner
        return redirect('/')->with('success', 'Thank you! Your order has been placed and saved successfully.');
    }

    // Add "string" right before $id
public function removeFromCart(string $id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item removed from cart successfully!');
}

}

