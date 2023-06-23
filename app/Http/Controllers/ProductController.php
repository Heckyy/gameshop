<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;

class ProductController extends Controller
{
    //
    function index()
    {
        $data = Product::all();

        return view('product', ['products' => $data]);
    }
    function detail($id)
    {
        $data = Product::find($id);
        return view('detail', ['product' => $data]);
    }
    function search(Request $req)
    {
        $data = Product::where('name', 'like', '%' . $req->input('query') . '%')
            ->get();
        return view('search', ['products' => $data]);
    }
    function addToCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }
    static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }
    function cartList()
    {
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();

        return view('cartlist', ['products' => $products]);
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    function orderNow()
    {
        $userId = Session::get('user')['id'];
        $total = $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        return view('ordernow', ['total' => $total]);
    }
    // function orderPlace(Request $req)
    // {
    //     $userId=Session::get('user')['id'];
    //     $allCart =Cart::where('user_id',$userId)->get();
    //     foreach($allCart as $cart)
    //     {
    //         $order = new Order;
    //         $order -> product_id=$cart['product_id'];
    //         $order -> user_id=$cart['user_id'];
    //         $order -> status="pending";
    //         $order -> payment_method=$req->payment;
    //         $order -> payment_status="pending";
    //         $order -> address=$req->address;
    //         $order -> save();
    //         Cart::where('user_id',$userId)->delete();
    //     }
    //     $req->input();
    //     return redirect('/');
    // }
    function orderPlace(Request $req)
    {
        $userId = Session::get('user')['id'];
        $allCart = Cart::where('user_id', $userId)->get();
        foreach ($allCart as $cart) {
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status = "pending";
            $order->payment_method = $req->payment;
            $order->payment_status = "pending";
            $order->address = $req->address;

            // Store the proof of payment
            if ($req->hasFile('proof')) {
                $proof = $req->file('proof');
                $proofPath = $proof->store('public/proofs');
                $proofPath = str_replace('public/', 'storage/', $proofPath);
                $order->proof = $proofPath;
            }
            $order->save();
            Cart::where('user_id', $userId)->delete();
        }
        return redirect('/');
    }
    function myOrders()
    {

        $userId = Session::get('user')['id'];

        $user = User::where(['email' => "riga@gmail.com"])->first();
        // var_dump($user);

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->select('orders.*', 'products.name', 'products.gallery', 'orders.proof', 'products.created_by')
            ->get();
        // dd($orders);
        return view('myorders', ['orders' => $orders]);
    }
    function myOrdersAdmin()
    {

        $userId = Session::get('user')['id'];

        $user = User::where(['email' => "riga@gmail.com"])->first();


        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', "users.id")
            ->select('orders.*', 'products.name', 'products.gallery', 'orders.proof', 'products.created_by', 'users.name AS buyer_name')
            ->get();
        // var_dump($orders);
        // dd($orders);
        return view('allorders', ['orders' => $orders]);
    }

    function editOrder(Request $request)
    {

        // $userId = Session::get('user')['id'];
        $userId = Session::get('user')['id'];
        $dbUser = DB::table("users")->where('id', '=', $userId)->get();
        $idOrder = $_POST['idOrder'];
        $statusPayment = $_POST['paymentStatus'];
        $result = DB::table('orders')
            ->where("id", "=", $idOrder)
            ->update(
                [

                    "payment_status" => $statusPayment,
                    "status" => $statusPayment,
                ]

            );
        echo $result;
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'gallery' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $created_by = session('user');
        $seller_name = $created_by['name'];

        // Store the image in the public directory
        $imageName = basename($request->file('gallery')->getClientOriginalName());

        $imagePath = $request->file('gallery')->storeAs('public/images', $imageName);
        $imageName = basename($imagePath);
        // Create a new product instance
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->category = $validatedData['category'];
        $product->description = $validatedData['description'];
        $product->gallery = $imageName; // Updated column name
        $product->created_by = $seller_name; // Updated column name
        $product->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Product created successfully.');
    }

    public function storeOrder(Request $request)
    {
        // Validate the form data

        // Store the proof of payment
        if ($request->hasFile('proof')) {
            $proof = $request->file('proof');
            $proofPath = $proof->store('public/proofs');
            $proofPath = str_replace('public/', '', $proofPath);
            // Save the $proofPath to your order or database record
            $order = new Order;
            $order->proof = $proofPath;
            $order->save();
        }

        // Process the order and other form data

        return redirect()->back()->with('success', 'Payment Proof successfully uploaded');
        // Redirect or return a response
    }
}
