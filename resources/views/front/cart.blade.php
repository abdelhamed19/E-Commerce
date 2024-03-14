<x-Front-Layout title="Cart">
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <x-alret type="success" />
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->
                @unless ($repository->getCart()->isEmpty())
                    @foreach ($repository->getCart() as $item)
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-1 col-12">
                                    <a href="{{ route('front.products.show', $item->product->slug) }}"><img
                                            src="{{ $item->product->image_url }}" alt="#"></a>
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <h5 class="product-name"><a
                                            href="{{ route('front.products.show', $item->product->slug) }}">
                                            {{ $item->product->name }}</a></h5>
                                    <p class="product-des">
                                        <span><em>Type:</em> Mirrorless</span>
                                        <span><em>Color:</em> Black</span>
                                    </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="count-input">
                                        <form action="{{ route("cart.update",$item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input name="quantity" type="number" value="{{ $item->quantity }}">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p class="item-price">{{ Currency::format($item->product->price * $item->quantity) }}</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>{{ Currency::format($item->product->Compare_Price - $item->product->price) }}</p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <form action="{{ route('cart.destroy', $item->product->id) }}" method="Post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-item"><i class="lni lni-close"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Single List list -->
                    @endforeach
                @else
                    <div>
                        <br>
                        <h6 class="text-center">No Items In Cart <a class="text-success" href="{{ route("home") }}">Add items here</a></h6>
                    </div>
                @endunless
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>{{ $repository->total() }}</span></li>
                                        <li>Shipping<span>0</span></li>
                                        <li>You Save<span>0</span></li>
                                        <li class="last">You Pay<span>{{ $repository->total() }}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout.create') }}" class="btn">Checkout</a>
                                        <a href="{{ route("home") }}" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
</x-Front-Layout>
