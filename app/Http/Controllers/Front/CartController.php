<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\CartRepositoryModel;

class CartController extends Controller
{
    protected $repository;
    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repository = $this->repository;
        return view("front.cart",compact("repository"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id",
            "quantity" => "required|numeric|min:1",
        ]);
        $product=Product::find($request->product_id);
        $this->repository->addToCart($product, $request->quantity);
        return redirect()->back()->with("success","Product added to cart");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $request->validate([
            "product_id" => "required|exists:products,id",
            "qty" => "required|numeric|min:1",
        ]);
        $product=Product::find($request->product_id);
        $this->repository->updateCart($product, $request->qty);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->repository->deleteFromCart($id);
        return redirect()->back()->with("success","Product deleted from cart");
    }
}
