    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                            <li><i class="fa fa-envelope"></i> youremail@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            @auth
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="{{ route('card.page') }}">Cart</a></li>
                                    <li><a href="{{ route('customer.checkoutPage') }}">Checkout</a></li>
                                    <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                </ul>
                            </li>

                            @endauth
                            @guest

                            <li><a href="{{ route('login.page') }}">Login </a></li>
                            <li><a href="{{ route('register.page') }}">Register </a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/frontend') }}/images/logo.png" alt="">
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('aboutPage') }}">About</a></li>
                                <li>
                                    <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="{{ route('shop.page') }}">Shop Page</a></li>
                                        <li><a href="{{ route('card.page') }}">Shopping cart</a></li>
                                        <li><a href="{{ route('customer.checkoutPage') }}">Checkout</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Pages <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="{{ route('aboutPage') }}">About Page</a></li>
                                        <li><a href="{{ route('card.page') }}">Shopping cart</a></li>
                                        <li><a href="{{ route('customer.checkoutPage') }}">Checkout</a></li>
                                        <li><a href="{{ route('faqPage') }}">FAQ</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('contactPage') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>

                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>3</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @php
                                        $carts=\Gloudemans\Shoppingcart\Facades\Cart::content();
                                        $total_price=\Gloudemans\Shoppingcart\Facades\Cart::subtotal();
                                    @endphp
                                    @foreach ($carts as $item)

                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{ asset('uploads/product_photo') }}/{{ $item->options->product_image }}" class="img-fluid rounded " style="width:60px;" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ route('card.page') }}">{{ $item->name }}</a>
                                            <span>{{ $item->qty }}</span>
                                            <p>{{ $item->qty*$item->price }}</p>
                                            <a href="{{ route('removeFrom.card',['card_id'=>$item->rowId]) }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach
                                    <li>Subtotol: <span class="pull-right">{{ $total_price }}</span></li>
                                    <li>
                                        <a href="{{ route('customer.checkoutPage') }}">
                                            <button class="btn btn-danger">Check Out</button>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('aboutPage') }}">About</a></li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('shop.page') }}">Shop Page</a></li>
                                        <li><a href="{{ route('card.page') }}">Shopping cart</a></li>
                                        <li><a href="{{ route('customer.checkoutPage') }}">Checkout</a></li>
                                    </ul>
                                </li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                                    <ul aria-expanded="false">
                                      <li><a href="{{ route('aboutPage') }}">About Page</a></li>
                                      <li><a href="{{ route('card.page') }}">Shopping cart</a></li>
                                      <li><a href="{{ route('customer.checkoutPage') }}">Checkout</a></li>
                                      <li><a href="{{ route('faqPage') }}">FAQ</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('contactPage') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->
