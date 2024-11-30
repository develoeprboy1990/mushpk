    <div class="middle-inner">

        <div class="container">

            <div class="row">

                <div class="col-lg-2 col-md-2 col-12">

                    <!-- Logo -->

                    <div class="logo">

                        @php

                            $settings=DB::table('settings')->get();

                        @endphp                    

                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{asset($data->logo)}} @endforeach" alt="logo"></a>

                    </div>

                    <!--/ End Logo -->

                    <!-- Search Form -->

                    <div class="search-top">

                        <div class="top-search"><a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a></div>
                        <!--<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>


                        <div class="search-top">

                            <form class="search-form">

                                <input type="text" placeholder="Search here..." name="search">

                                <button value="search" type="submit"><i class="ti-search"></i></button>

                            </form>

                        </div>-->

                        <!--/ End Search Form -->

                    </div>

                    <!--/ End Search Form -->

                    <div class="mobile-nav"></div>

                </div>

                <div class="col-lg-8 col-md-7 col-12">

                    <div class="search-bar-top">

                        <div class="search-bar">

                            <select>

                                <option >All Category</option>

                                @foreach(Helper::getAllCategory() as $cat)

                                    <option>{{$cat->title}}</option>

                                @endforeach

                            </select>

                            <form method="POST" action="{{route('product.search')}}">

                                @csrf

                                <input name="search" placeholder="Search Products Here....." type="search">

                                <button class="btnn" type="submit"><i class="ti-search"></i></button>

                            </form>

                        </div>

                    </div>

                </div>

                <div class="col-lg-2 col-md-3 col-12">

                    <div class="right-bar">

                        <!-- Search Form -->

                        <div class="sinlge-bar shopping">

                            @php 

                                $total_prod=0;

                                $total_amount=0;

                            @endphp

                           @if(session('wishlist'))

                                @foreach(session('wishlist') as $wishlist_items)

                                    @php

                                        $total_prod+=$wishlist_items['quantity'];

                                        $total_amount+=$wishlist_items['amount'];

                                    @endphp

                                @endforeach

                           @endif

                            <!-- <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a> -->

                            <!-- Shopping Item -->

                   
                            <!--/ End Shopping Item -->

                        </div>

                        {{-- <div class="sinlge-bar">

                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                        </div> --}}

                        <div class="sinlge-bar shopping">

                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>

                            <!-- Shopping Item -->

                            @auth

                                <div class="shopping-item">

                                    <div class="dropdown-cart-header">

                                        <span>{{count(Helper::getAllProductFromCart())}} Items</span>

                                        <a href="{{route('cart')}}">View Cart</a>

                                    </div>

                                    <ul class="shopping-list">

                                        {{-- {{Helper::getAllProductFromCart()}} --}}

                                            @foreach(Helper::getAllProductFromCart() as $data)

                                                    @php

                                                        $photo=explode(',',@$data->product['photo']);

                                                    @endphp

                                                    <li>

                                                        <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>

                                                        <a class="cart-img" href="#"><img src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}"></a>

                                                        {{--<h4><a href="{{route('product-detail',@$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>--}}

                                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">Rs.{{number_format($data->price,2)}}</span></p>

                                                    </li>

                                            @endforeach

                                    </ul>

                                    <div class="bottom">

                                        <div class="total">

                                            <span>Total</span>

                                            <span class="total-amount">Rs.{{number_format(Helper::totalCartPrice(),2)}}</span>

                                        </div>

                                        <a href="{{route('checkout')}}" class="btn animate">Checkout</a>

                                    </div>

                                </div>

                            @endauth

                            <!--/ End Shopping Item -->

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>    